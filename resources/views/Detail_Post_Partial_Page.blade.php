@if(count($postData) > 0)
@foreach($postData as  $index=>$value)
@if(!in_array($value->id, $getBlockPost))
<div class="postright postright_{{$value->id}}" id="remove-post_{{$value->id}}">
  <div class="post_profile">
    <div class="postimg">
      <div class="person_img">
        <img src="{{asset('Influencer/images/profile_img/'.$value->getInfluencers->profile_img)}}">
      </div>
      <div class="person_text">
        <h5>{{$value->getInfluencers->userName}}</h5>
        <span><i class="fas fa-map-marker-alt"></i>{{$value->location}} </span>
      </div>
    </div>

    <!-- <div class="dropdown">
      <div class="elipse-wrap">
        <i data-postId="{{ $value->id }}" class="showbutton"> <img src="{{asset('Influencer/images/elipses.png')}}" alt=""></i>
        <div class="show-elipse-card boxsize_1 showbutton_{{ $value->id }}" style="display: none;">
          <button class="btn-elipse1 elipse_2 deletePost" data-id="{{$value->id}}" data-bs-toggle="modal" data-bs-target="#delete-post"><i class="far fa-trash-alt delet_1"></i>Delete
          </button>
          <button type="button" class="btn-elipse1 elipse_2 edit-link" data-post="{{json_encode($value)}}" data-bs-toggle="modal" data-bs-target="#edit-Post-1"><i class="fas fa-pen edit1"></i>Edit</button>
        </div>
      </div>
    </div> -->
    <i data-postId="{{ $value->id }}" class="showbutton_{{$value->id}}"> <img src="{{asset('Influencer/images/elipses.png')}}" alt=""></i>
    <div class="dropdown dropdown-action">

      <div class="elipse-wrap_{{$value->id}} elipse-wrap">

        <div class="show-elipse-card_{{$value->id}} boxsize_1 showbutton_{{ $value->id }}" style="display: none;">
          <button id="blockPostBtn" class="btn-elipse1 elipse_2" onclick="block_post('{{ $value->id}}')">
            <img src="{{ asset('Influencer/images/block.svg') }}"> Block
          </button>
          <form action="" id="blockForm{{$value->id}}">
            @csrf
            <input type="hidden" name="postID">
            <input type="hidden" name="influencerID">
          </form>
          {{-- <button type="button" class="btn-elipse1 elipse_2 edit-link" data-post="{{json_encode($value)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="{{asset('Influencer/images/report.svg')}}"> Report</button> --}}
          <button class="dropdown-item report-click btn-elipse1 elipse_2" data-id="{{$value->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="{{asset('Influencer/images/report.svg')}}"> Report</button>
        </div>
      </div>
    </div>

  </div>
  <div id="current-box-{{$index}}" class="owl-carousel">
   
   @foreach($value->images as $key => $img)
   @php
       $extension = pathinfo($img->post_img, PATHINFO_EXTENSION);
       $videoExtensions = ['mp4', 'webm', 'ogg', 'jfif'];
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

  <div class="icon_box">
    <ul class="comment_box2 pb-0">
      <li><a href="javascript:void(0)">
          @if($value->liked_by_user == true)
          <i class="fa fa-heart addClass_{{$value->id}}" onclick="likePost('{{$value->id}}')"></i>
          @else
          <i class="far fa-heart addClass_{{$value->id}}" onclick="likePost('{{$value->id}}')"></i>
          @endif

        </a></li>
      <li><a href="javascript:void(0)" class="post-data" onclick="getPostComment('{{$value->id}}')" data-value="{{json_encode($value)}}"><i class="far fa-comment"></i></a></li>
      <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#share"><i class="fas fa-paper-plane"></i></a></li>
    </ul>

    <div class="save_icon"><a href="javascript:void(0)">
        @if($value->bookMark_by_user == false)
        <i class="far fa-bookmark bookmarkclass_{{$value->id }}" onclick="addBookMark('{{$value->id}}')"></i>
        @else
        <i class="fa fa-bookmark bookmarkclass_{{$value->id }}" onclick="addBookMark('{{$value->id}}')"></i>
        @endif
      </a></div>

  </div>

  <div class="desc_box"><img src="{{asset('Influencer/images/login_img.png')}}"><a href="javascript:void(0)" class="pinktext" onclick="getLike('{{ $value->id}}')">Liked by</a>
    @if ($value->last_like_user)
    {{ $value->last_like_user->name }} <!-- Assuming 'name' is the attribute of the user you want to display -->
    @endif
    and <span class="postLike_{{$value->id }}"> {{count($value->countLike)}}</span> others
  </div>
  <div class="black_text">
    <a href="javascript:void(0)">View all <span class="totalComment_{{$value->id}}">{{ $value->count_coment_count}}</span> Comments</a>
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
     @if($userProfile && $userProfile->profile_img == '')
      <img src="{{asset('user.jpg')}}">
      @else
      <img src="{{ asset('Influencer/images/profile_img/' . ($userProfile->profile_img ?? 'dummy.jpg')) }}">

      @endif
    </div>

    <div class="post_search">
      <input type="text" class="comment-text" placeholder="Write a comment...">
      <a href="javascript:void(0)" data-postId="{{ $value->id }}" class="postComment"><img src="{{asset('Influencer/images/send3.png')}}" alt=""></a>
    </div>
  </div>
</div>
@endif
@endforeach
@else
<div>no data found</div>
@endif