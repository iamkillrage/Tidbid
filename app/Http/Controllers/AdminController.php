<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PrivacyPolicy;
use App\Models\User;
use App\Models\TermCondition;
use App\Models\StreamManagement;
use App\Models\Bid;
use App\Models\Post;
use App\Models\ReferFriend;
use App\Models\RefferedInfu;
use App\Models\InfluencerIdVerification;
require app_path() . '/Stripe/init.php';




class AdminController extends Controller
{
    public function Admin_login()
    {
        //   return view('Admin.Admin_login');
        return view('admin.admin_login');
    }


    public function Admin_Sign_In(Request $request)
    {
        $email     = trim($request->email);
        $password  = $request->password;
        $remeberme = $request->remembereme;
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            // return redirect()->intended('/user-management');
            if ($remeberme == 1) {
                setcookie("email",$email, time() + 3600);
                setcookie("password", $password, time() + 3600);
            } else {
                setcookie("email", "");
                setcookie("password", "");
            }
            return response()->json(['message' => 'admin login successfully', 'status' => 1]);
        }
        return response()->json(['message' => 'Invalid Email or Password', 'status' => 0]);
    }


    public function Admin_Logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }


    /** User Managment */
    public function User_management(Request $request)
    {
        $getUser = User::where('role', 'User');
        $query = $request->searchQuery;

        if (isset($query)) {
            $getUser =  $getUser->where('Name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')->orWhere('phone', 'like', '%' . $query . '%');
        }
        if (isset($request->followings)) {
            if(in_array("0-50", $request->followings)){
                $getUser = $getUser->where('followings','<=',50);
            }
            if(in_array("50-100", $request->followings)){
                $getUser = $getUser->where('followings','<=',100)->where('followings','>=',50);
            }
            if(in_array("100-150", $request->followings)){
                $getUser = $getUser->where('followings','<=',150)->where('followings','>=',100);
            }
            if(in_array("150-200", $request->followings)){
                $getUser = $getUser->where('followings','<=',200)->where('followings','>=',150);
            }
            if(in_array("200-500", $request->followings)){
                $getUser = $getUser->where('followings','<=',500)->where('followings','>=',200);
            }
            if(in_array("500-1000", $request->followings)){
                $getUser = $getUser->where('followings','<=',1000)->where('followings','>=',500);
            }
            if(in_array(">1000", $request->followings)){
                $getUser = $getUser->where('followings','>',1000);
            }
        }

        if (isset($request->bid)) {
            if(in_array("0-5", $request->bid)){
                $getUser = $getUser->where('bid','<=',5);
            }
            if(in_array("5-10", $request->bid)){
                $getUser = $getUser->where('bid','<=',10)->where('bid','>=',5);
            }
            if(in_array("10-15", $request->bid)){
                $getUser = $getUser->where('bid','<=',15)->where('bid','>=',10);
            }
            if(in_array("15-20", $request->bid)){
                $getUser = $getUser->where('bid','<=',20)->where('bid','>=',15);
            }
            if(in_array("20-50", $request->bid)){
                $getUser = $getUser->where('bid','<=',50)->where('bid','>=',20);
            }
            if(in_array(">50", $request->bid)){
                $getUser = $getUser->where('bid','>',50);
            }
        }


        if (isset($request->datefilter)) {
            $singupDate = explode("-", $request->datefilter);
            $toDate =    date("Y-m-d", strtotime($singupDate[0]));
            $fromDate =  date("Y-m-d", strtotime($singupDate[1]));
            $getUser = $getUser->whereBetween('created_at', [$toDate, $fromDate]);
        }
        $getUser = $getUser->paginate(10);
        return view('admin.User_management', ['getUser' => $getUser]);
    }


    public function deleteUser(Request $request)
    {
        $data = User::find($request->id)->delete();
        if ($data) {
            return response()->json(['message' => 'user deleted successfully', 'status' => 1]);
        } else {
            return response()->json(['message' => 'something is wrong...', 'status' => 0]);
        }
    }


    public function changeUserStatus(Request $request)
    {
        $data = User::find($request->id);
        if ($data->status == 'Activate') {
            $update = User::where('id', $request->id)->update(['status' => 'Inactive']);
            return response()->json(['message' => 'inactive successfully', 'status' => 1]);
        } else {
            $update = User::where('id', $request->id)->update(['status' => 'Activate']);
            return response()->json(['message' => 'activate successfully', 'status' => 1]);
        }
    }


   function Influencer_management(Request $request)
{
    $Influencers = User::where('role', 'Influencer')
        ->where('verify_status', 1)
        ->with('social_links') // Social Media Links Include Karna
        ->withCount('streams') // Streams ka count include karna
        ->with(['upcomingStreams' => function ($query) {
            $query->where('streamDate', '>=', now())->orderBy('streamDate', 'asc');
        }]);
    

    // Search Query
    $query = $request->searchQuery;
    if (!empty($query)) {
        $Influencers->where(function ($q) use ($query) {
            $q->where('Name', 'like', '%' . $query . '%')
              ->orWhere('email', 'like', '%' . $query . '%')
              ->orWhere('phone', 'like', '%' . $query . '%');
        });
    }

    // Followings Filter
    if (isset($request->followings)) {
        $Influencers->where(function ($q) use ($request) {
            if (in_array("0-50", $request->followings)) {
                $q->orWhere('followings', '<=', 50);
            }
            if (in_array("50-100", $request->followings)) {
                $q->orWhereBetween('followings', [50, 100]);
            }
            if (in_array("100-150", $request->followings)) {
                $q->orWhereBetween('followings', [100, 150]);
            }
            if (in_array("150-200", $request->followings)) {
                $q->orWhereBetween('followings', [150, 200]);
            }
            if (in_array("200-500", $request->followings)) {
                $q->orWhereBetween('followings', [200, 500]);
            }
            if (in_array("500-1000", $request->followings)) {
                $q->orWhereBetween('followings', [500, 1000]);
            }
            if (in_array(">1000", $request->followings)) {
                $q->orWhere('followings', '>', 1000);
            }
        });
    }

    // Followers Filter
    if (isset($request->followers)) {
        $Influencers->where(function ($q) use ($request) {
            if (in_array("0-5000", $request->followers)) {
                $q->orWhere('followers', '<=', 5000);
            }
            if (in_array("5000-10000", $request->followers)) {
                $q->orWhereBetween('followers', [5000, 10000]);
            }
            if (in_array("10000-15000", $request->followers)) {
                $q->orWhereBetween('followers', [10000, 15000]);
            }
            if (in_array("15000-20000", $request->followers)) {
                $q->orWhereBetween('followers', [15000, 20000]);
            }
            if (in_array("20000-50000", $request->followers)) {
                $q->orWhereBetween('followers', [20000, 50000]);
            }
            if (in_array(">50000", $request->followers)) {
                $q->orWhere('followers', '>', 50000);
            }
        });
    }

    // Date Filter
    if (isset($request->datefilter)) {
        $signupDate = explode(" - ", $request->datefilter);
        $toDate = date("Y-m-d", strtotime($signupDate[0]));
        $fromDate = date("Y-m-d", strtotime($signupDate[1]));
        $Influencers->whereBetween('created_at', [$toDate, $fromDate]);
    }

    // Pagination should be last
    $Influencers = $Influencers->paginate(10);

    return view('admin.Influencer_management', ['Influencers' => $Influencers]);
}


    function Varification_management(Request $request)
    {
        $getVerification = InfluencerIdVerification::with(['getInfluencer']);
        $search = $request->searchQuery;

        if (isset($search)) {
            $getVerification = $getVerification->where(function ($query) use ($search) {
                $query->whereHas('getInfluencer', function ($query) use ($search) {
                    $query->where('userName', 'like', '%' . $search . '%');
                    $query->where('role', 'Influencer');
                });
            });
        }
        if (isset($request->datefilter)) {
          //  dd("xcxc");
            $singupDate = explode("-", $request->datefilter);
            
            $toDate =    date("Y-m-d", strtotime($singupDate[0]));
            $fromDate =  date("Y-m-d", strtotime($singupDate[1]));
           // dd($toDate);

            $getVerification = $getVerification->whereBetween('verificationDate', [$toDate, $fromDate]);
        }
        $getVerification = $getVerification->where(function ($query) use ($search) {
            $query->whereHas('getInfluencer', function ($query) use ($search) {
                $query->where('userName', 'like', '%' . $search . '%');
                $query->where('role', 'Influencer');
            });
        })->where('id_verification', 'Activate');
     //   $getVerification = $getVerification->where('status','=','Activate');
        $getVerification = $getVerification->paginate(10);
        return view('admin.Varification_management', ['getVerification' => $getVerification]);
    }


    public function changeInfluencerStatus(Request $request)
    {

        $data = InfluencerIdVerification::find($request->id);

        if ($data->status == 'Activate') {
            $update = InfluencerIdVerification::where('id', $request->id)->update(['status' => 'Inactive']);
            return response()->json(['message' => 'Influencer inactive successfully', 'status' => 1]);
        } else {
            $update = InfluencerIdVerification::where('id', $request->id)->update(['status' => 'Activate']);
            return response()->json(['message' => 'Influencer activate successfully', 'status' => 1]);
        }
    }


    function Stream_management(Request $request)
    {
        $streamData = StreamManagement::with(['getInfluencer']);
        $searchQuery = $request->searchQuery;
        if (!empty($searchQuery)) {
            $streamData = $streamData->whereHas('getInfluencer', function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
            });
        }

        if (isset($request->datefilter)) {
            $singupDate = explode("-", $request->datefilter);
            $toDate =    date("Y-m-d", strtotime($singupDate[0]));
            $fromDate =  date("Y-m-d", strtotime($singupDate[1]));
            $streamData = $streamData->whereBetween('streamDate', [$toDate, $fromDate]);
        }

        $streamData = $streamData->paginate(10);
        // dd($streamData);
        return view('admin.Stream_management', ['streamData' => $streamData]);
    }


    public function changeStreamStatus(Request $request)
    {
        $data = StreamManagement::find($request->id);
        if ($data->status == 'Activate') {
            $update = StreamManagement::where('id', $request->id)->update(['status' => 'Inactive']);
            return response()->json(['message' => 'Stream inactive successfully', 'status' => 1]);
        } else {
            $update = StreamManagement::where('id', $request->id)->update(['status' => 'Activate']);
            return response()->json(['message' => 'Stream activate successfully', 'status' => 1]);
        }
    }


    public function deleteStream(Request $request)
    {
        $data = StreamManagement::find($request->id)->delete();
        if ($data) {
            return response()->json(['message' => 'stream deleted successfully', 'status' => 1]);
        } else {
            return response()->json(['message' => 'stream is wrong...', 'status' => 0]);
        }
    }


    function Bid_management(Request $request)
    {
        // $latestRecords = Bid::latest()->groupBy('stream_id')->get();
        $latestRecords = Bid::whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('bids')
                ->groupBy('stream_id');
        })->with(['getInfluencer', 'getUser', 'getStream']);
        $querys = $request->searchTerm;
        if ($querys) {
            $latestRecords = $latestRecords->whereHas('getInfluencer', function ($query) use ($querys) {
                $query->where('name', 'like', '%' . $querys . '%');
            });

            // $latestRecords = $latestRecords->whereHas('getStream', function ($query) use ($querys) {
            //     $query->where('streamTitle', 'like', '%' . $querys . '%');
            // });
        }
        if (isset($request->datefilter)) {

            $singupDate = explode("-", $request->datefilter);
            $toDate =    date("Y-m-d", strtotime($singupDate[0]));
            $fromDate =  date("Y-m-d", strtotime($singupDate[1]));
            $latestRecords = $latestRecords->whereBetween('bid_date', [$toDate, $fromDate]);
        }
        $latestRecords = $latestRecords->paginate(10);
        // dd($latestRecords);
        return view('admin.Bid_management', ['latestRecords' => $latestRecords]);
    }


    public function deleteBid(Request $request)
    {
        $conditions = [
            'user_id' => $request->user_id,
            'infulencer_id' => $request->infulencer_id,
            'bid_date' => $request->bid_date,
            'stream_id' => $request->stream_id,
        ];
        $data =  Bid::where($conditions)->delete();
        if ($data) {
            return response()->json(['message' => 'Bid deleted successfully', 'status' => 1]);
        } else {
            return response()->json(['message' => 'Bid is wrong...', 'status' => 0]);
        }
    }


    public function changeBidStatus(Request $request)
    {


        $data = Bid::find($request->id);
        if ($data->status == 'Activate') {
            $update = Bid::where('id', $request->id)->update(['status' => 'Inactive']);
            return response()->json(['message' => 'bid inactive successfully', 'status' => 1]);
        } else {
            $update = Bid::where('id', $request->id)->update(['status' => 'Activate']);
            return response()->json(['message' => 'bid activate successfully', 'status' => 1]);
        }
    }


    function Post_management(Request $request)
    {
        $query = Post::with(['getInfluencer']);
        $search = $request->searchQuery;

        if (isset($search)) {
            $query->whereHas('getInfluencer', function ($query) use ($search) {
                $query->where('Name', 'like', '%' . $search . '%')
                    ->where('role', 'Influencer');
            });
            
        }
        if (isset($request->datefilter)) {
            $singupDate = explode("-", $request->datefilter);
            $toDate =    date("Y-m-d", strtotime($singupDate[0]));
            $fromDate =  date("Y-m-d", strtotime($singupDate[1]));
            $query = $query->whereBetween('created_at', [$toDate, $fromDate]);
        }
        $post = $query->paginate(10);
        return view('admin.Post_management', ['post' => $post]);
    }


    public function deletePost(Request $request)
    {
        $data = Post::find($request->id)->delete();
        if ($data) {
            return response()->json(['message' => 'post deleted successfully', 'status' => 1]);
        } else {
            return response()->json(['message' => 'something is wrong...', 'status' => 0]);
        }
    }


    public function changePostStatus(Request $request)
    {
        $data = Post::find($request->id);
        if ($data->status == 'Activate') {
            $update = Post::where('id', $request->id)->update(['status' => 'Inactive']);
            return response()->json(['message' => 'post inactive successfully', 'status' => 1]);
        } else {
            $update = Post::where('id', $request->id)->update(['status' => 'Activate']);
            return response()->json(['message' => 'post activate successfully', 'status' => 1]);
        }
    }


    public function Refer_a_Friend(Request $request)
    {
    $getRefer = [];
    $getRefer = RefferedInfu::with(['referredByUser', 'referredByToUser'])->paginate(10);
        // $getRefer = ReferFriend::with(['getRefer']);
        // $searchQuery = $request->searchQuery;
        // if (!empty($searchQuery)) {

        //     $getRefer = $getRefer->whereHas('getRefer', function ($query) use ($searchQuery) {
        //         $query->where('name', 'like', '%' . $searchQuery . '%');
        //     });
        // }

        // if (isset($request->datefilter)) {
        //     $singupDate = explode("-", $request->datefilter);
        //     $toDate =    date("Y-m-d", strtotime($singupDate[0]));
        //     $fromDate =  date("Y-m-d", strtotime($singupDate[1]));
        //     $getRefer = $getRefer->whereBetween('referDate', [$toDate, $fromDate]);
        // }
        // $getRefer = $getRefer->paginate(10);
        return view('admin.Refer_a_friend', ['getRefer' => $getRefer]);
    }


    function Terms_Condition()
    {
        $TermsAndCondition = TermCondition::first();
        return view('admin.Terms_and_condition', ['TermsAndCondition' => $TermsAndCondition]);
    }


    public function addTermCondetion(Request $request)
    {

        $add = TermCondition::updateOrCreate(
            ['id' => $request->id],
            ['discription' => $request->description],
        );
        if ($add) {
            return redirect()->back()->with('success', 'Term condetion added successfully...');
        } else {
            return redirect()->back()->with('error', 'something is wrong');
        }
    }


    function Privacy_policy()
    {
        $PrivacyPolicy = PrivacyPolicy::first();
        return view('admin.Privacy_policy', ['PrivacyPolicy' => $PrivacyPolicy]);
    }


    public function addPrivacyPolicy(Request $request)
    {
        $add = PrivacyPolicy::updateOrCreate(
            ['id' => $request->id],
            ['discription' => $request->description],
        );
        if ($add) {
            return redirect()->back()->with('success', 'privacy policy added successfully...');
        } else {
            return redirect()->back()->with('error', 'something is wrong');
        }
    }

    /** create custuamr */
    public function createCustuamr()
    {

        // Set your secret API key
        
        \Stripe\Stripe::setApiKey('secret API key');

        // Collect customer details (in a real-world scenario, you would likely collect these from a form)
        $email = 'customer@example.com'; // Example customer email
        $name = 'John Doe'; // Example customer name
        $description = 'New customer'; // Example description

        // Create the customer on Stripe
        try {
            $customer = \Stripe\Customer::create([
                'email' => $email,
                'name' => $name,
                'description' => $description
            ]);
            // Customer created successfully
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

    public function addUserCard(Request $request){
        $getUser = User::where('role', 'User')->where('id', $request->user_id)->first();
        $validator = Validator::make($request->all(), [
            'card_number' => 'required|string|credit_card', // Assuming you have a custom credit_card validation rule
            'exp_month' => 'required|digits:2|integer|between:1,12',
            'exp_year' => 'required|digits:4|integer|gte:'.date('Y'),
            'cvc' => 'required|string|digits_between:3,4',
            // Add any other validation rules as needed
        ]);       
             
    }


    public function editUser(Request $request){
                  $userId = $request->user_id;
                  $userProfile = $request->file('userProfile');
               //   dd($userProfile);
                if(!empty($userProfile)){
                    $back_idfileName = 'profile_'.time() . '_' . $userProfile->getClientOriginalName();
                   // dd($back_idfileName);
                    $userProfile->move(public_path('profile'), $back_idfileName);
                    $update = User::where('id', $userId)->update([
                        'profile_img' => $back_idfileName
                    ]);
                }
                
                  $data = [
                       'name' => $request->userName,
                       'dob' => $request->dob,
                       'bio' => $request->bio,
                  ];
                 // print_r($data); die();
                  $updates = User::where('id', $userId)->update($data);
                  if($updates){
                    return back()->with('suceess', 'Your message here');
                  } else {
                    return back()->with('error', 'Something is wrong');
                  }

    }


    public function editStream(Request $request){
        $streamId = $request->stream_id ;
        
        $data = [
             'streamTitle' => $request->streamTitle,
             'streamDate' => $request->streamDate,
             'streamTime' => $request->streamTime,
        ];
       // print_r($data); die();
        $updates = StreamManagement::where('id', $streamId)->update($data);
        if($updates){
          return back()->with('suceess', 'Your message here');
        } else {
          return back()->with('error', 'Something is wrong');
        }

}

public function editBid(Request $request){
    $bidId = $request->bid_id ;
    
    $data = [
         'streamTitle' => $request->streamTitle,
         'streamDate' => $request->streamDate,
         'streamTime' => $request->streamTime,
    ];
   // print_r($data); die();
    $updates = StreamManagement::where('id', $bidId)->update($data);
    if($updates){
      return back()->with('suceess', 'Your message here');
    } else {
      return back()->with('error', 'Something is wrong');
    }


}

public function editPost(Request $request){
    $postId = $request->post_id ;
    
    $data = [
         'title' => $request->streamTitle,
         'created_at' => $request->streamDate.' '.$request->streamTime,
        // 'streamTime' => $request->streamTime,
    ];
   // print_r($data); die();
    $updates = Post::where('id', $postId)->update($data);
    if($updates){
      return back()->with('suceess', 'Your message here');
    } else {
      return back()->with('error', 'Something is wrong');
    }


}
}
