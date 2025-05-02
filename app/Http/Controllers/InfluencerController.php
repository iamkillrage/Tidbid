<?php

namespace App\Http\Controllers;

require app_path() . '/Stripe/init.php';

use Stripe\Stripe;
use Stripe\Token;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use App\Models\Savedbank;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostReport;
use App\Models\UserOtp;
use App\Models\StreamManagement;
use App\Models\InfluencerIdVerification;
use Illuminate\Support\Facades\Session;
use App\Models\InfluencerSocial;
use App\Models\Transection;
use App\Models\SuggestInfluencer;
use App\Models\RefferedInfu;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\PostBookMark;
use App\Models\Follower;
use App\Models\BlockPost;
use App\Models\Notify;
use App\Models\Notification;
use App\Models\Agore;
use App\Models\LivestreamComment;
use App\Models\SendGift;
use App\Models\AgoraChat;
use App\Models\AgoraMessage;
use App\Models\Bid;
use App\Models\PrivateVideo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class InfluencerController extends Controller
{
    public $appId = 'e59366bc6d64449b9137b2e7c1a63209';

    public function __construct()
    {
        $this->middleware('check.user.status');
    }

    public function check()
    {
        $userId = Session::get('user_id');
        if (!empty($userId)) {
            $verification = InfluencerIdVerification::where('user_id', $userId)->first();

            if (!empty($verification)) {
                if ($verification->status == 'Inactive') {
                    Session::flush();
                    return redirect()->route('SignIn');
                } else {
                    return redirect()->back();
                }
            }
        }

        // Optionally return a default response, like redirecting to home or error page
        return redirect()->route('Home');
    }

    /** Generating Random OTP */
    public function generateOTP()
    {
        return random_int(10000, 99999);
    }

    /**
     * Influencer Sign in not then after Sign up page open
     */
    function SignUp()
    {
        return view('Influencer.Sign_up');
    }

    /** resend otp */
    public function resenOtp(Request $request)
    {
        $userEmail = User::where('id', $request->user_id)->first()->email;
        $otp = $this->generateOTP();
        $mailData['otp'] = $otp;
        Mail::to($userEmail)->send(new \App\Mail\MyTestMail($mailData));
        $createOtp = UserOtp::create([
            'user_id'       => $request->user_id,
            'otp'           => $otp,
            'otp_date_time' => date('Y-m-d h:i:s'),
        ]);

        if ($createOtp) {
            return response()->json([
                'success'   => 'Otp resend successfull',
                'status' => 1,
                'otp'       => $otp,
            ]);
        } else {
            return response()->json(['error' => 'something is wrong', 'status' => 0]);
        }
    }

    /**  Registration Form page */
    public function influencerSignUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'socialPlateFrom' => 'required',
            'userName' => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('status', 'Activate');
                }),
            ],
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }

        $createInfulencer = User::create([
            'userName'      => $request->userName,
            'email'         => $request->email,
            'password'      =>  $request->password,
            'role'          => 'Influencer',
            'referral_code' => Str::random(5),
            'agree'         => $request->agree
        ]);

        if ($createInfulencer) {
            $otp = $this->generateOTP();
            $mailData['otp'] = $otp;
            $dtaone =  Mail::to($createInfulencer->email)->send(new \App\Mail\MyTestMail($mailData));
            $this->createAgoraAccount($request->userName . $createInfulencer->id, $request->userName);
            $this->addSocial($request->socialPlateFrom, $createInfulencer->id);

            User::where('id', $createInfulencer->id)->update(['agora_id' => $request->userName . $createInfulencer->id]);

            UserOtp::create([
                'user_id'       => $createInfulencer->id,
                'otp'           => $otp,
                'otp_date_time' => date('Y-m-d h:i:s'),
            ]);

            if (!empty($request->refer_code)) {
                $getInfu = User::where('referral_code', $request->refer_code)->first();

                if (!empty($getInfu)) {
                    RefferedInfu::create([
                        'user_id'           => $getInfu->id,
                        'refered_user_id'   => $createInfulencer->id
                    ]);
                } else {
                    return response()->json(['error' => 'This is refer code is inactive', 'status' => 0]);
                }
            }

            return response()->json([
                'success'   => 'Form submitted successfully',
                'status' => 1,
                'otp'       => $otp,
                'user_id'   => $createInfulencer->id
            ]);
        } else {
            return response()->json(['error' => 'something is wrong', 'status' => 0]);
        }
    }

    public function addSocial($socialPlateFrom,  $createInfulencerid)
    {
        $social = explode(",", $socialPlateFrom);
        foreach ($social as $value) {
            InfluencerIdVerification::create([
                'user_id'               => $createInfulencerid,
                'verificationPlatform'  => $value,
                'verificationDate'      => date('Y-m-d'),
                'status'                => 'Inactive'
            ]);
        }

        return true;
    }

    /** Influencer Registration OTP Verification */
    public function matcheOtp(Request $request)
    {
        $userId = $request->userId;
        $otp    = $request->otp;

        if ($otp != '') {
            $UserOtp = UserOtp::where('user_id', $userId)->latest()->first();
            if ($otp == $UserOtp->otp) {
                $checkUser = User::where('id', $request->userId)->update(['status' => 'Activate']);
                $checkUser = InfluencerIdVerification::where('user_id', $request->userId)->update(['id_verification' => 'Activate']);
                $checkUser = User::where('id', $request->userId)->first();
                $request->session()->put('user_id', $checkUser->id);

                $request->session()->put('role', $checkUser->role);
                $request->session()->put('userName', $checkUser->userName);
                $request->session()->put('referral_code', $checkUser->referral_code);
                $request->session()->put('login_is', 'yes');
                $verify = InfluencerIdVerification::where('user_id', $userId)->first();
                $verification = InfluencerIdVerification::where('user_id', $userId)->pluck('status')->toArray();
                $request->session()->put('verify', $verify->status);

                if (in_array("Inactive", $verification)) {
                    return response()->json(['success' => 'your otp matched successfully', 'status' => 2]);
                } else {
                    return response()->json(['success' => 'your otp matched successfully', 'status' => 1]);
                }
            } else {
                return response()->json(['error' => 'please enter valid otp', 'status' => 0]);
            }
        } else {
            return response()->json(['error' => 'please enter valid otp', 'status' => 0]);
        }
    }

    public function forgotpassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        try {
            $userdata = User::query()->where(['email' => $request->email])->orwhere('phone', $request->email)->first();
            if ($userdata) {
                $data['user_id'] = $userdata->id;
                $otp = $this->generateOTP();
                $mailData['otp'] = $otp;
                $data['otp'] =  $otp;
                $data['otp_date_time'] = date('Y-m-d h:i:s');
                if (is_numeric($request->email)) {
                } else {
                    \Mail::to($request->email)->send(new \App\Mail\MyTestMail($mailData));
                }
                UserOtp::create($data);
                return response()->json(['status' => 1, 'user_id' => $userdata->id, 'otp' => $otp, 'message' => 'otp send successfully']);
            } else {
                if (is_numeric($request->email)) {
                    $message = 'This phone not Register';
                } else {
                    $message = 'This email not Register';
                }
                return response()->json(['status' => 0, 'message' => $message]);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function verifyotp(Request $request)
    {
        $userId = $request->userId;
        $otp    = implode($request->otp);
        if ($otp != '') {
            $checkuserotp = UserOtp::where('user_id', $userId)->latest()->first();

            if ($otp == $checkuserotp->otp) {
                $checkUser = User::where('id', $userId)->first();

                return response()->json(['success' => 'your otp matched successfully', 'user_id' => $userId, 'status' => 1]);
            } else {
                return response()->json(['error' => 'please enter valid otp', 'status' => 0]);
            }
        } else {
            return response()->json(['error' => 'otp is required', 'status' => 0]);
        }
    }

    public function resetpasswordconfirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId'            => 'required',
            'password'          => 'required|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirm_password'  => 'required_with:password|same:password|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }

        $userId = $request->userId;
        $user   = User::where('id', $userId)->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found']);
        }

        $user->password = Hash::make($request->confirm_password);
        $user->save();
        return response()->json(['status' => 'success']);
    }

    /** influencer Sign In page */
    public function SignIn(Request $request)
    {
        if ($request->session()->has('user_id')) {
            return $this->check();
        } else {
            return view('Influencer.Sign_in');
        }
    }

    /** login page */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }

        $checkUser = User::where('email', $request->email)->orWhere('phone', $request->email)->Where('role', 'Influencer')->where('status', 'Activate')->first();
        if (!empty($checkUser)) {
            if (Hash::check($request->post('password'), $checkUser->password)) {
                $request->session()->put('user_id', $checkUser->id);
                $request->session()->put('role', $checkUser->role);
                $request->session()->put('userName', $checkUser->userName);
                $request->session()->put('referral_code', $checkUser->referral_code);
                $request->session()->put('profile_img', $checkUser->profile_img);
                $request->session()->put('login_is', 'yes');
                $userId = Session::get('user_id');

                $verification = InfluencerIdVerification::where('user_id', $userId)->first();

                // if (!empty($verification)) {
                //     if (!empty($verification)) {
                //         if ($verification->status == 'Inactive') {
                //             $request->session()->flush();
                //             return response()->json(['error' => 'Your account is not verified', 'status' => 3]);
                //         }
                //     }
                // }
                
                if ($verification && $verification->status == 'Inactive') {
                    $request->session()->flush();
                    return response()->json(['error' => 'Your account is not verified', 'status' => 3]);
                }

                return response()->json(['success' => 'You have login successfully', 'status' => 1]);
            } else {
                return response()->json(['error' => 'Invalid password', 'status' => 0]);
            }
        } else {
            if (is_numeric($request->email)) {
                return response()->json(['error' => 'Please enter register mobile number', 'status' => 0]);
            } else {
                return response()->json(['error' => 'Please enter register email', 'status' => 0]);
            }
        }
    }

    /** Influencer My Profile Page */
    public function Influencer_My_profile(Request $request)
    {
        try {
            $userdata = User::select('id', 'userName', 'email', 'phone', 'dob', 'bio', 'name', 'profile_img')->where('id', Session::get('user_id'))->first();
            $InfluencerSocial = InfluencerSocial::where('user_id', Session::get('user_id'))->get();

            return view('Influencer.Influencer_My_Profile', compact('userdata', 'InfluencerSocial'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /** influencer my profile create page */
  public function Influencer_My_profile_Create(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'phone'         => 'required|digits:10',
            'dob'           => 'required',
            'bio'           => 'required',
            'profile_img'   => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
        
         $customMessages = [
        'phone.required' => 'please fill this phone field',
        'phone.digits'   => 'Please fill this phone field', // Custom message for 10-digit validation
    ];

        $checkUser = User::where('email', $request->email)->orWhere('phone', $request->email)->first();

        $isnew = 1;
        if($checkUser->name)
        
        {
            $isnew = 0;
        }

        if ($checkUser && $checkUser->profile_img == null) {
            $rules['profile_img'][] = 'required';
        }


        $data = $request->validate($rules, $customMessages);
        try {
            $user = User::find(Session::get('user_id'));
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $imageName = null;

            if ($request->hasFile('profile_img') && $request->file('profile_img')->isValid()) {
                $profile_img    = $request->file('profile_img');
                $imageName      = time() . '_' . $profile_img->getClientOriginalName();

                $profile_img->move(public_path('Influencer/images/profile_img'), $imageName);

                $user->update([
                    'profile_img' => $imageName,
                ]);

                $request->session()->put('profile_img', $imageName);
            }

            $formattedDate = Carbon::createFromFormat('m-d-Y', $request->input('dob'))->format('Y-m-d');
            $user->update([
                'name'              => $request->input('name'),
                'phone'             => $request->input('phone'),
                'dob'               => $formattedDate,
                'bio'               => $request->input('bio'),
                'profile_status'    => 'Complete',
            ]);

            $social_site_link = $request->social_site_link;
            if (!empty($social_site_link)) {
                $InfluencerSocial = InfluencerSocial::where('user_id', Session::get('user_id'))->delete();
                foreach ($social_site_link as $social_site_links) {
                    InfluencerSocial::create([
                        'user_id'           => Session::get('user_id'),
                        'social_site_link'  => $social_site_links
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Profile updated successfully')->with('isnew', $isnew);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',  $e->getMessage());
        }
    }


    /** add social link */
    public function addSocialLink() {}

    /** Influencer Home Page */
    public function Influencer_index(Request $request)
    {
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        $livestream = StreamManagement::whereDate('streamDate', '=', $currentDate)
            ->whereTime('streamTime', '<=', $currentTime)
            ->where('bid_end_status', 2)
            ->get();

        $getBlockPost   = BlockPost::where('user_id', Session::get('user_id'))->get();
        $userProfile    = User::where('id', Session::get('user_id'))->first();

        $postData = Post::with(['images', 'getInfluencers'])
            ->with(['likes.user'  => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1);
            }])
            ->withCount(['countComent', 'countLike']);

        if ($request->ajax()) {
            $postData = $postData->paginate(12);
            $postData->getCollection()->transform(function ($post) {
                $post->post_id = $post->id;
                $post->liked_by_user = $post->userLikePost()->exists();
                $post->bookMark_by_user = $post->PostBookMark()->exists();
                $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
                $post->likes_data = $post->likes->map(function ($like) {
                    return [
                        'user_name' => $like->user->name,
                        'user_profile_image' => $like->user->profile_img,
                    ];
                });
                return $post;
            });
            $view = view('Influencer.partial-page.influencer-index-post', compact('postData', 'getBlockPost', 'userProfile'));
            return response()->json(['html' => $view]);
        }

        $postData = $postData->orderBy('id', 'DESC');

        $postData = $postData->paginate(12);
        $postData->getCollection()->transform(function ($post) {
            $post->post_id = $post->id;
            $post->liked_by_user = $post->userLikePost()->exists();
            $post->bookMark_by_user = $post->PostBookMark()->exists();
            $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
            return $post;
        });
        return view('Influencer.Index', compact('postData', 'livestream', 'getBlockPost', 'userProfile'));
    }

    /** Influencer About-Us Page */
    public function Influencer_About_us()
    {
        return view('Influencer/About_us');
    }

    /** influencer Explore page */
    public function Influencer_Explore(Request $request)
    {
        $user_id = Session::get('user_id');
        $influencerdata = User::withCount('upcomingStreams', 'getFollowing', 'followerscount')
            ->where('profile_status', 'Complete')->where('role', 'Influencer')->where('id', '!=', $user_id)->paginate(12);

        return view('Influencer.Influencer_Explore', compact('influencerdata'));
    }

    public function Influencer_ExploreAjax(Request $request)
    {
        $user_id = Session::get('user_id');
        if ($request->ajax()) {
            $query = User::withCount('upcomingStreams')->where('role', 'Influencer')->where('id', '!=', $user_id)->where('profile_status', 'Complete');
            if ($request->has('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }
            $influencerdata = $query->paginate(12);

            return view('Influencer.partial-page.influencer-page', ['influencerdata' => $influencerdata]);
        }
    }

    /** influencer Explore page */
    public function Influencer_Explore_Stream(Request $request)
    {
        $date = date('Y-m-d');
        $streamdata = StreamManagement::with('getInfluencers')->where('streamDate', '>=', $date)->where('bid_end_status', 2)->orderBy('id', 'DESC')->where('influencer_id', '!=', Session::get('user_id'));
        $streamdata = $streamdata->paginate(8);

        $Notify = Notify::where('user_id', Session::get('user_id'))->get();
        $streamData = StreamManagement::where('id', $request->stream_id)->with('getInfluencers')->first();
        return view('Influencer.Influencer_Explore_Stream', compact('streamdata', 'streamData', 'Notify'));
    }

    public function Influencer_Explore_Stream_Ajax(Request $request)
    {
        if ($request->ajax()) {
            $date = date('Y-m-d');
            $Notify = Notify::where('user_id', Session::get('user_id'))->get();
            $streamdata = StreamManagement::with(['getInfluencers'])->where('streamDate', '>=', $date)->where('id', '>', 0);
            if (isset($request->search)) {
                $streamdata->whereHas('getInfluencers', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
            }
            if (isset($request->eventdate)) {

                $components = preg_split("/-/", $request->eventdate, -1);
                $start_date_signup = trim($components[0]);
                $end_date_signup = trim($components[1]);
                $end_date_signup = Carbon::parse($end_date_signup)->addDay()->format('m/d/Y');
                $streamdata = $streamdata->whereBetween('streamDate', [
                    date(Carbon::createFromFormat('m/d/Y', $start_date_signup)->format('Y-m-d')),
                    date(Carbon::createFromFormat('m/d/Y', $end_date_signup)->format('Y-m-d'))
                ]);
            }
            if (isset($request->type)) {
                $streamdata = $streamdata->where('event_status', $request->type);
            }
            $streamdata = $streamdata->where('influencer_id', '!=', Session::get('user_id'));
            $streamdata = $streamdata->paginate(8);
            return view('Influencer.partial-page.Influencer_Explore_Stream_partial', ['streamdata' => $streamdata, 'Notify' => $Notify]);
        }
    }

    /** influencer stream page */
    function Influencer_Stream()
    {
        try {
            $currentDate        = date('Y-m-d');
            $currentDateTime    = date('Y-m-d H:i:s');

            $streamdata = StreamManagement::where('influencer_id', Session::get('user_id'))
                ->where('streamDate', '>=', $currentDate)
                ->where('bid_end_status', 2)
                ->get();

            $paststreamdata = StreamManagement::where('influencer_id', Session::get('user_id'))
                ->where('streamDate', '<', $currentDate)
                ->orWhere('bid_end_status', 1)
                ->where('influencer_id', Session::get('user_id'))
                ->orderBy('streamDateTime', 'DESC')
                ->get();

            $totalcount     = Post::where('influencer_id', Session::get('user_id'))->count();
            $streamcount    = StreamManagement::where('influencer_id', Session::get('user_id'))->count();
            $totalfollowers = Follower::where('following_id', Session::get('user_id'))->count();

            return view('Influencer.Influencer_Stream', compact('streamdata'), compact('paststreamdata', 'totalcount', 'streamcount', 'totalfollowers'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function Detail_Stream_Page(Request $request)
    {
        $Notify         = Notify::where('user_id', Session::get('user_id'))->get();
        $data           = User::with('streams')->find($request->id);
        $checkFollow    = Follower::where('user_id', Session::get('user_id'))->where('following_id',  $request->id)->first();

        $currentDate = date('Y-m-d');
        $upCommingStreem = StreamManagement::where('influencer_id', $request->id)
            ->where('streamDate', '>', $currentDate)
            ->get();

        $PastStreem = StreamManagement::where('influencer_id', $request->id)
            ->where('streamDate', '<', $currentDate)
            ->get();

        $totalfollowers         = Follower::where('following_id', $request->id)->count();
        $suggest_influencer     = SuggestInfluencer::where('influencer_id', Session::get('user_id'))->where('suggest_influencer_id',  $request->id)->first();
        $get_suggest_influencer = SuggestInfluencer::with('user')->where('influencer_id', $request->id)->get();

        return view('Detail_Stream_Page', compact('data', 'checkFollow', 'suggest_influencer', 'get_suggest_influencer', 'totalfollowers', 'upCommingStreem', 'PastStreem', 'Notify'));
    }

    public function Detail_Post_Page(Request $request)
    {
        $ids            =  $request->id;
        $data           = User::with('posts')->find($request->id);
        $userProfile    = User::where('id', Session::get('user_id'))->first();

        $postData = Post::where('influencer_id', $request->id)
            ->with(['images', 'comments'])
            ->with(['likes.user'  => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1); // Retrieve the last like
            }])
            ->withCount(['countComent', 'countLike']);

        $getBlockPost = BlockPost::where('user_id', Session::get('user_id'))
            ->pluck('post_id')
            ->toArray();

        $PostBookMark = PostBookMark::where('user_id', Session::get('user_id'))
            ->pluck('post_id')
            ->toArray();

        $postLike = PostLike::where('user_id', Session::get('user_id'))
            ->pluck('post_id')
            ->toArray();

        $postData = Post::where('influencer_id', $request->id)
            ->with(['images', 'comments', 'getInfluencers'])
            ->with(['likes.user'  => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1); // Retrieve the last like
            }])
            ->withCount(['countComent', 'countLike']);

        if ($request->ajax()) {
            $postData = $postData->paginate(20);
            $postData->getCollection()->transform(function ($post) {
                $post->post_id          = $post->id;
                $post->liked_by_user    = $post->userLikePost()->exists();
                $post->bookMark_by_user = $post->PostBookMark()->exists();
                $post->last_like_user   = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;

                $post->likes_data = $post->likes->map(function ($like) {
                    return [
                        'user_name' => $like->user->name,
                        'user_profile_image' => $like->user->profile_img,
                    ];
                });

                return $post;
            });

            $view = view('Influencer.partial-page.influencer-post-partial', compact('userProfile', 'ids', 'postData', 'PostBookMark', 'getBlockPost', 'postLike'))->render();

            return response()->json(['html' => $view]);
        }

        $postData = $postData->paginate(20);
        $postData->getCollection()->transform(function ($post) {
            $post->post_id          = $post->id;
            $post->liked_by_user    = $post->userLikePost()->exists();
            $post->bookMark_by_user = $post->PostBookMark()->exists();
            $post->last_like_user   = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;

            return $post;
        });

        $checkFollow = Follower::where('user_id', Session::get('user_id'))->where('following_id',  $request->id)->first();

        $currentDate = date('Y-m-d');
        $paststreamdata = StreamManagement::where('influencer_id', $request->id)
            ->where('streamDate', '<', $currentDate)
            ->get();

        $upcommingtreamdata = StreamManagement::where('influencer_id', $request->id)
            ->where('streamDate', '>', $currentDate)
            ->count();

        $totalfollowers = Follower::where('following_id', $request->id)->count();

        return view('Detail_Post_Page', compact('userProfile', 'ids', 'postData', 'data', 'upcommingtreamdata', 'getBlockPost', 'paststreamdata', 'totalfollowers', 'checkFollow', 'PostBookMark', 'getBlockPost', 'postLike'));
    }

    public function Detail_Schedule_Page(Request $request)
    {
        $data = User::with('posts')->find($request->id);
        $checkFollow = Follower::where('user_id', Session::get('user_id'))->where('following_id',  $request->id)->first();

        $currentDate = date('Y-m-d');
        $upcommingtreamdata = StreamManagement::where('influencer_id', $request->id)
            ->where('streamDate', '>', $currentDate)
            ->count();

        $Notify = Notify::where('user_id', Session::get('user_id'))->get();

        $currentDate = date('Y-m-d');
        $getStrrem = StreamManagement::where('influencer_id', $request->id)->where('streamDate', '>', $currentDate)->get();
        $datas = $getStrrem->toArray();

        $totalfollowers = Follower::where('following_id', $request->id)->count();

        return view('Detail_Schedule_Page', compact('data', 'upcommingtreamdata', 'totalfollowers', 'checkFollow', 'datas', 'Notify'));
    }

    public function eventdata(Request $request)
    {
        $datas = [];
        $getStrrem = StreamManagement::where('influencer_id', $request->param)->get();
        $data = $getStrrem->toArray();

        foreach ($data as $row) {
            $checkStatus = Notify::where('stream_id', $row["id"])->where('user_id', Session::get('user_id'))->first();

            $datas[] = array(
                'notifyStatus'  => isset($checkStatus) ? 1 : 0,
                'id'            => $row["id"],
                'title'         => $row["streamTitle"],
                'start'         => $row["streamDate"] . ' ' . $row['streamTime'],
                'thumbnail_img' => $row["thumbnail_img"],
                'baseBidPrice'  => $row["baseBidPrice"],
                'description'   => $row["description"],
            );
        }

        echo json_encode($datas);
    }

    public function Influencer_Create_Stream(Request $request)
    {
        $validatedData = $request->validate([]);
        $validator = Validator::make($request->all(), [
            'influencer_id'         => '',
            'streamTitle'           => 'required|string',
            'streamDate'            => 'required|string',
            'streamTime'            => 'required',
            'baseBidPrice'          => 'required',
            'what_to_expect'        => 'required',
            'term_and_conditions'   => 'required',
            'description'           => 'required',
            // 'location'              => 'required',
            'thumbnail_img'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }

        try {
            if ($request->hasFile('thumbnail_img') && $request->file('thumbnail_img')->isValid()) {
                $thumbnail_img = $request->file('thumbnail_img');
                $imageName = time() . '_' . $thumbnail_img->getClientOriginalName();
                $thumbnail_img->move(public_path('Influencer/images/thumbnail'), $imageName);
            }

            $eventDate = strtotime($request->input('streamDate'));
            $todayDate = strtotime(date('Y-m-d'));

            if ($eventDate > $todayDate) {
                $event_status = 'Upcoming_Streams';
            } elseif ($eventDate <= $todayDate) {
                $event_status = 'Live_Streams';
            }

            $createStream = new StreamManagement();
            $createStream->influencer_id = Session::get('user_id');
            $createStream->streamTitle = $request->streamTitle;
            $createStream->event_status = $event_status;
            $createStream->streamDate = date('Y-m-d', strtotime($request->input('streamDate')));
            $createStream->streamDateTime = date('Y-m-d', strtotime($request->input('streamDate'))) . ' ' . $request->streamTime;
            $createStream->streamTime = $request->streamTime;
            $createStream->baseBidPrice = $request->baseBidPrice;
            $createStream->what_to_expect = $request->what_to_expect;
            $createStream->term_and_conditions = $request->term_and_conditions;
            $createStream->description = $request->description;
            // $createStream->location = $request->location;
            $createStream->thumbnail_img = $imageName ?? null;
            $createStream->save();

            $streamData = StreamManagement::where('id', $createStream->id)->with('getInfluencers')->first();

            return response()->json(['success' => true, 'data' => $streamData]);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add stream: ' . $e->getMessage()]);
        }
    }

    // 13-11-2024
    public function Influencer_Live_Stream(Request $request)
    {
        $validatedData = $request->validate([]);
        $validator = Validator::make($request->all(), [
            'influencer_id'         => '',
            'streamTitle'           => 'required|string',
            // 'streamDate'            => 'required|string',
            // 'streamTime'            => 'required',
            'baseBidPrice'          => 'required',
            'what_to_expect'        => 'required',
            'term_and_conditions'   => 'required',
            'description'           => 'required',
            //'location'              => 'required',
            'thumbnail_img'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }

        try {
            if ($request->hasFile('thumbnail_img') && $request->file('thumbnail_img')->isValid()) {
                $thumbnail_img = $request->file('thumbnail_img');
                $imageName = time() . '_' . $thumbnail_img->getClientOriginalName();
                $thumbnail_img->move(public_path('Influencer/images/thumbnail'), $imageName);
            }

            // Set the event status based on the current date
            $now = Carbon::now();
            $event_status = 'Live_Streams';

            // Create the new stream entry with the current date and time
            $createStream = new StreamManagement();
            $createStream->influencer_id = Session::get('user_id');
            $createStream->streamTitle = $request->streamTitle;
            $createStream->event_status = $event_status;
            $createStream->streamDate = $now->format('Y-m-d');
            $createStream->streamTime = $now->format('H:i:s');
            $createStream->streamDateTime = $now->format('Y-m-d H:i:s');
            $createStream->baseBidPrice = $request->baseBidPrice;
            $createStream->what_to_expect = $request->what_to_expect;
            $createStream->term_and_conditions = $request->term_and_conditions;
            $createStream->description = $request->description;
           // $createStream->location = $request->location;
            $createStream->thumbnail_img = $imageName ?? null;
            $createStream->save();

            $streamData = StreamManagement::where('id', $createStream->id)->with('getInfluencers')->first();

            //Create Go Live Notification
            $followers = Follower::with('getInfluencer')->where('following_id', Session::get('user_id'))->get();

            foreach ($followers as $follower) {
                $userId = $follower->user_id;
                $influencerName = $follower->getInfluencer->name;

                // Create notification
                Notification::create([
                    'user_id' => $userId,
                    'influencer_id' => Session::get('user_id'),
                    'title' => 'Live Now',
                    'message' => $influencerName . ' has Live Now',
                    'seen_status' => 0,
                ]);
            }

            return response()->json(['success' => true, 'data' => $streamData]);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add stream: ' . $e->getMessage()]);
        }
    }
    //13-11-2024

    public function Influencer_Update_Stream(Request $request)
    {
        try {
            $streamdata = StreamManagement::find($request->user_id);
            $streamdata->streamTitle = $request->streamTitle;
            $streamdata->streamDate = date('Y-m-d', strtotime($request->input('streamDate')));
            $streamdata->streamDateTime = date('Y-m-d', strtotime($request->input('streamDate'))) . ' ' . $request->streamTime;
            $streamdata->streamTime = $request->streamTime;
            $streamdata->baseBidPrice = $request->baseBidPrice;
            $streamdata->what_to_expect = $request->what_to_expect;
            $streamdata->term_and_conditions = $request->term_and_conditions;
            $streamdata->description = $request->description;
            $streamdata->location = $request->location;
            if ($request->hasFile('thumbnail_img')) {
                $thumbnail = $request->file('thumbnail_img');
                $thumbnailName = time() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('Influencer/images/thumbnail/'), $thumbnailName);
                $streamdata->thumbnail_img = $thumbnailName;
            }
            $streamdata->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add stream: ' . $e->getMessage()]);
        }
    }

    public function Influencer_Delete_Stream(Request $request)
    {
        $DeleteStream =  $request->streamId;
        $DeleteStream = StreamManagement::where('id', $DeleteStream)->delete();
        return response()->json(['message' => 'Stream deleted successfully.', 'status' => 1]);
    }

    public  function Influencer_Post(Request $request)
    {
        $userProfile    = User::where('id', Session::get('user_id'))->first();
        $postData = Post::where('influencer_id', Session::get('user_id'))
            ->orderBy('created_at', 'desc')
            ->with(['images', 'comments'])
            ->with(['likes.user'  => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1); // Retrieve the last like
            }])
            ->withCount(['countComent', 'countLike']);

        if ($request->ajax()) {
            $postData = $postData->paginate(20);
            $postData->getCollection()->transform(function ($post) {
                $post->post_id = $post->id;
                $post->liked_by_user = $post->userLikePost()->exists();
                $post->bookMark_by_user = $post->PostBookMark()->exists();
                $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
                $post->likes_data = $post->likes->map(function ($like) {
                    return [
                        'user_name' => $like->user->name,
                        'user_profile_image' => $like->user->profile_img,
                    ];
                });
                return $post;
            });

            $view = view('Influencer.partial-page.influencer-post-partial', compact('postData', 'userProfile'));
            return response()->json(['html' => $view]);
        }

        $postData = $postData->paginate(20);
        $postData->getCollection()->transform(function ($post) {
            $post->post_id = $post->id;
            $post->liked_by_user = $post->userLikePost()->exists();
            $post->bookMark_by_user = $post->PostBookMark()->exists();
            $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
            return $post;
        });

        $currentDate = date('Y-m-d');
        $paststream = StreamManagement::where('influencer_id', Session::get('user_id'))
            ->where('streamDate', '<', $currentDate)
            ->orderBy('streamDateTime', 'DESC')
            ->paginate(20);

        $totalpost = Post::where('influencer_id', Session::get('user_id'))->count();
        $totalstream = StreamManagement::where('influencer_id', Session::get('user_id'))->count();
        $totalfollowers = Follower::where('following_id', Session::get('user_id'))->count();
        return view('Influencer.Influencer_Post', compact('postData'), compact('paststream', 'totalpost', 'totalstream', 'totalfollowers', 'userProfile'));
    }

    public function get_Post_comment(Request $request)
    {
        $post_id = $request->id;
        $get = PostComment::with('getUser')->where('post_id', $post_id)->get();

        $comment_html = '';
        if (count($get) != 0) {
            foreach ($get as $data) {
                $profile = $data->getUser->profile_img;
                if ($profile != '') {
                    $img = '<img src="' . asset('Influencer/images/profile_img/' . $profile) . '" alt="">';
                } else {
                    $img =  '<img src="' . asset('Influencer/images/comment-img.png') . '" alt="">';
                }
                $comment_html .= '
                            <div class="main-comment">
                            <div class="comment-img">
                              ' . $img . '
                            </div>
                            <div class="comment-left">
                            <p style="color: #000000; font-weight:600;">' . $data->getUser->userName . ' <span style="color: #971C93; font-weight:600;">' . $data->created_at->diffForHumans() . '</span></p>
                            <p style="color: #333333;">' . $data->comment . '</p>

                            </div>
                            </div> 
                    ';
            }
            return response()->json(['html' => $comment_html]);
        } else {
            return response()->json(['html' => 'No comment found']);
        }
    }

    public function getPost_like(Request $request)
    {
        $post_id = $request->id;
        $get = PostLike::with('user')->where('post_id', $post_id)->get();
        $comment_html = '';
        if (count($get) != 0) {
            foreach ($get as $data) {
                $user = $data->user;
                if ($user && $user->profile_img != '') {
                    $img = '<img src="' . asset('Influencer/images/profile_img/' . $user->profile_img) . '" alt="">';
                } else {
                    $img = '<img src="' . asset('Influencer/images/profile_img/comment-img.png') . '" alt="">';
                }
                $comment_html .= '
                        <div class="likebox">
                        <div class="likeimg">' . $img . '</div>
                        <div class="liketext">
                        <p>' . $data->user->userName . '</p>
                        </div>
                        </div>
            ';
            }
            return response()->json(['html' => $comment_html]);
        } else {
            return response()->json(['html' => 'No like found']);
        }
    }

    public function Influencer_Create_Post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string',
            'description'   => 'required|string',
           // 'location'      => 'required',
            'media_upload'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }

        try {
            $post = new Post();
            $post->influencer_id    = Session::get('user_id');
            $post->title            = $request->title;
           // $post->location         = $request->location;
            $post->description      = $request->description;

            $post->save();

            if ($post) {
                if ($request->hasFile('media_upload')) {
                    foreach ($request->media_upload as $image) {
                        $fileName = $image->getClientOriginalName();
                        $path = $image->move('Influencer/images/postimage/', $fileName);

                        $postImage = new PostImage();

                        $postImage->post_img = $path;
                        $postImage->post_id = $post->id;
                        $postImage->save();
                    }
                }
            }

            // Create Post Notifications 
            $followers = Follower::with('getInfluencer')->where('following_id', Session::get('user_id'))->get();

            foreach ($followers as $follower) {
                $userId = $follower->user_id;
                $influencerName = $follower->getInfluencer->name;

                // Create notification
                Notification::create([
                    'user_id' => $userId,
                    'influencer_id' => Session::get('user_id'),
                    'title' => 'Post Shared',
                    'message' => $influencerName . ' has shared a post.',
                    'seen_status' => 0,
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add post: ' . $e->getMessage()]);
        }
    }

    public function Influencer_Update_Post(Request $request)
    {
        try {
            $postdata = Post::find($request->id);
            $postdata->title = $request->title;
            $postdata->location = $request->location;
            $postdata->description = $request->description;
            $postdata->save();

            if ($request->hasFile('media_upload_edit')) {
                PostImage::where('post_id', $request->id)->delete();

                foreach ($request->media_upload_edit as $image) {
                    $fileName = $image->getClientOriginalName();
                    $path = $image->move('Influencer/images/postimage/', $fileName);

                    $postImage = new PostImage();

                    $postImage->post_img = $path;
                    $postImage->post_id = $postdata->id;
                    $postImage->save();
                }
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add stream: ' . $e->getMessage()]);
        }
    }

    public function Influencer_Delete_Post(Request $request)
    {
        $DeletePost =  $request->postId;
        $DeletePost = Post::where('id', $DeletePost)->delete();
        return response()->json(['message' => 'Post deleted successfully.', 'status' => 1]);
    }

    public function Influencer_No_Saved_Bank()
    {
        return view('Influencer.no_saved_bank');
    }

    // public function Influencer_Add_Bank(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'bank_name' => 'required|string',
    //         'account_no' => 'required|string',
    //         'routing_no' => 'required',
    //     ]);

    //     try {
    //         Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    //         $tokenArray = Token::create([
    //             'bank_account' => [
    //                 'country'   => 'US',
    //                 'currency'  => 'usd',
    //                 'account_holder_name' => 'Test User',
    //                 'account_holder_type' => 'individual',
    //                 'routing_number' => $validatedData['routing_no'],
    //                 'account_number' => $validatedData['account_no'],
    //             ],
    //         ]);

    //         if (!empty($tokenArray)) {
    //             $add = [
    //                 'influencer_id' => Session::get('user_id'),
    //                 'all_stripe_data' => json_encode($tokenArray)
    //             ];

    //             $add = Savedbank::create($add);
    //         } else {
    //             return response()->json(['error' => 'Something is wrong', 'status' => 0]);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['Error' => $e->getMessage()]);
    //     }
    //     return response()->json(['Success' => 'Bank details added successfully', 'status' => 1]);
    // }
    
    public function Influencer_Add_Bank(Request $request)
{
    $validatedData = $request->validate([
        'bank_name' => 'required|string',
        'account_no' => 'required|string',
        'routing_no' => 'required',
    ]);

    try {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $tokenArray = Token::create([
            'bank_account' => [
                'country'   => 'US',
                'currency'  => 'usd',
                'account_holder_name' => 'Test User',
                'account_holder_type' => 'individual',
                'routing_number' => $validatedData['routing_no'],
                'account_number' => $validatedData['account_no'],
            ],
        ]);

        if (!empty($tokenArray)) {
             $tokenArray->bank_account->bank_name = $validatedData['bank_name'];
            $add = [
                'influencer_id' => Session::get('user_id'),
                'all_stripe_data' => json_encode($tokenArray)
            ];

            Savedbank::create($add);
        } else {
            return response()->json(['error' => 'Invalid bank details provided', 'status' => 0]);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Wrong bank detail, please add correct detail', 'status' => 0]);
    }

    return response()->json(['success' => 'Bank details added successfully', 'status' => 1]);
}


    public function Influencer_Delete_Bank(Request $request)
    {
        $Savedbank = Savedbank::find($request->id);
        if ($Savedbank) {
            $Savedbank->delete();
            return response()->json(['message' => 'Bank deleted successfully.', 'status' => 1]);
        } else {
            return response()->json(['message' => 'Something is wrong.', 'status' => 0]);
        }
    }

    public function Influencer_Saved_Bank()
    {
        $bank = SavedBank::where('influencer_id', Session::get('user_id'))->get();
        return view('Influencer.saved_bank', compact('bank'));
    }

    public function Logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/influencer-signIn');
    }

    /**  privacy policy */
    public function Privacy_Policy()
    {
        try {
            $data = PrivacyPolicy::first();
            return view('Privacy_policy', ['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /** term & condition */
    public function terms_condition()
    {
        try {
            $data = TermCondition::first();
            return view('Terms_and_condition', compact('data'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /** Home - without signup */
    public function Home(Request $request)
    {
        $influencerData = User::where('role', 'Influencer')->get();

        $allstreamdata = StreamManagement::where('id', '>', '0')->whereDate('streamDate', '=', now()->toDateString())
            ->orderBy('streamDate', 'asc')
            ->orderBy('streamTime', 'asc')->get();

        $morestream = StreamManagement::whereDate('streamDate', '>=', now()->toDateString())
            ->orderBy('streamDate', 'asc')
            ->orderBy('streamTime', 'asc')
            ->get();

        $upComingstream = StreamManagement::with(['getInfluencers'])->where('streamDate', '>=', now()->toDateString())->where('id', '>', 0);

        $currentDate = date('Y-m-d');

        return view('Home', compact('influencerData', 'allstreamdata', 'morestream', 'upComingstream'));
    }

    /** About - without signup */
    public function about_us()
    {
        return view('about_us');
    }

    /**  Explore - without signup */
    public function Explore(request $request)
    {
        $userId = Session::get('user_id');
        $checkUserStatus = User::where('id', $userId)->where('status', 'Inactive')->first();

        if (empty($checkUserStatus)) {
            Session::flush();
        }

        $influencerdata = User::where('verify_status', 1)->where('status', 'Activate');
        if ($request->has('search')) {
            $influencerdata =   $influencerdata->where('name', 'like', '%' . $request->search . '%');
        }

        $influencerdata = $influencerdata->paginate(12);
        return view('Explore', compact('influencerdata'));
    }

    /** Explore - Stream without sihnup */
    public function explore_stream(request $request)
    {
        $userId = Auth::id();

        if (!empty($userId)) {
            /** user id */
            $userId = Auth::id();
        } else {
            /** infulancer id */
            $userId = Session::get('user_id');
        }

        $date       = date('Y-m-d');
        $Notify     = Notify::where('user_id', $userId)->get();
        $streamdata = StreamManagement::whereHas('getInfluencers')->where('streamDate', '>=', $date)->where('id', '>', '0')->where('bid_end_status', 2);

        if ($request->ajax()) {
            if (isset($request->search)) {
                $keyword = $request->search;
                $streamdata = $streamdata->whereHas('getInfluencer', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
            }

            if (isset($request->eventdate)) {
                $dates = explode("-", $request->eventdate);
                $startDate = date('Y-m-d', strtotime($dates[0]));
                $endDate = date('Y-m-d', strtotime($dates[1]));

                // Ensure the dates are valid before using them in the query
                if ($startDate && $endDate) {
                    $streamdata = $streamdata->whereBetween('streamDate', [$startDate, $endDate]);
                }
            }

            if (isset($request->type)) {
                $streamdata = $streamdata->where('event_status', $request->type);
            }

            $streamdata = $streamdata->paginate(8);

            $view = view('Partial.explore_stream_partial', compact('streamdata', 'Notify'))->render();
            return response()->json(['html' => $view]);
        }

        $streamdata = $streamdata->paginate(8);

        return view('Explore_stream', compact('streamdata', 'Notify'));
    }

    /** Post Report */
    public function Post_Report(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
            'description' => 'required',
            'user_id' => '',
        ]);

        try {
            if ($validatedData['type'] == 'Stream') {
                $type = 'Stream';
            } else {
                $type = 'Post';
            }

            $report = new PostReport;
            $report->description    = $validatedData['description'];
            $report->post_id        = $validatedData['post_id'];
            $report->user_id        = Session::get('user_id');
            $report->type           = $type;

            $report->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add post: ' . $e->getMessage()]);
        }
    }

    public function blockPost(Request $request)
    {
        $addBlock = BlockPost::create([
            'user_id' => Session::get('user_id'),
            'post_id'  => $request->id
        ]);

        if ($addBlock) {
            return response()->json(['status' => 1,    'message' => 'Post block successfully']);
        } else {
            return response()->json(['status' => 0,    'message' => 'something is wrong']);
        }
    }

    // public function Influencer_My_Transaction(Request $request)
    // {
    //     $transection = Transection::with(['getStream', 'getUser', 'getInfu']);
        
       
    //     if (isset($request->datefilter)) {
    //         $components = preg_split("/-/", $request->datefilter, -1,);
    //         $start_date_signup = trim($components[0]);
    //         $end_date_signup = trim($components[1]);
    //         $end_date_signup = Carbon::parse($end_date_signup)->addDay()->format('m/d/Y');
    //         $transection = $transection->whereBetween('date_time', [
    //             date(Carbon::createFromFormat('m/d/Y', $start_date_signup)->format('Y-m-d')),
    //             date(Carbon::createFromFormat('m/d/Y', $end_date_signup)->format('Y-m-d'))
    //         ]);
    //     }

    //     $transection = $transection->paginate(10);
    //     return view('Influencer.Influencer_My_Transaction', ['transection' => $transection]);
    // }
    
    public function Influencer_My_Transaction(Request $request)
{
    // Current logged-in influencer id
    $influencer_id = session('user_id'); // Since you're using session for user_id

    // Get transactions related to streams of the logged-in influencer
    $transection = Transection::with(['getStream', 'getUser', 'getInfu'])
        ->whereHas('getStream', function ($query) use ($influencer_id) {
            $query->where('influencer_id', $influencer_id);
        });

    // Apply date filter if provided
    if (isset($request->datefilter)) {
        $components = explode("-", $request->datefilter);
        $start_date_signup = trim($components[0]);
        $end_date_signup = trim($components[1]);

        $end_date_signup = Carbon::parse($end_date_signup)->addDay()->format('m/d/Y');

        $transection->whereBetween('date_time', [
            Carbon::createFromFormat('m/d/Y', $start_date_signup)->format('Y-m-d'),
            Carbon::createFromFormat('m/d/Y', $end_date_signup)->format('Y-m-d')
        ]);
    }

    // Paginate transactions
    $transection = $transection->paginate(10);

    // Process transactions to add 'what_to_expect'
    foreach ($transection as $trans) {
        $stream = $trans->getStream;
        $influencer = $trans->getInfu;

        if ($stream && $influencer && $stream->influencer_id == $influencer->id) {
            $trans->what_to_expect = $stream->what_to_expect;
        } else {
            $trans->what_to_expect = null;
        }
    }

    return view('Influencer.Influencer_My_Transaction', ['transection' => $transection]);
}


    public function Influencer_My_Follower()
    {
        $getMyFollower = Follower::with(['user', 'user.upcomingStreams', 'user.getFollowing'])
            ->where('following_id', Session::get('user_id'))
            ->whereHas('user', function ($query) {
                $query->where('role', 'Influencer');
            })
            ->get();

        // $getMyUserFollower = Follower::with(['user', 'user.upcomingStreams', 'user.getFollowing'])
        //     ->where('user_id', Session::get('user_id'))
        //     ->whereHas('user', function ($query) {
        //         $query->where('role', 'user');
        //     })
        //     ->get();
        
        $getMyUserFollower = Follower::with(['user', 'user.upcomingStreams', 'user.getFollowing'])
    ->where('following_id', Session::get('user_id')) // ✅ `follow_id` influencer ka hoga
    ->whereHas('user', function ($query) {
        $query->where('role', 'user'); // ✅ Sirf users ko dikhana hai
    })
    ->get();


        return view('Influencer.Influencer_My_Followers', ['getMyFollower' => $getMyFollower, 'getMyUserFollower' => $getMyUserFollower]);
    }

    public function Refer_A_Friend()
    {
        return view('Influencer.Refer_A_Friend');
    }

    public function Influencer_My_Live_Stream($id, Request $request)
    {
        $streamdata = StreamManagement::where('influencer_id', Session::get('user_id'))
            ->where('streamDate', '>', date('Y-m-d'))
            ->where('streamTime', '>', date('H:i:s'))
            ->where('bid_end_status', 2)
            ->get();

        $streamdataDetail   = StreamManagement::where('id', $id)->first();
        $getLastBid         = Bid::where('stream_id', $id)->latest()->first();

        if (!empty($streamdataDetail)) {
            $data['uid']        = $streamdataDetail->id;
            $data['channel']    = 'live_' . $streamdataDetail->id;
            $data['token']      = $this->getToken($data['channel'], '');
            $data['resourceId'] = $this->init_recording($data['channel'], $data['uid']);

            // StreamManagement::where('id', $id)->update(['status' => 'Activate']);

            // Check current status before updating
            if ($streamdataDetail->status !== 'Activate') {
                StreamManagement::where('id', $id)->update(['status' => 'Activate']);

                //Create Notification for each user
                $notifyData = Notify::where('stream_id', $id)->get();

                foreach ($notifyData as $notify) {
                    $userId = $notify->user_id;

                    // Create Notification for each user
                    Notification::create([
                        'user_id' => $userId,
                        'influencer_id' => $streamdataDetail->influencer_id,
                        'title' => 'Live Stream Started',
                        'message' => $streamdataDetail->streamTitle . ' has been Live',
                        'seen_status' => 0,
                    ]);
                }
            }

            return view('Influencer/Influencer_My_Live_Stream', compact('streamdata', 'streamdataDetail', 'getLastBid', 'data'));
        }
    }

    public function go_live()
    {
        $data['channel']    = 'live_' . Session::get('user_id');
        $data['uid']        = '';
        $data['token']      = $this->getToken($data['channel'], $data['uid']);

        //Create Go Live Notification
        $followers = Follower::with('getInfluencer')->where('following_id', Session::get('user_id'))->get();

        foreach ($followers as $follower) {
            $userId = $follower->user_id;
            $influencerName = $follower->getInfluencer->name;

            // Create notification
            Notification::create([
                'user_id' => $userId,
                'influencer_id' => Session::get('user_id'),
                'title' => 'Live Now',
                'message' => $influencerName . ' has Live Now',
                'seen_status' => 0,
            ]);
        }

        return view('Influencer/go_live', compact('data'));
    }

    public function video_chat($id = '')
    {
        if ($id) {
            $user       = User::where('id', $id)->first();
            $influencer = User::where('id', Session::get('user_id'))->first();

            if (!empty($user)) {
                $data['uid']        = '';
                $data['channel']    = 'video_' . Session::get('user_id') . '_' . $id;
                $data['token']      = $this->getToken($data['channel'], $data['uid']);

                return view('Influencer/videoChat', compact('data', 'user', 'influencer'));
            }
        }
    }

    public function exportTransection(Request $request)
    {
        $transection = Transection::with(['getStream', 'getUser', 'getInfu']);
        if (isset($request->filter_date)) {

            $components = preg_split("/-/", $request->filter_date, -1,);
            $start_date_signup = trim($components[0]);
            $end_date_signup = trim($components[1]);
            $end_date_signup = Carbon::parse($end_date_signup)->addDay()->format('m/d/Y');
            $transection = $transection->whereBetween('date_time', [
                date(Carbon::createFromFormat('m/d/Y', $start_date_signup)->format('Y-m-d')),
                date(Carbon::createFromFormat('m/d/Y', $end_date_signup)->format('Y-m-d'))
            ]);
        }
        $transection = $transection->get();
        $i = 1;
        $array = [];
        foreach ($transection as $row) {
            $array[] = array(
                'sr_no' => $i++,
                'user_name' => $row->getUser->name ? $row->getUser->name : '',
                'date_time' => date("D,M d, Y H:i:s", strtotime($row->date_time)),
                'description' => 'Lorem Ipsum is simply',
                'status' => 'Online',
                'amount' => '+$' . $row->amount

            );
        }
        $headearray = array('Sr.No.', 'User Name', 'Date & Time', 'Description', 'Status', 'Amount');
        $this->exportCsv($array, $headearray, $fileName = 'transection');
    }

    public function exportCsv($dataarray, $headearray, $fileName)
    {
        $filename = $fileName . '_' . rand() . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen("php://output", "w");
        fputcsv($output, $headearray);
        foreach ($dataarray as $row) {

            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }

    public function Influencer_My_Stream_Detail(Request $request)
    {
        $Notify = Notify::where('user_id', Session::get('user_id'))->get();
        $currentDate = date('Y-m-d');

        $streamData = StreamManagement::where('id', $request->stream_id)->with('getInfluencers')->first();

        $streamData['videoUrl'] = '';
        if (!empty($streamData)) {
            if ($streamData['recorded']) {
                $data = json_decode($streamData['fileList'], true);
                if (!empty($data)) {
                    $streamData['videoUrl'] = 'https://tidbidstore.s3.us-east-2.amazonaws.com/' . $data[0]['fileName'];
                }
            } else {
                $streamData['videoUrl'] = 'https://tidbidstore.s3.us-east-2.amazonaws.com/' . $streamData->sid . '_live_' . $streamData->id . '_0.mp4';
            }
        }

        $paststream = StreamManagement::where('influencer_id', $streamData->influencer_id)
            ->with('getInfluencers')
            ->where('id', '!=', $request->stream_id) // Corrected: Changed whereNotIn to where
            ->where('streamDate', '<', $currentDate)
            ->orderBy('streamDateTime', 'DESC')
            ->get();

        $upcomming_stream = StreamManagement::where('influencer_id', $streamData->influencer_id)
            ->where('streamDate', '>', $currentDate)
            ->get();

        $checkFollow = Follower::where('user_id', Session::get('user_id'))->where('following_id', $streamData->influencer_id)->first();

        return view('Influencer.Influencer_My_Stream_Detail', compact('paststream', 'upcomming_stream', 'streamData', 'checkFollow', 'Notify'));
    }

    public function post_commnet(Request $request)
    {
        $addComment = PostComment::create([
            'post_id' => $request->postid,
            'comment' => $request->commentValue,
            'user_id' => Session::get('user_id')
        ]);
        if ($addComment) {
            $PostComment = PostComment::where('post_id', $request->postid)->count();
            return response()->json(['status' => true, 'totalComment' => $PostComment,  'message' => 'Comment added successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function post_like(Request $request)
    {
        $PostLike  = PostLike::where('user_id', Session::get('user_id'))->where('post_id', $request->postid)->first();
        if (!empty($PostLike)) {

            $PostLike = PostLike::where('user_id', Session::get('user_id'))->where('post_id', $request->postid)->delete();
            $Postlike = PostLike::where('post_id', $request->postid)->count();
            return response()->json(['status' => 2, 'totalLike' => $Postlike, 'message' => 'Unlike successfully']);
        }
        $likeyou = PostLike::create([
            'post_id' => $request->postid,
            'user_id' => Session::get('user_id')
        ]);
        if ($likeyou) {
            $Postlike = PostLike::where('post_id', $request->postid)->count();
            return response()->json(['status' => 1, 'totalLike' => $Postlike,   'message' => 'You have like successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    /** bookMark */
    public function add_post_book_mark(Request $request)
    {
        $PostBookMark  = PostBookMark::where('user_id', Session::get('user_id'))->where('post_id', $request->postid)->first();
        if (!empty($PostBookMark)) {
            $PostLike = PostBookMark::where('user_id', Session::get('user_id'))->where('post_id', $request->postid)->delete();
            return response()->json(['status' => 2,  'message' => 'Post removed on bookmark successfully']);
        }
        $likeyou = PostBookMark::create([
            'post_id' => $request->postid,
            'user_id' => Session::get('user_id')
        ]);
        if ($likeyou) {
            return response()->json(['status' => 1,   'message' => 'You have bookmared successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
        }
    }

    /** follow user */
    public function FollowerUser(Request $request)
    {
        $influencerId = $request->influencerId;
        $userId = Session::get('user_id');

        $user = User::where('id', $userId)->first();
        $userName = $user->name;

        if ($influencerId != '') {
            $checkFollow  = Follower::where('user_id', $userId)->where('following_id',  $influencerId)->first();
            if (!empty($checkFollow)) {
                $PostLike = Follower::where('user_id', $userId)->where('following_id',  $influencerId)->delete();
                return response()->json(['status' => 2,  'message' => 'You have Un-follow successfully']);
            }

            // Prevent user from following themselves
            if ($influencerId == $userId) {
                return response()->json(['status' => 0, 'message' => 'You cannot follow yourself']);
            } else {
                $influencer = Follower::create([
                    'following_id' => $influencerId,
                    'user_id' => $userId,
                    'role' => $request->role,
                ]);

                //Create Follow Notification that show on the Influencer Profile or When Influencer Login
                Notification::create([
                    'user_id' => $influencerId,
                    'influencer_id' => $userId,
                    'title' => 'Follow Notification',
                    'message' => $userName . ' started following you',
                    'seen_status' => 0
                ]);

                if ($influencer) {
                    return response()->json(['status' => 1, 'message' => 'You have follow successfully']);
                } else {
                    return response()->json(['status' => 0, 'message' => 'Something went wrong']);
                }
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'influencer Id is missing']);
        }
    }


    /** Follower Remove */
    public function remove_follower(Request $request)
    {
        $remove = Follower::where('id',  $request->id)->delete();
        if ($remove) {
            return response()->json(['status' => 2,  'message' => 'You have Un-follow successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
        }
    }


    /** Influencer Suggested */
    public function Suggest_Influencer(Request $request)
    {
        //dd($request->influencerId);
        $check  = SuggestInfluencer::where('influencer_id', Session::get('user_id'))->where('suggest_influencer_id',  $request->influencerId)->first();
        if (!empty($check)) {
            $PostLike = SuggestInfluencer::where('influencer_id', Session::get('user_id'))->where('suggest_influencer_id',  $request->influencerId)->delete();
            return response()->json(['status' => 2,  'message' => 'You have Un-suggest successfully']);
        }
        $addSuggest = SuggestInfluencer::create([
            'influencer_id' =>  Session::get('user_id'),
            'suggest_influencer_id' => $request->influencerId,
        ]);
        if ($addSuggest) {
            return response()->json(['status' => 1,  'message' => 'You have suggest successfull this Influencer']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
        }
    }


    /** Influencer Live Stream Join  */
    public  function joinStreeming(Request $request)
    {
        return view('agora.index');
    }


    /** Influencer Post Bookmark */
    public function Influencer_Bookmark(Request $request)
    {
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $userId = Session::get('user_id');

        // Fetch livestreams for today with streamTime later than the current time
        $livestream = StreamManagement::whereDate('streamDate', $currentDate)
            ->whereTime('streamTime', '>', now()) // Using 'now()' directly for the current datetime
            ->get();

        // Fetch blocked posts and bookmarks for the current user
        $getBlockPost = BlockPost::where('user_id', $userId)->get();
        $getBookMark = PostBookMark::where('user_id', $userId)->get();

        // Fetch user profile
        $userProfile = User::find($userId);

        // Fetch posts with necessary relations and counts
        $postData = Post::with('images')
            ->with(['likes.user' => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1); // Retrieve the last like
            }])
            ->withCount(['countComent', 'countLike'])
            ->get();

        // Transform the post data collection
        $postData->transform(function ($post) {
            $post->post_id = $post->id;
            $post->liked_by_user = $post->userLikePost()->exists();
            $post->bookMark_by_user = $post->PostBookMark()->exists();
            $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
            return $post;
        });

        // Return the view with the necessary data
        return view('Influencer.Influencer_Bookmark', compact('postData', 'livestream', 'getBlockPost', 'userProfile', 'getBookMark'));
    }



    /** Influencer Stream Notify */
    public function notifyMe(Request $request)
    {

        if ((Session::get('user_id') == '')) {
            return response()->json(['status' => 0, 'message' => 'Please login to Subscribed this Stream']);
        }
        if ($request->events == 'notify') {
            $delete = Notify::where('stream_id', $request->stream_id)->where('user_id', Session::get('user_id'))->delete();
        } else {
            $add = Notify::create([
                'user_id' => Session::get('user_id'),
                'stream_id' => $request->stream_id,
            ]);
        }

        if (isset($add) && $add)
            return response()->json(['id' => $request->stream_id, 'status' => 1,  'message' => 'You have add in your Notify']);
        if (isset($delete) && $delete)
            return response()->json(['id' => $request->stream_id, 'status' => 2,  'message' => 'You have been Subscribed']);
        else
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
    }

    /** Influencer Chat */
    public function InfuSendMessage(Request $request)
    {
        $add = AgoraMessage::create([
            'channel_id'    => $request->channelId,
            'reciver_id'    => $request->receiverId,
            'sender_id'     => Session::get('user_id'),
            'message'       => $request->message,
            'side'          => 'right',
        ]);

        if ($add) {
            return response()->json(['status' => 1, 'message' => 'message is send']);
        } else {
            return response()->json(['status' => 0, 'message' => 'message sending field']);
        }
    }

    //working from 23-09-2024
    public function Influencer_Chat($id = '')
    {
        $dataGetAgoraLogin  = User::where('id', Session::get('user_id'))->first();
        $data['token']      = $this->getChatToken($dataGetAgoraLogin->agora_id);

        $AgoraMessage = []; // Default empty array for AgoraMessage
        $checkChanel = null; // Default null for checkChanel

        if ($id) {
            $valid = User::where('id', $id)->first();
            if (!empty($valid)) {
                $channelName = 'user_' . $id . '_inf_' . Session::get('user_id');
                $checkChanel = AgoraChat::where('chanel_name', $channelName)->first();

                if (empty($checkChanel)) {
                    AgoraChat::create([
                        'sender_id'     => $id,
                        'reciver_id'    => Session::get('user_id'),
                        'chanel_name'   => $channelName,
                    ]);
                }

                $getInfuList = AgoraChat::with(['getsender', 'getUserLastMessage'])->where('reciver_id', Session::get('user_id'))->get();

                // Chat Message(27/09/2024)
                $checkChanel = AgoraChat::where('chanel_name', $getInfuList[0]->chanel_name)->first();
                $AgoraMessage = AgoraMessage::where('channel_id', $getInfuList[0]->chanel_name)->get();

                return view('Influencer.Influencer_Chat', compact('getInfuList', 'dataGetAgoraLogin', 'data', 'id', 'AgoraMessage', 'checkChanel'));
            }
        }

        $getInfuList = AgoraChat::with(['getsender', 'getUserLastMessage'])->where('reciver_id', Session::get('user_id'))->get();

        return view('Influencer.Influencer_Chat', compact('getInfuList', 'dataGetAgoraLogin', 'data', 'id', 'AgoraMessage', 'checkChanel'));
    }

    public function getMessage(Request $request)
    {
        $user_id    = $request->user_id;
        $data = User::where('id', $user_id)->select('profile_img')->first();

        $chanelName = 'user_' . $user_id . '_inf_' . Session::get('user_id');

        $checkChanel = AgoraChat::where('chanel_name', $chanelName)->first();

        if (!$checkChanel) {
            return response()->json(['error' => 'Channel not found.']);
        }

        $AgoraMessage = AgoraMessage::where('channel_id', $checkChanel->chanel_name)->paginate(10000);

        $html = '';
        foreach ($AgoraMessage as $item) {
            if ($item->side == 'right') {
                $html .= '<div class="message my-message"> 
                    <div class="userimg"><img src="' . asset('Influencer/images/profile_img/' . $data->profile_img) . '" alt=""></div>
                    <div class="usertext">
                        <p>' . $item->message . '</p>
                    </div>
                    <span>' . $item->created_at->format('h:i A') . '</span>
                </div>';
            }

            if ($item->side == 'left') {
                $html .= '
                <div class="message frnd-message">
                    <div class="userimg"><img src="' .  asset('Influencer/images/profile_img/' . $data->profile_img) . '" alt=""></div>
                    <div class="usertext pinkbox">
                        <p>' . $item->message . '</p>
                    </div>
                    <span>' . $item->created_at->format('h:i A') . '</span>
                </div>';
            }
        }

        return response()->json([
            'data' => $html,
            'next_page_url' => $AgoraMessage->nextPageUrl()
        ]);
    }

    public function getLastMessageInf(Request $request)
    {
        $user_id    = $request->user_id;

        $chanelName = 'user_' . $user_id . '_inf_' . Session::get('user_id');

        $checkChanel = AgoraChat::where('chanel_name', $chanelName)->first();

        if (!$checkChanel) {
            return response()->json(['error' => 'Channel not found.']);
        }

        $lastMessage = AgoraMessage::where('channel_id', $checkChanel->chanel_name)->orderBy('created_at', 'desc')->first();

        if (!$lastMessage) {
            return response()->json(['lastMessage' => '', 'lastMessageTime' => '']);
        }

        return response()->json([
            'lastMessage' => $lastMessage->message,
            'lastMessageTime' => $lastMessage->created_at->format('h:i A')
        ]);

        // return response()->json(['lastMessage' => '', 'lastMessageTime' => '']);
    }
    //working from 23-09-2024

    /** Socail Plateform Varification */
    public function InfluencerVerification(Request $request)
    {

        $userId = Session::get('user_id');
        $data = InfluencerIdVerification::where('user_id', $userId)->update(array('otp' => 25364));

        $check = InfluencerIdVerification::where('user_id', $userId)->where('status', 'Activate')->first();
        if (!empty($check)) {
            return redirect('/influencer-my-profile');
        } else {
            $data = [];
            return view('Influencer.influencer_social_verification', ['verification' => $data])->withErrors(['error' => 'Your account is inactive. Please contact support.']);
        }
    }
    public function checkSocialVerification(Request $request)
    {
        $userId = Session::get('user_id');

        // Retrieve the verification records for the user as a collection
        $getVerification = InfluencerIdVerification::where('user_id', $userId)->get();
        foreach ($getVerification as $row) {
            if ($row->verificationPlatform == 'youtube' && $row->status == 'Inactive') {
                return response()->json(['status' => 1,  'message' => 'ok', 'type' => 'youtube']);
            } else  if ($row->verificationPlatform == 'instagram' && $row->status == 'Inactive') {
                return response()->json(['status' => 1,  'message' => 'ok', 'type' => 'instagram']);
            } else  if ($row->verificationPlatform == 'tik-tok' && $row->status == 'Inactive') {
                return response()->json(['status' => 1,  'message' => 'ok', 'type' => 'tik-tok']);
            } else if ($row->verificationPlatform == 'snapchat' && $row->status == 'Inactive') {
                return response()->json(['status' => 1,  'message' => 'ok', 'type' => 'snapchat']);
            } else if ($row->verificationPlatform == 'x-twitter' && $row->status == 'Inactive') {
                return response()->json(['status' => 1,  'message' => 'ok', 'type' => 'x-twitter']);
            } else {
                return response()->json(['status' => 0,  'message' => 'All social id is verify', 'type' => 'verified']);
            }
        }
    }

    public function New_Add_Bank()
    {
        return view('Influencer.add_banks');
    }

    public function infusendLiveComment(Request $request)
    {
        $createComment = LivestreamComment::create([
            'user_id' => Session::get('user_id'),
            'stream_id' => $request->stream_id,
            'comment' => $request->commentcontent,
        ]);
        if ($createComment) {
            return response()->json([
                'success' => 'Comment added successfully',
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => 'Comment added successfully',
                'status' => 1,
            ]);
        }
    }

    /** get live stream comment  */
    public function InfuLiveStreamComment(Request $request)
    {
        $comment_html   = '';
        $stream_id      = $request->stream_id;
        $lastBid        = Bid::with(['getUser'])->where('stream_id', $stream_id)->orderBy('id', 'desc')->first();
        $comments       = LivestreamComment::with('user')->where('stream_id', $stream_id)->get();

        if ($comments->isEmpty()) {
            return response()->json(['html' => 'No comments found']);
        }

        foreach ($comments as $comment) {
            $user           = $comment->user;
            $profile_img    = $user && $user->profile_img != '' ? asset('Influencer/images/profile_img/' . $user->profile_img) : asset('user.jpg');
            $user_name      = $user ? $user->name : 'Unknown User';
            $comment_text   = $comment->comment; // Assuming 'comment' is the field name in the table

            $comment_html .= '<div class="comment_text purple">
                <img class="commentProfile" src="' . $profile_img . '" alt="Profile Image">
                ' . $user_name . ' : <p>' . $comment_text . '</p>
            </div>';
        }

        return response()->json(['html' => $comment_html, 'lastBid' => $lastBid]);
    }

    public function get_gift_infu(Request $request)
    {
        // Retrieve gifts along with associated user data for a specific stream
        $SendGift = SendGift::with(['getUser'])
            ->where('stream_id', $request->eventId)
            ->limit(3)
            ->orderBy('id', 'DESC')
            ->get();


        // Initialize dynamic HTML string
        $dynamicHtml = '';

        // Check if there are any gifts
        if (count($SendGift) > 0) {
            // Iterate through each gift and generate corresponding HTML
            foreach ($SendGift as $gift) {
                $userName = $gift->getUser->name;
                $giftAmount = $gift->gift_amt;

                $dynamicHtml .= '
                    <div class="profile_details mt-0">
                    <div class="gift_img"><img src="' . asset('Influencer/images/gift.svg') . '"></div>
                    <div class="gift_dec">
                    <h6>' . htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') . '</h6>
                    <p>$' . htmlspecialchars($giftAmount, ENT_QUOTES, 'UTF-8') . '</p>
                    </div>
                    </div>';
            }
        } else {
            $dynamicHtml .= '<p>No gifts found for this event.</p>';
        }

        // Return the generated HTML as a response
        return response()->json(['html' => $dynamicHtml]);
    }

    public function endBid(Request $request)
    {
        $streamId = $request->id;
        $bid = StreamManagement::find($streamId);

        if (!$bid) {
            return response()->json([
                'success' => false,
                'message' => 'Stream not found.',
            ]);
        }

        if ((int)$bid->bid_end_status == 1) {
            $bid_end_status = 2;
            $message = 'Bid started successfully...';
        } else {
            $bid_end_status = 1;
            $message = 'Bid ended successfully...';

            // Bid Notification for user
            // check maximum bid price on this stream
            $max_bid = Bid::with('getUser')->where('stream_id', $streamId)->orderBy('bid_price', 'desc')->first();

            if ($max_bid) {
                $influencerId = $max_bid->infulencer_id ?? null;
                $userId = $max_bid->user_id;

                // Create notification for the user who won the bid
                Notification::create([
                    'user_id' => $userId,
                    'influencer_id' => $influencerId,
                    'title' => 'Bid Won',
                    'message' => 'You have won the bid on ' . $bid->streamTitle,
                    'seen_status' => 0
                ]);

                // Create notification for the influencer
                $influencerId = $bid->influencer_id;
                $userName = $max_bid->getUser->name;

                Notification::create([
                    'user_id' => $influencerId,
                    'influencer_id' => $userId,
                    'title' => 'Bid Won',
                    'message' => $userName . ' has won the bid on ' . $bid->streamTitle,
                    'seen_status' => 0
                ]);
            }
        }

        $updateResult = StreamManagement::where('id', $streamId)->update(['bid_end_status' => $bid_end_status]);

        if ($updateResult) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong...',
            ]);
        }
    }

    public function joinUserChanel(Request $request)
    {
        PrivateVideo::updateOrCreate(
            [
                'user_id' => $request->userId,
                'stream_id' => $request->streemId
            ],
            [
                'join_url' => $request->getjoinValue
            ]
        );
    }

    private function init_recording($channelName, $uid)
    {
        $body = [
            "cname" => $channelName,
            "uid"   => "" . $uid . "",
            "clientRequest" => [
                "resourceExpiredHour" => 24,
                "scene" => 0
            ],
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.agora.io/v1/apps/' . $this->appId . '/cloud_recording/acquire',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic YTA1MDJlMWQ4ZmJiNDRkMDllZjlhNjBmNmRhOGM1OGY6YmI0MDhjZDg2NWY2NDBiODk1OWMwYmJkYTZlODNmNjM='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if (!empty($data)) {
            return json_decode($response, true)['resourceId'];
        }

        return null;
    }

    //09-10-2024
    public function NotificationInf(Request $request)
    {
        $userId = Session::get('user_id');
        $notifications = Notification::where('user_id', $userId)->orderBy('id', 'desc')->get();

        // Update seen_status to 1 after Clicking on the Bell Icon of notification
        Notification::where('user_id', $userId)->where('seen_status', 0)->update(['seen_status' => 1]);

        $notificationData = $notifications->map(function ($notification) {
            return [
                'title' => $notification->title,
                'message' => $notification->message,
                'created_at' => $notification->created_at->format('d/m/Y | h:i A')
            ];
        });

        return response()->json(['notifications' => $notificationData]);
    }
    
    public function uploadMedia(Request $request) {
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
        return response()->json(['file_url' => asset('storage/' . $path)]);
    }
    return response()->json(['error' => 'No file uploaded'], 400);
    }
    
  
    
     public function uploadVoice(Request $request)
    {
        if ($request->hasFile('voiceMessage')) {
            $file = $request->file('voiceMessage');
            $filename = 'voice_' . time() . '.wav';

            // Save file to storage
            $file->move(public_path('uploads/voices'), $filename);

            return response()->json([
    'message' => 'Voice uploaded successfully!',
    'file_path' => url('uploads/voices/' . $filename)
], 200);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }


}
