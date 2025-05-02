@php
$postId = [];
foreach($getBlockPost as $block_post){
$postId[] = $block_post->post_id;
}


@endphp

@foreach($postData as $index=>$value)
@if (!in_array($value->id, $postId))
<div class="postright" id="remove-post_{{ $value->id}}">
    <div class="post_profile">
        <div class="postimg">
            <div class="person_img">
              @if(isset($value->getInfluencers) && !empty($value->getInfluencers->profile_img))
                <img src="{{ asset('Influencer/images/profile_img/'.$value->getInfluencers->profile_img) }}">
            @else
                <img src="{{ asset('user.jpg') }}">
            @endif

            </div>
            <div class="person_text">
                @if(isset($value->getInfluencers) && isset($value->getInfluencers->userName))
                    <h5>{{ $value->getInfluencers->userName }}</h5>
                @else
                @endif
                <span><i class="fas fa-map-marker-alt"></i>{{$value->location}} </span>
            </div>
        </div>
        <i data-postId="{{ $value->id }}" class="showbutton_{{$value->id}}"> <img
                src="{{asset('Influencer/images/elipses.png')}}" alt=""></i>
        <div class="dropdown dropdown-action">

            <div class="elipse-wrap_{{$value->id}} elipse-wrap">

                <div class="show-elipse-card_{{$value->id}} boxsize_1 showbutton_{{ $value->id }}"
                    style="display: none;">
                    <button id="blockPostBtn" class="btn-elipse1 elipse_2" onclick="block_post('{{ $value->id}}')">
                        <img src="{{ asset('Influencer/images/block.svg') }}"> Block
                    </button>
                    <form action="" id="blockForm{{$value->id}}">
                        @csrf
                        <input type="hidden" name="postID">
                        <input type="hidden" name="influencerID">
                    </form>
                    {{-- <button type="button" class="btn-elipse1 elipse_2 edit-link"
                        data-post="{{json_encode($value)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><img
                            src="{{asset('Influencer/images/report.svg')}}"> Report</button> --}}
                    <button class="dropdown-item report-click btn-elipse1 elipse_2 edit-link" data-id="{{$value->id}}"
                        data-bs-toggle="modal" data-bs-target="#exampleModal"><img
                            src="{{asset('Influencer/images/report.svg')}}"> Report</button>
                </div>
            </div>
        </div>

    </div>



    <!-- @if($value->images)
    
    <div id="current-box->{{$index}}" class="owl-carousel">
        <div class="carousel-indicators">
            @foreach($value->images as $key => $img)
            <button type="button" data-bs-target="#owl-carousel" data-bs-slide-to="{{$key}}" class="{{ $key == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner post_lgimg mt-4">
            @foreach($value->images as $key => $img)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                @php
                $extension = pathinfo($img->post_img, PATHINFO_EXTENSION);
                $videoExtensions = ['mp4', 'webm', 'ogg'];
                @endphp
                @if(in_array($extension, $videoExtensions))
                <video controls class="d-block w-100">
                    <source src="{{ asset($img->post_img) }}" type="video/{{ $extension }}">
                    Your browser does not support the video tag.
                </video>
                @else
                <img src="{{ asset($img->post_img) }}" alt="{{ $img->id }}" class="d-block w-100">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif -->



    <div id="current-box-{{$index}}" class="owl-carousel">

        @foreach($value->images as $key => $img)
        @php
        $extension = pathinfo($img->post_img, PATHINFO_EXTENSION);
        $videoExtensions = ['mp4', 'webm', 'ogg'];
        @endphp
        @if(in_array($extension, $videoExtensions))
        <div class="post_lgimg mt-4">
            <video controls class="d-block w-100">
                <source src="{{ asset($img->post_img) }}" type="video/{{ $extension }}">
                Your browser does not support the video tag.
            </video>
        </div>
        @else
        <div class="post_lgimg mt-4">
            <img src="{{ asset($img->post_img) }}" alt="{{ $img->id }}" class="d-block w-100">
        </div>
        @endif
        @endforeach
    </div>



    {{-- @dd($value) --}}
    <div class="icon_box">
        <ul class="comment_box2 pb-0">
            <li><a href="javascript:void(0)">
                    @if($value->liked_by_user == true)
                    <i class="fa fa-heart addClass_{{$value->id}}" onclick="likePost('{{$value->id}}')"></i>
                    @else
                    <i class="far fa-heart addClass_{{$value->id}}" onclick="likePost('{{$value->id}}')"></i>
                    @endif

                </a></li>
            <li><a href="javascript:void(0)" class="post-data" onclick="getPostComment('{{$value->id}}')"
                    data-value="{{json_encode($value)}}"><i class="far fa-comment"></i></a></li>
            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><i
                        class="fas fa-paper-plane"></i></a></li>
        </ul>

        <div class="save_icon"><a href="javascript:void(0)">
                @if($value->bookMark_by_user == false)
                <i class="far fa-bookmark bookmarkclass_{{$value->id }}" onclick="addBookMark('{{$value->id}}')"></i>
                @else
                <i class="fa fa-bookmark bookmarkclass_{{$value->id }}" onclick="addBookMark('{{$value->id}}')"></i>
                @endif
            </a></div>

    </div>

    <div class="desc_box"><img src="{{asset('Influencer/images/login_img.png')}}"><a href="javascript:void(0)"
            class="pinktext" onclick="getLike('{{ $value->id}}')">Liked by</a>
        @if ($value->last_like_user)
        {{ $value->last_like_user->name }}
        <!-- Assuming 'name' is the attribute of the user you want to display -->
        @endif
        and <span class="postLike_{{$value->id }}"> {{count($value->countLike)}}</span> others
    </div>
    <div class="black_text">
        <a href="javascript:void(0)" onclick="getPostComment('{{$value->id}}')">View all <span class="totalComment_{{$value->id}}">{{
                $value->count_coment_count}}</span> Comments</a>
        <p>{{$value->description}} </p>
        {{-- <span>{{$value->created_at}}</span> --}}
        @php
        $createdAt = new DateTime($value->created_at);
        $now = new DateTime();
        $interval = $createdAt->diff($now);
        if ($interval->h > 0) {
        $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        } elseif ($interval->i > 0) {
        $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
        } else {
        $timeAgo = 'just now';
        }
        echo '<span>' . $timeAgo . '</span>';
        @endphp
    </div>
    <div class="post_form">
        <div class="form_img">
            @if($value->profile_img == '')

            <img src="{{ asset('Influencer/images/profile_img/'. ( $userProfile->profile_img)) }}">
            @else
            <img src="{{asset('user.jpg')}}">
            @endif
        </div>

        <div class="post_search">
            <input type="text" class="comment-text" placeholder="Write a comment...">
            <a href="javascript:void(0)" data-postId="{{ $value->id }}" class="postComment"><img
                    src="{{asset('Influencer/images/send3.png')}}" alt=""></a>
        </div>
    </div>
</div>
@endif
@endforeach
<!-- Popup share -->
<div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
                    class="fas fa-times-circle"></i></button>

            <div class="modal-body pt-0 pb-5 ">
                <h1 class="modal-title text-center report-h5">Share </h1>

                <ul class="social_icon">
                    <li><a href="https://www.facebook.com/" target="_blank"><img
                                src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank"><img
                                src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                    <li><a href="https://x.com/?lang=en" target="_blank"><img
                                src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
                    <li><a href="https://in.linkedin.com/" target="_blank"><img
                                src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!-- Popup share -->