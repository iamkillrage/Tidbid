<?php

namespace App\Http\Controllers;

require app_path() . '/Stripe/init.php';

use Stripe\Token;
use Illuminate\Http\{Request, Response};
use Stripe\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Hash, Validator, Auth, Mail};
use Illuminate\Validation\Rule;
use App\Models\{
    User,
    Bid,
    SendGift,
    BlockPost,
    Follower,
    RefferedInfu,
    TermCondition,
    Post,
    SaveCard,
    PrivacyPolicy,
    UserOtp,
    StreamManagement,
    PostComment,
    PostLike,
    PostBookMark,
    Transection,
    LivestreamComment,
    Notify,
    Notification,
    Agore,
    AgoraChat,
    AgoraMessage,
    PrivateVideo
};

use Stripe\Customer;
use Stripe\Stripe;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.user.status');
    }

    //working from 23-09-2024
    function User_Chat($id = '')
    {
        $userData       = User::where('id', Auth::id())->first();
        $data['token']  = $this->getChatToken($userData->agora_id);

        $AgoraMessage = []; // Default empty array for AgoraMessage
        $checkChanel = null; // Default null for checkChanel

        if ($id) {
            $valid = User::where('id', $id)->first();
            if (!empty($valid)) {
                $channelName = 'user_' . Auth::id() . '_inf_' . $id;
                $checkChanel = AgoraChat::where('chanel_name', $channelName)->first();

                if (empty($checkChanel)) {
                    AgoraChat::create([
                        'sender_id'     => Auth::id(),
                        'reciver_id'    => $id,
                        'chanel_name'   => $channelName,
                    ]);
                }

                $getInfuList = AgoraChat::with(['getInfuList', 'getInfuLastMessage'])->where('sender_id', Auth::id())->get();

                // Chat Message(27/09/2024)
                $checkChanel = AgoraChat::where('chanel_name', $getInfuList[0]->chanel_name)->first();
                $AgoraMessage = AgoraMessage::where('channel_id', $getInfuList[0]->chanel_name)->get();

                return view('User.User_Chat', compact('getInfuList', 'id', 'userData', 'data', 'AgoraMessage', 'checkChanel'));
            }
        }

        $getInfuList = AgoraChat::with(['getInfuList', 'getInfuLastMessage'])->where('sender_id', Auth::id())->get();

        return view('User.User_Chat', compact('getInfuList', 'id', 'userData', 'data', 'AgoraMessage', 'checkChanel'));
    }
    //working from 23-09-2024

    public function video_chat($id = '')
    {
        if ($id) {
            $influencer = User::where('id', $id)->first();
            $user       = User::where('id', Auth::id())->first();

            if (!empty($influencer)) {
                $data['uid']        = '';
                $data['channel']    = 'video_' . $id . '_' . Auth::id();
                $data['token']      = $this->getToken($data['channel'], $data['uid']);

                return view('User.videoChat', compact('data', 'user', 'influencer'));
            }
        }
    }

    /** message box */
    public function sendMessage(Request $request)
    {
        $add = AgoraMessage::create([
            'channel_id'        => $request->channelId,
            'reciver_id'        => $request->receiverId,
            'sender_id'         => Auth::id(),
            'message'           => $request->message,
            'side'              => 'left',
        ]);

        if ($add) {
            return response()->json(['status' => 1, 'message' => 'message is send']);
        } else {
            return response()->json(['status' => 0, 'message' => 'message sending field']);
        }
    }

    //working from 23-09-2024
    public function getMessage(Request $request)
    {
        $influencerId   = $request->influencerId;
        //To pass image in the chatbox
        $data = User::where('id', $influencerId)->select('profile_img')->first();
        // $profileImagePath = asset('Influencer/images/profile_img/' . $data->profile_img);
        $profileImagePath = !empty($data) ? asset('Influencer/images/profile_img/' . $data->profile_img) : asset('path/to/default-image.jpg');


        $chanelName     = 'user_' . Auth::id() . '_inf_' . $influencerId;

        $checkChanel = AgoraChat::where('chanel_name', $chanelName)->first();

        if (!$checkChanel) {
            return response()->json(['error' => 'Channel not found.']);
        }

        $AgoraMessage = AgoraMessage::where('channel_id', $checkChanel->chanel_name)->paginate(10000);

        $html = '';
        foreach ($AgoraMessage as $item) {
            if ($item->side == 'left') {
                $html .= '<div class="message my-message">
                    <div class="userimg"><img src="' . $profileImagePath . '" alt=""></div>
                    <div class="usertext">
                        <p>' . $item->message . '</p>
                    </div>
                    <span>' . $item->created_at->format('h:i A') . '</span>
                </div>';
            }

            if ($item->side == 'right') {
                $html .= '<div class="message frnd-message">
                    <div class="userimg"><img src="' . $profileImagePath . '" alt=""></div>
                    <div class="usertext pinkbox">
                        <p>' . $item->message . '</p>
                    </div>
                    <span>' . $item->created_at->format('h:i A') . '</span>
                </div>';
            }
        }

        return response()->json(['data' => $html, 'next_page_url' => $AgoraMessage->nextPageUrl()]);
    }

    public function getLastMessage(Request $request)
    {
        $influencerId   = $request->influencerId;

        $chanelName     = 'user_' . Auth::id() . '_inf_' . $influencerId;

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

    // User Sign In Page Open
    function SignIn()
    {
        return view('User.Sign_in');
    }

    // User Sign Up Page Open
    function SignUp()
    {
        return view('User.Sign_up');
    }

    // User Sign Up OTP Generate
    public function generateOTP()
    {
        return random_int(10000, 99999);
    }

    private function create_customer($email)
    {
        // Set your secret API key
        # 
        \Stripe\Stripe::setApiKey('secret API key');

        try {
            $customer = \Stripe\Customer::create([
                'email' => $email,
                'name' => 'TidBid',
                'description' => 'Create customer'
            ]);

            return $customer->id;
        } catch (\Stripe\Exception\CardException $e) {
            // Card error
            echo 'Card error: ' . $e->getMessage();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid request
            echo 'Invalid request: ' . $e->getMessage();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication error
            echo 'Authentication error: ' . $e->getMessage();
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network error
            echo 'Network error: ' . $e->getMessage();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Stripe API error
            echo 'Stripe API error: ' . $e->getMessage();
        }
    }

    public function Userregistration2(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        $customerId = $this->create_customer($request->email);
// dd($customerId);
        $createUser = User::create([
            'customer_id'   => $customerId,
            'email'         => $request->email,
            'password'      => $request->password,
            'role'          => 'User',
            'referral_code' => Str::random(6)
        ]);
//   dd($createUser);
        if ($createUser) {
            
            $otp = $this->generateOTP();
             $mailData['otp'] = $otp;
           $dtaone =  Mail::to($createUser->email)->send(new \App\Mail\MyTestMail($mailData));
         
            $this->createAgoraAccount('user' . $createUser->id, 'User');

            User::where('id', $createUser->id)->update(['agora_id' => 'user' . $createUser->id]);

            UserOtp::create([
                'user_id'       => $createUser->id,
                'otp'           => $otp,
                'otp_date_time' => date('Y-m-d h:i:s'),
            ]);
           


            if (!empty($request->refer_code)) {
                $getInfu = User::where('referral_code', $request->refer_code)->first();

                if (!empty($getInfu)) {
                    RefferedInfu::create([
                        'user_id'           => $getInfu->id,
                        'refered_user_id'   => $createUser->id
                    ]);
                } else {
                    return response()->json(['error' => 'This refer code is inactive', 'status' => 0]);
                }
            }
            return response()->json([
                'success'   => 'Form submitted successfully',
                'status' => 1,
                'otp'       => $otp,
                'user_id'   => $createUser->id
            ]);
        } else {
            return response()->json(['error' => 'something is wrong', 'status' => 0]);
        }
    }

    // User Forget Password
    public function Userforgotpassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        try {
            $userdata = User::query()->where(['email' => $request->email])->orwhere('email', $request->email)->first();
            if ($userdata) {
                $data['user_id'] = $userdata->id;
                $otp = $this->generateOTP();
                $mailData['otp'] = $otp;
                $data['otp'] =  $otp;
                $data['otp_date_time'] = date('Y-m-d h:i:s');
                if (is_numeric($request->email)) {
                } else {
                    Mail::to($request->email)->send(new \App\Mail\MyTestMail($mailData));
                }
                UserOtp::create($data);

                return response()->json(['status' => 1, 'user_id' => $userdata->id, 'otp' => $otp, 'message' => 'OTP send successfully']);
            } else {
                return response()->json(['status' => 0, 'message' => 'This Email not Register']);
            }
            // }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    // User Forget Password OTP Varify
    public function UserOtpVerify(Request $request)
    {
        $userId = $request->userId;
        $otp    = $request->otp;
        // dd($userId);
        if ($otp != '') {
            $UserOtp = UserOtp::where('user_id', $userId)->latest()->first();
            if ($otp == $UserOtp->otp) {
                $user = User::find($request->userId);
                auth()->login($user);
                $user = User::where('id', $request->userId)->update(['status' => 'Activate']);
                return response()->json(['success' => 'your otp matched successfully', 'status' => 1]);
            } else {
                return response()->json(['error' => 'please enter valid otp', 'status' => 0]);
            }
        }
    }
    // User Password Reset
    public function Userresetpassword(Request $request)
    {
        $userId = $request->userId;
        $otp    = implode($request->otp);
        if ($otp != '') {
            $UserOtp = UserOtp::where('user_id', $userId)->latest()->first();
            // dd($UserOtp);
            if ($otp == $UserOtp->otp) {
                // dd($otp);
                return response()->json(['success' => 'your otp matched successfully', 'user_id' => $userId, 'status' => 1]);
            } else {
                return response()->json(['error' => 'please enter valid otp', 'status' => 0]);
            }
        } else {
            return response()->json(['error' => 'OTP is required', 'status' => 0]);
        }
    }
    // User Reset Password Confirm
    public function Userresetpasswordconfirm(Request $request)
    {

        $request->validate([
            'userId' => 'required',
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirm_password' => 'required_with:password|same:password|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ]);

        $userId = $request->userId;
        if ($request->password !== $request->confirm_password) {
            return response()->json(['status' => 'error', 'message' => 'password does not match']);
        }
        $user = User::where('id', $userId)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found']);
        }

        // Update user's password with the hashed new password
        $user->password = Hash::make($request->confirm_password);
        $user->save();

        // Return success response
        return response()->json(['status' => 'success']);
    }


    // User Login
    public function Userlogin(Request $request)
    {

        $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            if (Auth::user()->email_verified_at !== null) {
                return response()->json(['status' => 0, 'message' => 'Your email is not verify, so please verify email']);
            }
            if (Auth::user()->status == 'Inactive') {
                return response()->json(['status' => 0, 'message' => 'Your account is inactive please contact to admin..']);
            }
            if (Auth::user()->role == 'Influencer') {
                return response()->json(['status' => 0, 'message' => 'Your account not register as tidbid user']);
            }
            $request->session()->put('login_is', 'yes');
            // Authentication passed...
            return response()->json(['status' => 1, 'message' => 'Login successful']);
        }
        return response()->json(['status' => 0, 'message' => 'Invalid email or password']);
    }


    // User after login Open User index page
    /**
     * User home page ofter login
     */
    function User_Home(Request $request)
    {
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        $streamdata = StreamManagement::where('bid_end_status', 2)
            ->whereDate('streamDate', '=', $currentDate)
            ->whereTime('streamTime', '<=', $currentTime)
            ->where('status', 'Activate')
            ->get();

        $getBlockPost   = BlockPost::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        $PostBookMark   = PostBookMark::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        $postLike       = PostLike::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        $userProfile    = User::where('id', Auth::user()->id)->first();

        $postData = Post::with(['images', 'getInfluencers', 'user'])
            ->with(['likes.user'  => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1); // Retrieve the last like
            }])
            ->withCount(['countComent', 'countLike']);

        if ($request->ajax()) {
            $postData = $postData->paginate(1);
            $postData->getCollection()->transform(function ($post) {
                $post->post_id = $post->id;
                $post->liked_by_user = $post->userLikePost()->exists();
                $post->bookMark_by_user = $post->PostBookMark()->exists();
                $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
                $post->likes_data = $post->likes->map(function ($like) {
                    return [
                        'user_name' => isset($like->user->name) ? $like->user->name : '',
                        'user_profile_image' => isset($like->user->profile_img) ? $like->user->profile_img : '',
                    ];
                });
                return $post;
            });


            $view = view('User.partialPage.User_Home_partial', compact('postData', 'postLike', 'getBlockPost', 'userProfile', 'PostBookMark'))->render();
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

        return view('User.User_Home', compact('streamdata', 'postLike', 'postData', 'getBlockPost', 'userProfile', 'PostBookMark'));
    }

    // User Profile Edit
    public function User_Profile()
    {
        try {
            $useralldeatils = Auth::user();
            return view('User.User_My_Profile',  compact('useralldeatils'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

     function User_My_profile_Create(Request $request)
    {
        $user = auth()->user();
        $isnew = 1;
        if($user->name)
        
        {
            $isnew = 0;
        }
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => '',
            'phone' => 'required|string|digits:10',
            'dob' => 'required|date_format:m-d-Y',
        ];


        if (!$user->profile_img) {
            $validationRules['profile_img'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        $customMessages = [
    'phone.required' => 'please enter a valid number',
    'phone.digits' => 'please enter a valid number', // Custom message for 10-digit validation
];

        $validatedData = $request->validate($validationRules, $customMessages);
        if ($validatedData === false) {
            return response()->json(['error' => 'Failed to validate profile details'], 400);
        } else {
            $user = auth()->user();
            $imageName = null;

            if ($request->hasFile('profile_img') && $request->file('profile_img')->isValid()) {
                $profile_img = $request->file('profile_img');
                $imageName = time() . '_' . $profile_img->getClientOriginalName();
                $profile_img->move(public_path('Influencer/images/profile_img'), $imageName);
            }
            try {
                $formattedDate = Carbon::createFromFormat('m-d-Y', $request->input('dob'))->format('Y-m-d');

                $user  = User::where('id', auth()->user()->id)->update([

                    'name' => $validatedData['name'],
                    // 'email' => $validatedData['email'],
                    'phone' =>  $validatedData['phone'],
                    'dob' => $formattedDate,
                    'profile_img' => $imageName ? $imageName :  $user->profile_img,
                    'profile_status' => 'Complete',
                ]);
        
                return redirect()->route('User_Profile')->with('success', 'Profile updated successfully.')->with('isnew', $isnew);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred while updating profile details');
            }
        }
    }
    
    


    // User Logout
    public function Userlogout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/user-signIn');
    }


    // User Terms Condition
    public function User_Terms_Condition()
    {
        try {
            $data = TermCondition::first();
            return view('User.User_term_and_condition', compact('data'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // User Privacy Policy
    public function User_Privacy_policy()
    {
        try {
            $data = PrivacyPolicy::first();
            return view('User.User_Privacy_Policy', ['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function User_Payment_Method()
    {

        return view('User.User_Payment_Method');
    }

    public function User_No_Save_Card()
    {
        $cardAllData = [];
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $SaveCard  = SaveCard::where('user_id', Auth::user()->id)->get();
        if (count($SaveCard) != 0) {
            foreach ($SaveCard as $val) {
                $paymentMethod = PaymentMethod::retrieve($val->card_id);

                $cardAllData[] = [
                    'brand' => $paymentMethod->card->brand,
                    'exp_month' => $paymentMethod->card->exp_month,
                    'exp_year' => $paymentMethod->card->exp_year,
                    'last4' => $paymentMethod->card->last4,
                    'cardholdername' => $paymentMethod->billing_details->name ? $paymentMethod->billing_details->name : "",
                    'card_default' => $val->card_default,
                    'id' => $val->id,
                ];
            }
        }

        return view('User.User_Payment_method', ['SaveCard' => $cardAllData]);
    }

    public function add_card(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',

        ]);

        //  dd($request->all());
        if ($validator->fails())
            return $this->sendError($validator->messages(), []);
        try {
            $token = $this->createToken($request);
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $customer = \Stripe\Customer::create(array(
                'source'   => $token->id,
                'email'    =>   Auth::user()->email
            ));
            // dd($customer->name, $customer->id);

            $data = SaveCard::create([
                'user_id' => Auth::user()->id,
                'customer_id' => $customer['id'],
                'card_id'     => $customer['default_source'],
            ]);
            return response()->json(['success' => true, 'status' => 1]);
        } catch (\Exception $e) {
            //  dd($e->getMessage());
            return response()->json(['errormessage' => $e->getMessage(), 'status' => 2], 500);
        }
    }

    private function createToken($cardData)
    {
        $token = null;

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        try {
            $token = \Stripe\Token::create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv'],
                    'name' => $cardData['fullName']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }


    public function delete_card(Request $request)
    {
        $daleteCard = SaveCard::where('id', $request->cardId)->delete();
        if ($daleteCard) {
            return response()->json(['status' => 1,  'message' => 'Card deleted successfully..']);
        } else {
            return response()->json(['status' => 0,  'message' => 'Something is wrong..']);
        }
    }


    public function User_My_Transactions(Request $request)
    {


        $transection = Transection::with(['getStream', 'getUser', 'getInfu']);
        if (isset($request->datefilter)) {

            $components = preg_split("/-/", $request->datefilter, -1,);
            $start_date_signup = trim($components[0]);
            $end_date_signup = trim($components[1]);
            $end_date_signup = Carbon::parse($end_date_signup)->addDay()->format('m/d/Y');
            $transection = $transection->whereBetween('date_time', [
                date(Carbon::createFromFormat('m/d/Y', $start_date_signup)->format('Y-m-d')),
                date(Carbon::createFromFormat('m/d/Y', $end_date_signup)->format('Y-m-d'))
            ]);
        }
        $transection = $transection->where('user_id', Auth::user()->id);
        $transection = $transection->paginate(10);
        return view('User.User_Transaction', compact('transection'));
    }


    public function exportUserTransection(Request $request)
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
        $transection = $transection->where('user_id', Auth::user()->id);
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
                'amount' => '+$' . $row->amount,


            );
        }
        $headearray = array('Sr.No.', 'User Name', 'Date & Time', 'Description', 'Status', 'Amount');
        $this->exportCsv($array, $headearray, $fileName = 'transaction');
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


    public function getDownload()
    {
        $file = "./download/info.pdf";
        return Response::download($file);
    }


    public function User_Refer_Friends()
    {
        return view('User.User_Refer_Friend');
    }


    function User_Upcoming_Stream(Request $request)
    {

        $streamdata     = StreamManagement::whereHas('notify')->whereDate('streamDateTime', '<=', now()->toDateString())->where('status', 'Activate')->where('bid_end_status', 2)->latest()->limit(4)->get();
        $tomorrowdata   = StreamManagement::whereHas('notify')->whereDate('streamDate', '=', now()->addDay())->limit(4)->get();

        $monthdata = StreamManagement::whereHas('notify')
            ->whereYear('streamDate', now()->year)
            ->whereMonth('streamDate', now()->month)
            ->whereDate('streamDate', '>=', now()->toDateString())
            ->where('bid_end_status', 2)
            ->limit(4)
            ->get();

        $user_id    = Auth::id();
        $Notify     = Notify::where('user_id', $user_id)->get();

        $morestream = StreamManagement::with('getInfluencer')->whereHas('notify')->whereDate('streamDate', '>=', now()->toDateString())
            ->orderBy('streamDate', 'asc')
            ->orderBy('streamTime', 'asc');

        if ($request->ajax()) {
            if (isset($request->eventdate)) {
                $dates      = explode("-", $request->eventdate);
                $startDate  = date('Y-m-d', strtotime($dates[0]));
                $endDate    = date('Y-m-d', strtotime($dates[1]));

                // Ensure the dates are valid before using them in the query
                if ($startDate && $endDate) {
                    $morestream = $morestream->whereBetween('streamDate', [$startDate, $endDate])->get();
                }
            }

            return response()->json([
                'tomorrowdata' => $tomorrowdata,
                'streamdata' => $streamdata,
                'monthdata' => $monthdata,
                'morestream' => $morestream,
                'Notify' => $Notify
            ]);
        }

        $morestream = $morestream->get();
        return view('User.User_upcoming_stream', compact('tomorrowdata', 'streamdata', 'monthdata', 'morestream', 'Notify'));
    }


    function User_About_Us()
    {
        return view('User.User_about_us');
    }



    function User_Following()
    {
        $user_id = Auth::id();
        $followerData = Follower::with('getInfluencer')->where('user_id', $user_id)->get();


        return view('User.User_following', compact('followerData'));
    }

    function UserLiveStream($id)
    {
        $data['channel']    = 'live_' . $id;
        $data['uid']        = '';
        $data['token']      = $this->getToken($data['channel'], $data['uid']);

        $streamdata = StreamManagement::with(['getInfluencer'])->where('id', $id)->first();
        $Notify     = Notify::where('user_id', auth()->id())->get();

        if (!empty($streamdata)) {
            $checkFollow = Follower::where('role', 'User')
                ->where('user_id', auth()->id())
                ->where('following_id', $streamdata->getInfluencer->id)
                ->first();

            $upcoming = StreamManagement::where('influencer_id', $streamdata->influencer_id)
                ->where('streamDate', '>=', date('Y-m-d'))
                ->where('bid_end_status', 2)
                ->get();

            $lastBid    = Bid::with(['getUser'])->where('stream_id', $id)->orderBy('id', 'desc')->first();
            $saveCard   = SaveCard::where('user_id',  Auth::user()->id)->get();

            return view('User.User_Live_Stream', compact('streamdata', 'saveCard', 'upcoming', 'lastBid', 'Notify', 'checkFollow', 'data'));
        }
    }

    function User_Auction($id)
    {
        $streamdata = StreamManagement::with(['getInfluencer'])->where('id', $id)->first();
        $lastBid = Bid::with(['getUser'])->where('stream_id', $id)->orderBy('id', 'desc')->first();
        return view('User.User_Auction', compact('streamdata', 'lastBid'));
    }

    public function remove_follower(Request $request)
    {
        $remove = follower::where('user_id', $user_id = Auth::id())->where('following_id', $request->id)->delete();
        if ($remove) {
            return response()->json(['status' => 2,  'message' => 'You have Un-follow successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
        }
    }

    public function User_Bookmark(Request $request)
    {
        $getBookMark    = PostBookMark::where('user_id', Auth::user()->id)->get();

        $getBlockPost    = BlockPost::where('user_id', Auth::user()->id)->get();
        $postLike = PostLike::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        $PostBookMark = PostBookMark::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();

        $userProfile    = User::where('id', Auth::user()->id)->first();



        $postData = Post::with('images')->orderBy('created_at', 'desc')

            ->with(['likes.user'  => function ($query) {
                $query->orderBy('created_at', 'desc')->take(1); // Retrieve the last like
            }])
            ->withCount(['countComent', 'countLike'])->get();




        $postData->transform(function ($post) {
            $post->post_id = $post->id;
            $post->liked_by_user = $post->userLikePost()->exists();
            $post->bookMark_by_user = $post->PostBookMark()->exists();
            $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
            return $post;
        });

        //    dd($postData);
        return view('User.User_Bookmark', compact('postData', 'postLike', 'getBlockPost', 'userProfile', 'getBookMark', 'PostBookMark'));
    }

    public function Follower_User(Request $request)
    {
        if (Auth::check()) {
            $influencerId = $request->influencerId;
            if ($influencerId != '') {
                $userId = Auth::id();
                $userName = Auth::user()->name;
                $checkFollow = Follower::where('user_id', $userId)
                    ->where('following_id', $influencerId)
                    ->first();

                if (!empty($checkFollow)) {
                    $checkFollow->delete();
                    return response()->json(['status' => 2, 'message' => 'You have Un-followed successfully']);
                }
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
                    return response()->json(['status' => 1, 'message' => 'You have followed successfully']);
                } else {
                    return response()->json(['status' => 0, 'message' => 'Something went wrong']);
                }
            } else {

                return response()->json(['status' => 0, 'message' => 'Influencer ID is missing']);
            }
        } else {

            return response()->json(['status' => 'false', 'message' => 'User is not authenticated']);
        }
    }

    public function My_Stream_Details(Request $request)
    {
        $currentDate    = date('Y-m-d');
        $stream_id      = $request->id;
        $streamdata     = StreamManagement::where('id', $stream_id)->get();

        $data = StreamManagement::where('id', $stream_id)->with('getInfluencers')->first();

        $data['videoUrl'] = '';
        if (!empty($data)) {
            if ($data['recorded']) {
                $fileList = json_decode($data['fileList'], true);
                if (!empty($fileList)) {
                    $data['videoUrl'] = 'https://tidbidstore.s3.us-east-2.amazonaws.com/' . $fileList[0]['fileName'];
                }
            } else {
                $data['videoUrl'] = 'https://tidbidstore.s3.us-east-2.amazonaws.com/' . $data->sid . '_live_' . $data->id . '_0.mp4';
            }
        }

        // $data = StreamManagement::where('id', $stream_id)->where('bid_end_status', 2)->with('getInfluencers')->first();

        // $data->videoUrl = '';
        // if (!empty($data)) {
        //     if ($data->recorded) {
        //         $fileList = json_decode($data->fileList, true);
        //         if (!empty($fileList)) {
        //             $data['videoUrl'] = 'https://tidbidstore.s3.us-east-2.amazonaws.com/' . $fileList[0]['fileName'];
        //         }
        //     } else {
        //         $data['videoUrl'] = 'https://tidbidstore.s3.us-east-2.amazonaws.com/' . $data->sid . '_live_' . $data->id . '_0.mp4';
        //     }
        // }

        $checkFollow = Follower::where('role', 'User')
            ->where('user_id', auth()->id())
            ->where('following_id', $data->influencer_id)
            ->first();

        $Notify = Notify::where('user_id', auth()->id())->get();

        $paststream = StreamManagement::where('influencer_id', $streamdata[0]->influencer_id)
            ->where('id', '!=', $stream_id)
            ->where('streamDate', '<', $currentDate)
            ->orderBy('streamDateTime', 'DESC')
            ->get();

        return view('My_Stream_Details', compact('paststream', 'streamdata', 'data', 'checkFollow', 'Notify'));
    }

    public function send_gift(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $this->send_gift_amt($request->price);

        $SendGift = SendGift::create([
            'user_id' => Auth::user()->id,
            'gift_amt' => $request->price,
            'stream_id' => $request->stream_id,
        ]);
        if ($SendGift) {
            $this->userTransaction(Auth::user()->id, $request->influencer_id, $request->stream_id, $request->price);
            return response()->json(['status' => 1, 'message' => 'Your gift sent successfully $' . $request->price]);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something is wrong try again..']);
        }
    }

    public function send_gift_amt($amount)
    {
        $getDefaultCard = SaveCard::where('card_default', 1)->where('user_id', Auth::user()->id)->first();

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            // Create a charge
            $charge = \Stripe\Charge::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'source' => 'card_1PGz0aLL4SgpRhaWDuc75pY3', // Card ID
                'description' => 'Charge for sending gift',
                'customer' => 'cus_Q7DR9WLHEDyVHS',
            ]);



            //  dd($charge);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle API error
            dd($e->getMessage());
        }
    }

    public function send_gift_user(Request $request)
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

    public function bidNow(Request $request)
    {
        $checkStatus = StreamManagement::where('id', $request->stream_id)->first();

        if ($checkStatus->bid_end_status == 1) {

            return response()->json(['status' => 0, 'message' => 'Bid is closed']);
        }

        $latestEntry = Bid::where('stream_id', $request->stream_id)->latest()->first();

        if (!empty($latestEntry)) {
            if ((int)$request->bid_price < (int)$latestEntry->bid_price) {
                return response()->json(['status' => 0, 'message' => 'Please  put price higher than last action price $' . $request->bid_price]);
            }
        }

        $add_bid = Bid::create([
            'user_id' => Auth::user()->id,
            'infulencer_id' => $request->infulencer_id,
            'stream_id' => $request->stream_id,
            'bid_price' => $request->bid_price,
            'bid_date' => date('Y-m-d'),
            'status'   => 1
        ]);

        if ($add_bid) {
            $this->userTransaction(Auth::user()->id, $request->infulencer_id, $request->stream_id, $request->bid_price);
            return response()->json(['status' => 1, 'message' => 'Your gift sent successfully $' . $request->bid_price]);
        } else {
            return response()->json(['status' => 'false', 'message' => 'Something is wrong....']);
        }
    }

    /**
     * get user comment from post
     */
    public function get_Post_comment_user(Request $request)
    {
        $post_id = $request->id;
        $get = PostComment::with('getUser')->where('post_id', $post_id)->get();

        $comment_html = '';
        if (count($get) != 0) {
            foreach ($get as $data) {
                $user = $data->getUser;
                if ($user && $user->profile_img != '') {
                    $img = '<img src="' . asset('Influencer/images/profile_img/' . $data->getUser->profile_img) . '" alt="">';
                } else {
                    $img = '<img src="' . asset('user.jpg') . '" alt="">';
                }
                $comment_html .= '
                            <div class="main-comment">
                            <div class="comment-img">
                              ' . $img . '
                            </div>
                            <div class="comment-left">
                            <p style="color: #000000; font-weight:600;">' . $data->getUser->name . ' <span style="color: #971C93; font-weight:600;">' . $data->created_at->diffForHumans() . '</span></p>
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


    public function getPost_like_user(Request $request)
    {
        $post_id = $request->id;
        $get = PostLike::with('user')->where('post_id', $post_id)->get();
        $comment_html = ''; // Initialize $comment_html before the loop
        if (count($get) != 0) {
            foreach ($get as $data) {
                $user = $data->user;
                if ($user && $user->profile_img != '') {
                    $img = '<img src="' . asset('Influencer/images/profile_img/' . $user->profile_img) . '" alt="">';
                } else {
                    $img = '<img src="' . asset('user.jpg') . '" alt="">';
                }
                $comment_html .= '
                        <div class="likebox">
                        <div class="likeimg">' . $img . '</div>
                        <div class="liketext">
                        <p>' . $data->user->name . '</p>
                        </div>
                        </div>
            ';
            }
            return response()->json(['html' => $comment_html]);
        } else {
            return response()->json(['html' => 'No like found']);
        }
    }

    public function Post_Report_user(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
            'description' => 'required',
            'user_id' => '',
        ]);

        try {
            // $report = Report::where('influencer_id', $request->influencer_id,)->where('post_id', $request->post_id)->get();
            $report = new PostReport;
            $report->description    = $validatedData['description'];
            $report->post_id        = $validatedData['post_id'];
            $report->user_id  = Auth::user()->id;
            $report->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add post: ' . $e->getMessage()]);
        }
    }

    public function blockPost_user(Request $request)
    {
        $addBlock = BlockPost::create([
            'user_id' => Auth::user()->id,
            'post_id'  => $request->id
        ]);
        if ($addBlock) {
            return response()->json(['status' => 1,    'message' => 'Post block successfully']);
        } else {
            return response()->json(['status' => 0,    'message' => 'something is wrong']);
        }
    }


    public function post_commnet_user(Request $request)
    {

        $addComment = PostComment::create([
            'post_id' => $request->postid,
            'comment' => $request->commentValue,
            'user_id' => Auth::user()->id
        ]);
        if ($addComment) {
            $PostComment = PostComment::where('post_id', $request->postid)->count();
            return response()->json(['status' => true, 'totalComment' => $PostComment,  'message' => 'Comment added successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function post_like_user(Request $request)
    {

        $PostLike  = PostLike::where('user_id', Auth::user()->id)->where('post_id', $request->postid)->first();
        if (!empty($PostLike)) {

            $PostLike = PostLike::where('user_id', Auth::user()->id)->where('post_id', $request->postid)->delete();
            $Postlike = PostLike::where('post_id', $request->postid)->count();
            return response()->json(['status' => 2, 'totalLike' => $Postlike, 'message' => 'Unlike successfully']);
        }
        $likeyou = PostLike::create([
            'post_id' => $request->postid,
            'user_id' => Auth::user()->id
        ]);
        if ($likeyou) {
            $Postlike = PostLike::where('post_id', $request->postid)->count();
            return response()->json(['status' => 1, 'totalLike' => $Postlike,   'message' => 'You have like successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    /** bookMark */
    public function add_post_book_mark_user(Request $request)
    {
        $PostBookMark  = PostBookMark::where('user_id', Auth::user()->id)->where('post_id', $request->postid)->first();
        if (!empty($PostBookMark)) {
            $PostLike = PostBookMark::where('user_id', Auth::user()->id)->where('post_id', $request->postid)->delete();
            return response()->json(['status' => 2,  'message' => 'Post removed on bookmark successfully']);
        }
        $likeyou = PostBookMark::create([
            'post_id' => $request->postid,
            'user_id' => Auth::user()->id
        ]);
        if ($likeyou) {
            return response()->json(['status' => 1,   'message' => 'You have bookmared successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
        }
    }

    /**
     * card set as primary card
     */
    public function set_primary_card(Request $request)
    {
        // dd(Auth::user()->id);
        $update = SaveCard::where('user_id', Auth::user()->id)->update(['card_default' => 'NO']);
        if ($update) {
            //   dd($request->id);
            $updates = SaveCard::where('id', $request->id)->update(['card_default' => 'YES']);
            // dd($updates);
            return response()->json(['status' => 1, 'message' => 'Card set as primary card successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
        }
    }

    public function userTransaction($user_id, $influencer_id, $stream_id, $amount)
    {
        Transection::create([
            'user_id' => $user_id,
            'influencer_id' => $influencer_id,
            'stream_id' => $stream_id,
            'date_time' => date('Y-m-d H:i:s'),
            'amount' => $amount,
        ]);
    }

    /** resend otp */
    public function UserresenOtp(Request $request)
    {
        $otp =  $this->generateOTP();
        $createOtp = UserOtp::create([
            'user_id' => $request->user_id,
            'otp' => $otp,
            'otp_date_time' => date('Y-m-d h:i:s'),
        ]);
        if ($createOtp) {
            return response()->json([
                'success' => 'Otp resend successfull',
                'status' => 1,
                'otp' => $otp,
            ]);
        } else {
            return response()->json(['error' => 'something is wrong', 'status' => 0]);
        }
    }

    /** send live comment */
    public function sendLiveComment(Request $request)
    {
        $createComment = LivestreamComment::create([
            'user_id'   => Auth::user()->id,
            'stream_id' => $request->stream_id,
            'comment'   => $request->commentcontent,
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
    public function LiveStreamComment(Request $request)
    {
        $comment_html   = '';
        $stream_id      = $request->stream_id;
        $lastBid        = Bid::with(['getUser'])->where('stream_id', $stream_id)->orderBy('id', 'desc')->first();
        $comments       = LivestreamComment::with('user')->where('stream_id', $stream_id)->get();
        $checkStatus    = StreamManagement::where('id', $stream_id)->first();

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

        return response()->json(['html' => $comment_html, 'lastBid' => $lastBid, 'bidStatus' => $checkStatus->bid_end_status]);
    }

    public function notifyMee(Request $request)
    {
        if ($request->events == 'notify') {
            $delete = Notify::where('stream_id', $request->stream_id)->where('user_id', Auth::id())->delete();
        } else {
            $add = Notify::create([
                'user_id' => Auth::id(),
                'stream_id' => $request->stream_id,
            ]);

            //Create Notification
            $streamId = $request->stream_id;
            $stream = StreamManagement::where('id', $streamId)->first();
            if ($stream) {
                $influencerId = $stream->influencer_id;
                $streamTitle = $stream->streamTitle;
                $user_id = Auth::id();
                $subscribedNotification = Notification::create([
                    'user_id' => $user_id,
                    'influencer_id' => $influencerId,
                    'title' => 'Subscribe Notification',
                    'message' => 'You have Subscribed to ' . $streamTitle,
                    'seen_status' => 0,
                ]);
            }
        }

        if (isset($add) && $add)
            return response()->json(['id' => $request->stream_id, 'status' => 1,  'message' => 'You have add in your Notify']);
        if (isset($delete) && $delete)
            return response()->json(['id' => $request->stream_id, 'status' => 2,  'message' => 'You have been Subscribed']);
        else
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
    }


    public function Post_Reports(Request $request, Post $post)
    {
        $validatedData = $request->validate([

            'description' => 'required',
            'user_id' => '',
        ]);

        try {
            // $report = Report::where('influencer_id', $request->influencer_id,)->where('post_id', $request->post_id)->get();
            if ($validatedData['type'] == 'Stream') {
                $type = 'Stream';
            } else {
                $type = 'Post';
            }
            $report = new PostReport;
            $report->description    = $validatedData['description'];
            $report->post_id        = $validatedData['post_id'];
            $report->user_id  = Session::get('user_id');
            $report->type = $type;
            $report->save();
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Failed to add post: ' . $e->getMessage()]);
        }
    }

    public function getVideoUrl(Request $request)
    {
        $streamId   = $request->streamId;
        $user_id    = Auth::id();

        $checkStatus    = StreamManagement::where('id', $streamId)->first();
        $lastBid        = Bid::with(['getUser'])->where('stream_id', $streamId)->orderBy('id', 'desc')->first();

        if ($checkStatus->bid_end_status == 1) {
            if (!empty($lastBid)) {
                if ($lastBid->getUser->id == $user_id) {
                    if ($checkStatus->what_to_expect == 'Private_Video_call') {
                        // $getUrl = PrivateVideo::where('stream_id', $streamId)
                        //     ->where('user_id', $user_id)
                        //     ->first();

                        // $join_url = '';
                        // if ($getUrl && !empty($getUrl->join_url)) {
                        //     $join_url = $getUrl->join_url;
                        // }

                        return response()->json(['success' => true, 'data' => 'video-call/' . $checkStatus->influencer_id]);
                    } else {
                        return response()->json(['success' => true, 'data' => 'user-chat/' . $checkStatus->influencer_id]);
                    }
                }
            }
        }

        return response()->json(['success' => false, 'message' => 'You lost your bid']);
    }


    //09-10-2024
    public function NotificationUser(Request $request)
    {
        $userId = Auth::id();
        $notifications = Notification::where('user_id', $userId)->orderBy('id', 'desc')->get();

        Notification::where('user_id', $userId)
            ->where('seen_status', 0)
            ->update(['seen_status' => 1]);

        $notificationData = $notifications->map(function ($notification) {
            return [
                'title' => $notification->title,
                'message' => $notification->message,
                'created_at' => $notification->created_at->format('d/m/Y | h:i A')
            ];
        });

        return response()->json(['notifications' => $notificationData]);
    }
}
