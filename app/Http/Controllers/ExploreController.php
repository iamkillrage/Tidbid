<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\{
    User,
    BlockPost,
    Follower,
    Post,
    StreamManagement,
    PostLike,
    PostBookMark,
    SuggestInfluencer,
    Notify
};
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.user.status');
    }

    function index()
    {
        $streamdata = StreamManagement::where('id', '>', '0');
        $streamdata = $streamdata->get();
        return view('Home', compact('streamdata'));
    }

    function user_Explore(Request $request)
    {
        $influencerdata = User::where('role', 'Influencer')->where('profile_status', 'Complete');
        if ($request->ajax()) {
            if ($request->has('search')) {
                $keyword = $request->input('search');
                $influencerdata = $influencerdata->where('name', 'like', '%' . $keyword . '%');
            }
            $influencerdata = $influencerdata->paginate(12);
            $view = view('Partial.explore_partial', compact('influencerdata'))->render();
            return response()->json(['html' => $view]);
        }

        $influencerdata = $influencerdata->paginate(12);

        return view('Explore', compact('influencerdata'));
    }

    function Explore_Stream_Details($id)
    {
        $streamdata = StreamManagement::where('influencer_id', $id)->get();

        return view('Explore_Stream_Details', compact('streamdata'));
    }

    function Influencer_Stream_Details($id, Request $request)
    {
        $influencerdata = User::with('followerscount', 'upcomingstreamcount')->where('role', 'Influencer')->where('id', $id)->get();
        $data   = User::with('streams')->find($request->id);
        $userId = Auth::id();

        $checkFollow = Follower::where('role', 'User')->where('user_id', $userId)
            ->where('following_id', $id)
            ->first();

        $user_id = auth()->user()->id;
        $Notify = Notify::where('user_id', $user_id)->get();

        $currentDate = date('Y-m-d');
        $streamdata = StreamManagement::where('influencer_id', $id)
            ->where('streamDate', '>=', $currentDate)
            ->where('bid_end_status', 2)
            ->get();

        $paststreamdata = StreamManagement::where('influencer_id', $id)
            ->where('streamDate', '<', $currentDate)
            ->orWhere('bid_end_status', 1)
            ->where('influencer_id', $id)
            ->orderBy('streamDateTime', 'DESC')
            ->get();

        $get_suggest_influencer = SuggestInfluencer::where('influencer_id', $id)->get();

        return view('Influencer_Stream_Details', compact(
            'data',
            'influencerdata',
            'checkFollow',
            'streamdata',
            'paststreamdata',
            'get_suggest_influencer',
            'Notify'
        ));
    }

    public function Influencer_Post_Details($id, Request $request)
    {
        // Get user and related data
        $postdata = User::with('followerscount', 'upcomingstreamcount')
            ->where('role', 'Influencer')
            ->where('id', $id)
            ->get();

        $userId = Auth::id();

        $checkFollow = Follower::where('role', 'User')
            ->where('user_id', $userId)
            ->where('following_id', $id)
            ->first();

        $currentDate = date('Y-m-d');

        $paststream = StreamManagement::where('influencer_id', $id)
            ->where('streamDate', '<', $currentDate)
            ->orWhere('bid_end_status', 1)
            ->where('influencer_id', $id)
            ->orderBy('streamDateTime', 'DESC')
            ->get();

        // Retrieve block posts, bookmarks, and likes
        $getBlockPost = BlockPost::where('user_id', Auth::user()->id)
            ->pluck('post_id')
            ->toArray();

        $PostBookMark = PostBookMark::where('user_id', Auth::user()->id)
            ->pluck('post_id')
            ->toArray();

        $postLike = PostLike::where('user_id', Auth::user()->id)
            ->pluck('post_id')
            ->toArray();
        // Retrieve user profile
        $userProfile    = User::where('id', Auth::user()->id)->first();

        // Get posts with relationships and counts
        $postDatas = Post::with(['images', 'getInfluencers', 'user', 'likes.user'])
            ->where('influencer_id', $id)
            ->withCount(['countComent', 'countLike'])
            ->orderBy('id', 'DESC');

        if ($request->ajax()) {
            $postDatas = $postDatas->paginate(12);
            $postDatas->getCollection()->transform(function ($post) {
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

            $view = view('Partial.Influencer_Post_Details_Partial', compact('postDatas', 'postLike', 'getBlockPost', 'userProfile', 'PostBookMark'))->render();
            return response()->json(['html' => $view]);
        }

        $postDatas = $postDatas->paginate(12);
        $postDatas->getCollection()->transform(function ($post) {
            $post->post_id = $post->id;
            $post->liked_by_user = $post->userLikePost()->exists();
            $post->bookMark_by_user = $post->PostBookMark()->exists();
            $post->last_like_user = $post->likes->isNotEmpty() ? $post->likes->first()->user : null;
            return $post;
        });

        return view('Influencer_Post_Details', compact('postDatas', 'postdata', 'paststream', 'checkFollow', 'userProfile', 'id', 'getBlockPost', 'postLike', 'PostBookMark'));
    }

    function Influencer_Shedule_Details($id, Request $request)
    {
        $sheduledata = User::with('followerscount', 'upcomingstreamcount')->where('role', 'Influencer')->where('id', $id)->get();

        $userId = Auth::id();

        $checkFollow = Follower::where('role', 'User')->where('user_id', $userId)
            ->where('following_id', $id)
            ->first();
        $Notify = Notify::where('user_id', $userId)->get();

        $currentDate = date('Y-m-d');
        $getStrrem = StreamManagement::where('influencer_id', $request->id)->where('streamDate', '>', $currentDate)->get();

        $datas = $getStrrem->toArray();

        return view('Influencer_Shedule_Details', compact('sheduledata', 'checkFollow', 'datas', 'id', 'Notify'));
    }

    public function notifyMeee(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 0, 'message' => 'Please login to subscribe to this event.']);
        }

        if ($request->events == 'notify') {
            $delete = Notify::where('stream_id', $request->stream_id)->where('user_id', Auth::id())->delete();
        } else {
            $add = Notify::create([
                'user_id' => Auth::id(),
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

    public function eventdatas(Request $request)
    {
        $datas      = [];
        $data       = User::with('posts')->find($request->id);
        $getStrrem  = StreamManagement::where('influencer_id', (int)$request->param)->get();

        $userId = Auth::id();
        $data   = $getStrrem->toArray();

        foreach ($data as $row) {
            $checkStatus = Notify::where('stream_id', $row["id"])
                ->where('user_id', $userId)
                ->first();

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
}
