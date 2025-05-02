@if(count($postData) > 0)
@foreach($postData as $index=>$value)
<div class="postright">
    <div class="post_profile">
        <div class="postimg">
            <div class="person_img">
                @if($value->getInfluencers->profile_img == '')
                <img src="{{asset('user.jpg')}}">
                @else
                <img src="{{ asset('Influencer/images/profile_img/'. ( $value->getInfluencers->profile_img)) }}">
                @endif

            </div>
            <div class="person_text">
                <h5>{{ session()->get('userName') }}</h5>
                <span><i class="fas fa-map-marker-alt"></i>{{$value->location}} </span>
            </div>
        </div>
        <i data-postId="{{ $value->id }}" class="showbutton"> <img src="{{asset('Influencer/images/elipses.png')}}"
                alt=""></i>
        <div class="dropdown dropdown-action">
            <div class="elipse-wrap">

                <div class="show-elipse-card boxsize_1 showbutton_{{ $value->id }}" style="display: none;">
                    <button class="btn-elipse1 elipse_2 deletePost" data-id="{{$value->id}}" data-bs-toggle="modal"
                        data-bs-target="#delete-post"><i class="far fa-trash-alt delet_1"></i>Delete
                    </button>
                    <button type="button" class="btn-elipse1 elipse_2 edit-link" data-post="{{json_encode($value)}}"
                        data-bs-toggle="modal" data-bs-target="#edit-Post-1"><i
                            class="fas fa-pen edit1"></i>Edit</button>
                </div>
            </div>
        </div>

    </div>
    
    <!-- @if($value->images)
    <div id="demoCarousel" class="carousel slide" data-bs-ride="carousel">

 
        <div class="carousel-indicators">
            @foreach($value->images as $key => $img)
            <button type="button" data-bs-target="#demoCarousel" data-bs-slide-to="{{$key}}"
                class="{{ $key == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>

     
        <div class="carousel-inner">
            @foreach($value->images as $key => $img)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                @php
                 $extension = pathinfo($img->post_img, PATHINFO_EXTENSION);
                $videoExtensions = ['mp4', 'webm', 'ogg'];
                 @endphp
            @if(in_array($extension, $videoExtensions))
            <video controls class="d-block w-100">
                    <source src="{{ asset($img->post_img) }}" type="video/{{ $extension }}" class="d-block w-100">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ asset($img->post_img) }}" alt="{{ $img->id }}" class="d-block w-100">
          @endif
            </div>
            @endforeach
        </div>

      
        <button class="carousel-control-prev" type="button" data-bs-target="#demoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span> 
        </button>
       
    </div>
@endif -->

<div id="current-box-{{$index}}" class="owl-carousel">
        @php
            
            $videoExtensions = ['mp4', 'webm', 'ogg'];
        @endphp
        @foreach($value->images as $key => $img)
        
        @php 
        $extension = pathinfo($img->post_img, PATHINFO_EXTENSION);   
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
        <a href="javascript:void(0)">View all <span
                class="totalComment_{{$value->id}}">{{ $value->count_coment_count}}</span> Comments</a>
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
        <li class="nav-item">
                                        @if(request()->session()->has('profile_img'))
                                        <a href="{{ route('Influencer_My_Profile') }}">
                                            <img src="{{ asset('Influencer/images/profile_img/' . request()->session()->get('profile_img')) }}">
                                        </a>
                                        @else
                                        <!-- Display a default image when no image is uploaded -->
                                        <a href="{{ route('Influencer_My_Profile') }}">
                                            <img src="{{ asset('Influencer/images/profile_img/1714652397_dummy_image.png') }}">
                                        </a>
                                        @endif
                                    </li>


        </div>

        <div class="post_search">
            <input type="text" class="comment-text" placeholder="Write a comment...">
            <a href="javascript:void(0)" data-postId="{{ $value->id }}" class="postComment"><img
                    src="{{asset('Influencer/images/send3.png')}}" alt=""></a>
        </div>
    </div>
</div>
@endforeach
@else
<div>No Data Found</div>
@endif