@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>My Post and Post Stream | TidBid</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <style>
    .post_lgimg.mt-4 {
      width: 100%;
    }

    li.bell-icon {
      display: flex;
      align-items: center;
      margin-top: 6px;
      margin-left: 7px;
    }

    /* .postright {
      margin-bottom: 30px;
      background: #F9DDEF;
      padding: 30px;
      border-radius: 10px;
      margin-left: 20px;
      position: relative;
    } */

    #current-box .owl-dots {
      margin-top: 10px;
      display: flex;
      gap: 5px;
      align-items: center;
      justify-content: center;
    }

    #current-box .owl-dots button.owl-dot {
      width: 10px;
      height: 10px;
      background: #D9D9D9;
      border-radius: 10px;
    }

    #current-box .owl-dots button.owl-dot.active {
      background: #971c93;
    }
  </style>
</head>

@php
$user = DB::table('users')->where('id', session('user_id'))->first();
@endphp

<body>
    <!-- Header-Section -->
    @include('Influencer.layout.header1')
    <!-- Header-Section -->
    <!-- Main-Section -->
    <main>
        <section class="influ_profile">
            <div class="container">
                <div class="row influ_bg">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 ">
                        <div class="profile_box">
                            <div class="profile_img"><img
                                    src="{{asset('Influencer/images/profile_img/'.$user->profile_img)}}"></div>
                            <div class="profile_text">
                                <h5>{{$user->name}}</h5>
                                <p>{{$user->bio}}</p>
                                {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    has been the industry's standard dummy text ever since the.</p> --}}
                            </div>
                            <div class="follow_sect">
                                <p class="text_follow"><b class="text-dark">{{$totalpost}} </b>Posts</p>
                                <p class="text_follow"><b class="text-dark">{{$totalstream}} </b>Streams</p>
                                <p class="text_follow"><b class="text-dark">{{$totalfollowers}} </b>Followers</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <!-- <div class="chat_btn"><a href="user-chat.html">Chat <img src="images/chat.svg"></a></div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="follow_btn thre_btn"> -->
                        <div class="thre_btn">
                            <a href="{{url('influencer-my-live-stream/{id}')}}"><img
                                    src="{{asset('Influencer/images/ri_live-line.png')}}"> Go Live</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#post-stream"><i class="far fa-plus"></i>
                                Create Post
                                & Live Stream</a>
                            <a href="{{route('Influencer_My_Profile')}}"><i class="far fa-pen"></i> Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="Clear"></div>
        <div class="main_influncer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav nav-tabs1 nav tab2 mb-5">
                            <a href="{{route('Influencer_Stream')}}" class="nav-link1">Streams</a>
                            <a href="{{route('Influencer_Post')}}" class="nav-link1 active">Posts</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12 ">
                        <div class="post_left">
                            <div class="post_h">
                                <h4>Past Streams</h4>
                            </div>

                            <!--Item-->
                            @foreach($paststream as $value)
                            <div class="post_sect">
                                <div class="post_img"><img
                                        src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
                                <div class="post_text">
                                    <h5>{{$value->streamTitle}} <a href="influencers-my-streams-details.html"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img
                                                src="{{asset('Influencer/images/share_icon1.svg')}}"></a></h5>
                                    <p>{{$value->what_to_expect}}</p>

                                    <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                                        <p> <?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                                    </div>
                                    <div class="Post_icon"><i class="far fa-clock"></i>
                                        <p>{{$value->streamTime}}</p>
                                    </div>
                                    <div class="post_btn"><a
                                            href="{{url('/influencer-my-stream-details?stream_id='.$value->id)}}">View
                                            Details</a></div>
                                </div>
                            </div>
                            @endforeach
                            <!--Item-->

                        </div>

                        <div class="post_left">
                            <div class="post_h">
                                <h4 class="text-center">Refer a Friend</h4>
                            </div>

                            <div class="refer_img"><img src="{{asset('Influencer/images/refer_1.png')}}"></div>

                            <div class="refer_text">
                                <h5>Refer & Earn $10 auction free</h5>
                                <p>Invite your friend to join TidBid and both of you will get $10 for your next auction
                                    absolutely free.</p>
                                <a href="javascript:void(0)" data-url="{{url('')}}" data-referCode="145236"><img
                                        src="{{asset('Influencer/images/file-upload.svg') }}">Refer a friend</a>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="posthead">
                            <h3>All Post </h3>
                        </div>
                        <div id="data-wrapper">
                            @include('Influencer.partial-page.influencer-post-partial')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main-->

    <!-- Create stream -->
    <div class="modal fade" id="create-stream" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <h1 class="modal-title text-center report-h5">Create Post & Live Stream</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav nav-tabs1 nav popup_nav mb-4">
                                <a href="" class="nav-link1 active" data-bs-toggle="modal"
                                    data-bs-target="#create-stream">Streams</a>
                                <a href="" class="nav-link1" data-bs-toggle="modal"
                                    data-bs-target="#post-stream">Posts</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sign-in-inner ">
                                <form id="streamform" action="" style="flex:unset; align-items: flex-start;">
                                    @csrf
                                    <!-- <button><img src="images/user-signin/google-icon.svg" alt=""> Login with Google</button> -->
                                    <!-- <div class="or-line"><span>Or</span></div> -->
                                    <label for="">
                                        <input type="text" name="streamTitle" id="streamTitle"
                                            placeholder="Event Title">
                                        <span class="text-danger" id="streamTitleError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <input type="text" id="streamDate" placeholder="Date" name="streamDate"
                                                class="password">

                                        </div>
                                        <span class="text-danger" id="streamDateError"></span>
                                    </label>

                                    <!-- <label for="">
                    <div class="password-inner">
                      <input type="text" id="streamTime" placeholder="Time" name="streamTime" class="password">
                    </div> -->


                                    <!-- <label for="">
                                        <div class="password-inner">
                                            <input type="text" name="streamTime" value="" placeholder="Time"
                                                class="password stream-time">
                                        </div>
                                    </label> -->
                                    <label for="">
                                        <div class="password-inner">
                                            <input type="time" name="streamTime" value="timepicker password"
                                                placeholder="Time" class="password stream-time">
                                        </div>
                                    </label>

                                    <span class="text-danger" id="streamTimeError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <input type="price" placeholder="Base Price" name="baseBidPrice"
                                                class="password">
                                        </div>
                                        <span class="text-danger" id="baseBidPriceError"></span>

                                    </label>

                                    <label for="">
                                        <!-- <div class="password-inner">
                      <input type="price"  id="locationInput" placeholder="Location" name="baseBidPrice" class="password">
                    </div> -->
                                        <div class="input-fields-item">
                                            <div class="input-fields-item-image">
                                                <img src="{{ 'web-css-js-image/images/business-dashboard/profile/form-icons/2.svg' }}"
                                                    alt="">
                                            </div>
                                            <input type="text" name="location" class="common_read" id="address1"
                                                placeholder="Address*" value="">
                                            <input type="hidden" name="latitude" id="latitude" value="" readonly />
                                            <input type="hidden" name="longitude" id="longitude" value="}" readonly />
                                        </div>


                                    </label>
                                    <span class="text-danger" id="locationError"></span>
                                    <label for="">
                                        <div class="password-inner">
                                            <textarea placeholder="What to expect" name="what_to_expect"></textarea>

                                        </div>
                                        <span class="text-danger" id="what_to_expectError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <textarea placeholder="Terms and conditions"
                                                name="term_and_conditions"></textarea>

                                        </div>
                                        <span class="text-danger" id="term_and_conditionsError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <textarea placeholder="Description" name="description"></textarea>

                                        </div>
                                        <span class="text-danger" id="descriptionError"></span>
                                    </label>

                                    <div class="switchtomature">
                                        <div class="mature-text">
                                            <h1>Switch to Mature Posting </h1>
                                        </div>

                                        <label class="toggle">
                                            <input class="toggle-checkbox" type="checkbox">
                                            <div class="toggle-switch"></div>
                                        </label>
                                    </div>

                                    <label for="">
                                        <div class="password-inner">
                                            <input type="file" accept="image/png, image/jpeg," class="thumbnail_img" name="thumbnail_img"
                                                id="thumbnail_img" placeholder="Upload Thumbnail"
                                                onchange="previewImage()">
                                        </div>
                                        <span class="text-danger" id="thumbnail_imgError"></span>
                                    </label>
                                    <img src="#" alt="Thumbnail Preview" id="thumbnail_preview"
                                        style="display: none; max-width: 200px; max-height: 200px;">
                                    <input type="submit" value="Submit" class="mb-5">
                                    {{-- <button type="submit" class="mb-5">Submit</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create stream-->








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

    <!-- Create Posts -->

    <!-- Create Posts -->
    <div class="modal fade" id="post-stream" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>
                <div class="modal-body">
                    <h1 class="modal-title text-center report-h5">Create Post & Live Stream</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav nav-tabs1 nav popup_nav mb-4">
                                <a href="" class="nav-link1" data-bs-toggle="modal"
                                    data-bs-target="#create-stream">Streams</a>
                                <a href="" class="nav-link1 active" data-bs-toggle="modal"
                                    data-bs-target="#post-stream">Posts</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sign-in-inner ">
                                <form id="createPostForm" action="" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="post_upload1">

                                        <label for="media_upload">

                                            <i class="far fa-plus" id="upload-image"></i> <span>Add Photos/Videos</span>
                                        </label>

                                        <input type="file" accept="image/*,video/*" id="media_upload" name="media_upload[]"
                                            accept="image/*, video/*" style="display:none;" multiple>

                                    </div>

                                    <span class="text-danger" id="media_uploadError"></span>
                                    <div class="add-imag row"></div>







                                    <div class="post_dect">
                                        <p><b>Video Length :</b> 60 sec</p>
                                        <p><b>Photo Size :</b> 5MB/1024px</p>
                                    </div>
                                    <label for="">
                                        <b>Post Title:</b>
                                        <input type="text" name="title" id="title" placeholder="Title">
                                        <span class="text-danger" id="titleError"></span>
                                    </label>


                                    <label for="">
                                        <b>Location:</b>
                                        <div class="input-fields-item">
                                            <div class="input-fields-item-image">
                                                <img src="{{ 'web-css-js-image/images/business-dashboard/profile/form-icons/2.svg' }}"
                                                    alt="">
                                            </div>
                                            <input type="text" name="location" class="common_read" id="address2"
                                                placeholder="Address*" value="">
                                            <input type="hidden" name="latitude" id="latitude" value="" readonly />
                                            <input type="hidden" name="longitude" id="longitude" value="" readonly />
                                        </div>
                                        <span class="text-danger" id="locationError"></span>
                                    </label>



                                    <label for="">
                                        <b>Description:</b>
                                        <div class="password-inner">
                                            <textarea placeholder="Description" id="description"
                                                name="description"></textarea>

                                        </div>
                                        <span class="text-danger" id="Error"></span>
                                    </label>

                                    <input type="submit" value="Submit" class="mb-5">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Create Posts-->

    <!--Create Posts-->
    <!-- Edit Posts -->
    <div class="modal fade" id="edit-Post-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <h1 class="modal-title text-center report-h5">Edit Post</h1>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="nav nav-tabs1 nav popup_nav mb-4">
                                <!-- <a href="" class="nav-link1 " data-bs-toggle="modal" data-bs-target="#edit-stream">Streams</a> -->
                                <a href="" class="nav-link1 active" data-bs-toggle="modal"
                                    data-bs-target="#post-stream">Posts</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sign-in-inner ">
                                <form action="" id="postform" style="flex:unset; align-items: flex-start;"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="postId" class="postId" name="id" value="">


                                    <div class="post_upload1">
                                        <!-- <a href="#"><i class="far fa-plus"></i> <p>Add Photos/Videos</p></a> -->
                                        <label for="media_upload1">
                                            <i class="far fa-plus" id="upload-image-edit"></i> <span>Add
                                                Photos/Videos</span>
                                        </label>
                                        <input type="file" accept="image/*,video/*" id="media_upload_edit" name="media_upload_edit[]"
                                            accept="image/*, video/*" style="display:none;" multiple>
                                    </div>
                                    <span class="text-danger" id="post_imgError"></span>
                                    <div class="add-imag row"></div>


                                    <div class="upload_thumnail">

                                    </div>
                                    <div id="image-preview"></div>
                                    <div class="post_dect">
                                        <p><b>Video Length :</b> 60 sec</p>
                                        <p><b>Photo Size :</b> 5MB/1024px</p>
                                    </div>
                                    <label for="">
                                        <b>Post Title:</b>
                                        <input type="text" class="post-title" id="title" name="title"
                                            placeholder="Post Title" required>
                                    </label>
                                    <span class="text-danger" id="titleError"></span>
                                    <label for="">
                                        <b>Location:</b>
                                        <div class="input-fields-item">
                                            <div class="input-fields-item-image">
                                                <img src="{{ 'web-css-js-image/images/business-dashboard/profile/form-icons/2.svg' }}"
                                                    alt="">
                                            </div>
                                            <input type="text" name="location" class="common_read" id="address3"
                                                placeholder="Address*" value="">
                                            <input type="hidden" name="latitude" id="latitude" value="" readonly />
                                            <input type="hidden" name="longitude" id="longitude" value="" readonly />
                                        </div>
                                    </label>
                                    <span class="text-danger" id="locationError"></span>
                                    <label for="">
                                        <b>Description:</b>
                                        <div class="password-inner">

                                            <textarea placeholder="Description" class="post-description"
                                                name="description" id="description" required></textarea>
                                        </div>
                                    </label>
                                    <span class="text-danger" id="descriptionError"></span>
                                    <input type="submit" value="Save" class="mb-5">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Posts-->

    <!-- Delete Post-->
    <div class="modal fade" id="delete-post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog deletpopup">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">

                    <img src="{{asset('Influencer/images/delete_icon.png')}}">
                    <h1 class="modal-title text-center report-h5">Delete!</h1>
                    <p>Please confirm you want to delete this Post?</p>
                    <input type="hidden" name="postId" class="postId">
                    <div class="delete_out">
                        <a href="#" type="submit" class="yestbtn" onclick="deletePosts()">Yes</a>
                        <a href="#" class="nobtn" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Post-->

    <div class="modal fade" id="comment_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>
                <h1 class="modal-title text-center report-h5">Comments</h1>
                <div class="modal-body pt-0 pb-5 scrollbar scrollbar2" id="style-2">
                    <div class="like_outr force-overflow post-comment-section">

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--Like Popup -->
    <div class="modal fade" id="like_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>
                <h1 class="modal-title text-center report-h5">Likes</h1>
                <div class="modal-body pt-0 pb-5 scrollbar scrollbar2" id="style-2">
                    <div class="like_outr force-overflow likeed-user">



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Like Popup  -->

    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->
</body>

</html>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyC9NuN_f-wESHh3kihTvpbvdrmKlTQurxw&libraries=places">
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<script>
function reset() {
    location.reload(true)
}
$(document).ready(function() {
    $('#media_upload, #media_upload_edit').change(function(e) {
        // Clear previous previews
        $('.add-imag').empty();

        // Get selected files
        var files = e.target.files;

        // Allowed file extensions
        var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi'];

        // Loop through each file and create a preview
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            var fileExtension = getFileExtension(file.name).toLowerCase();

            // Check if file extension is allowed
            if (allowedExtensions.includes(fileExtension)) {
                reader.onload = function(e) {
                    if (fileExtension === 'mp4' || fileExtension === 'mov' || fileExtension === 'avi') {
                        // Video file preview
                        var previewElement = `
                            <div class="added-image" style="height: 78px; width: 23%;">
                                <div class="upload_img">
                                    <video controls width="640" height="360">
                                        <source src="${e.target.result}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="image_close">
                                    <img src="https://tradesman.tgastaging.com/admins/images/cancel-1.png" class="removeImag">
                                </div>
                            </div>`;
                    } else {
                        // Image file preview
                        var previewElement = `
                            <div class="added-image" style="height: 78px; width: 23%;">
                                <div class="upload_img">
                                    <img src="${e.target.result}" class="preview-image" style="width: 100%;">
                                </div>
                                <div class="image_close">
                                    <img src="https://tradesman.tgastaging.com/admins/images/cancel-1.png" class="removeImag">
                                </div>
                            </div>`;
                    }

                    $('.add-imag').append(previewElement);
                };

                reader.readAsDataURL(file);
            } else {
                toastr.error('Invalid file type. Please select an image (jpg, jpeg, png, gif) or a video (mp4, mov, avi) file.');
              //  alert('Invalid file type. Please select an image (jpg, jpeg, png, gif) or a video (mp4, mov, avi) file.');
                // Clear file input field (optional)
                document.getElementById("media_upload").value = "";
                $('.add-imag').empty(); // Clear any previews added
                return; // Exit function if file type is not allowed
            }
        }
    });

    // Remove preview on click
    $(document).on("click", ".removeImag", function() {
        $(this).closest('.added-image').remove();
    });

    // Function to get file extension
    function getFileExtension(filename) {
        return filename.split('.').pop().toLowerCase();
    }
});
</script>
<script>
$(function() {
    $("#streamDate").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0
    });
});
</script>



<!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
<script>
$(document).ready(function() {
    $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '10',
        maxTime: '6:00pm',
        defaultTime: '11',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});
</script>
<script>
function getLike(id) {
    if (id) {
        $.ajax({
            url: "{{('getPost_like')}}",
            method: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(resp) {
                $('.likeed-user').html(resp.html)
                $('#like_popup').modal('show');
            }
        })
    }
}


function getPostComment(id) {
    if (id) {
        $.ajax({
            url: "{{('get-Post-comment')}}",
            method: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(resp) {
                $('.post-comment-section').html(resp.html)
                $('#comment_popup').modal('show');
            }
        })



    }
}
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select the link element
    const copyLink = document.querySelector('a[data-url][data-referCode]');

    // Add click event listener to the link
    copyLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        // Get the data-url and data-referCode attributes
        const dataUrl = copyLink.getAttribute('data-url');
        const referCode = copyLink.getAttribute('data-referCode');

        // Combine the attribute values into a single string
        const combinedValue = `URL: ${dataUrl}, Refer Code: ${referCode}`;

        // Create a temporary input element
        const tempInput = document.createElement('input');
        tempInput.value = combinedValue;
        document.body.appendChild(tempInput);

        // Select the text in the input element
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected text to the clipboard
        document.execCommand('copy');

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // Alert the user or update the link text to indicate successful copy
        alert('values copied to clipboard');
    });
});
/** Add bookMark */
function addBookMark(id) {
    if (id) {
        $.ajax({
            url: "{{url('add-post-book-mark')}}",
            method: 'POST',
            data: {
                'postid': id
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.status == 1) {
                    $('.bookmarkclass_' + id).removeClass('far fa-bookmark');
                    $('.bookmarkclass_' + id).addClass('fa fa-bookmark');
                    toastr.success(data.message);
                } else {
                    $('.bookmarkclass_' + id).removeClass('fa fa-bookmark');
                    $('.bookmarkclass_' + id).addClass('far fa-bookmark');

                    toastr.success(data.message);
                }
            }

        })
    } else {
        toastr.error('post id required..');
    }
}



/** post comment */
$(document).on('click', '.postComment', function() {
    var commentValue = $(this).closest('.post_search').find('.comment-text').val();
    var postid = $(this).attr('data-postId');
    if (commentValue != '' && postid != '') {
        $('.comment-text').val('');
        $.ajax({
            url: "{{url('post-commnet')}}",
            method: "POST",
            data: {
                'commentValue': commentValue,
                'postid': postid
            },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.status == true) {
                    $('.totalComment_' + postid).text(data.totalComment);
                    //  $(this).closest('.post_search').find('.comment-text').val('');
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        })

    } else {
        toastr.error('plese enter comment');
    }
});

function likePost(id) {
    $.ajax({
        url: "{{url('post-like')}}",
        method: "POST",
        data: {
            'postid': id
        },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if (data.status == 1) {
                $('.addClass_' + id).removeClass('far fa-heart');
                $('.addClass_' + id).addClass('fa fa-heart');
                $('.postLike_' + id).text(data.totalLike);
                toastr.success(data.message);

            } else if (data.status == 2) {
                $('.addClass_' + id).removeClass('fa fa-heart');
                $('.addClass_' + id).addClass('far fa-heart');
                $('.postLike_' + id).text(data.totalLike);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    })
}

$(document).on('click', '.showbutton', function() {
    var postId = $(this).attr('data-postId');
    //alert(postId);
    $('.showbutton_' + postId).toggle();
})
</script>



<script>
var ENDPOINT = "{{ url('influencer-post') }}";
var page = 1;
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 5)) {
        page++;
        infinteLoadMore(page);
    }
});

function infinteLoadMore(page) {
    $.ajax({
            url: ENDPOINT + "?page=" + page,
            datatype: "html",
            type: "get",
            beforeSend: function() {
                $('.auto-load').show();
            }
        })
        .done(function(response) {
            if (response.html == '') {
                $('.auto-load').html("We don't have more data to display :(");
                return;
            }

            $('.auto-load').hide();
            $("#data-wrapper").append(response.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
}

// Preview the post create image //

$(document).ready(function() {
    $('#post_img').change(function() {
        $('#image-preview').empty();
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').append('<img src="' + e.target.result +
                    '" width="75" height="75">');
            }
            reader.readAsDataURL(files[i]);
        }
    });
});

// End Preview the post create image //



//create  post //
$(document).ready(function() {
    $(document).on('click', '#upload-image', function(e) {
        e.preventDefault();
        $('#media_upload').click();
        console.log('image', $('#media_upload').val());
    })
    $('#post-stream').on('hidden.bs.modal', function() {
        $('#createPostForm')[0].reset();
    });
});
$(document).ready(function() {
    $('#create-stream').on('hidden.bs.modal', function() {
        $('#streamform')[0].reset();
    });
});

$(document).ready(function() {
    $('#createPostForm').submit(function(e) {
        e.preventDefault();
        $('.text-danger').text('');

        $.ajax({
            url: "{{ route('Influencer_Create_Post') }}",
            type: 'Post', // Change GET to POST
            data: new FormData(this), // Use FormData to handle file uploads
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success('Post created successfully');
                $('#post-stream').modal('hide');
                window.location.href = "{{ route('Influencer_Post') }}";
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        if (key == "description") {
                            // Display validation error for textarea
                            $('#Error').text(value[0]);
                        } else {
                            // Display validation error for other fields
                            $('#' + key + 'Error').text(value[0]);
                        }
                    });
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    });
});

// End create  post //


// data fetching for edit Post //

$(document).ready(function() {
    $('.edit-link').on('click', function() {
        var post = $(this).data('post');
        // console.log('stream',stream);
        $('.postId').val(post.id);
        $('.post-title').val(post.title);
        $('#address3').val(post.location);
        $('.post-description').val(post.description);
        $('.stream-thumbnail_img').val(stream.thumbnail_img);
        // console.log('hi');
    });
});

// End data fetching for edit post //

// $(document).ready(function() {
//   $(document).on('click', '#upload-image-edit', function(e) {
//     e.preventDefault();
//     $('#media_upload_edit').click();
//     console.log('image', $('#media_upload_edit').val());
//   })
// // updating the post //
// $(document).ready(function() {
//   $('#postform').submit(function(event) {
//     event.preventDefault();

//     var formData = new FormData($(this)[0]);

//     $.ajax({
//       url: "{{route('Influencer_Update_Post')}}",
//       type: 'POST',
//       data: formData,
//       async: false,
//       cache: false,
//       contentType: false,
//       processData: false,
//       success: function(response) {
//         // alert('hi');
//         console.log(response.success);
//         if (response.success) {
//           window.location.reload();
//           $('#edit-Post-1').modal('hide');
//         }
//       },
//       error: function(xhr, status, error) {
//         // Handle errors
//         console.error(xhr.responseText);
//       }
//     });
//   });
// });

$(document).ready(function() {

    $(document).on('click', '#upload-image-edit', function(e) {
        e.preventDefault();
        $('#media_upload_edit').click();
    });


    $('#postform').submit(function(event) {
        event.preventDefault();

        var formData = new FormData($(this)[0]);

        $('.text-danger').text('');
        $.ajax({
            url: "{{ route('Influencer_Update_Post') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.success);
                if (response.success) {
                    window.location.reload();
                    $('#edit-Post-1').modal('hide');
                }
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        if (key == "description") {
                            // Display validation error for textarea
                            $('#Error').text(value[0]);
                        } else {
                            // Display validation error for other fields
                            $('#' + key + 'Error').text(value[0]);
                        }
                    });
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    });
});


// End updating post //

//delete post //

$(document).ready(function() {
    $(document).on('click', '.deletePost', function() {
        var postId = $(this).data('id');
        // alert(streamId);
        if (postId) {
            $('.postId').val(postId);
            $('#delete-post').modal('show');
        } else {
            alert('Post id not found')
        }
    });
});

function deletePosts() {
    var id = $('.postId').val();
    $.ajax({
        url: "{{route('Influencer_Delete_Post')}}",
        method: 'GET',
        data: {
            postId: id
        },
        dataType: 'json',
        success: function(data) {
            //  console.log($data);
            // Optionally, you can remove the deleted FAQ item from the DOM
            if (data.status == 1) {
                location.reload(true)
            } else {
                alert('something is wrong')
            }
            //  console.log($data);
            $('#delete-post').model('hide');
        },
        error: function(xhr, status, error) {
            alert('Error deleting Post');
        }
    });
}

//delete post //


//  creating stream  //

$(document).ready(function() {
    $('#streamform').submit(function(e) {
        e.preventDefault();
        $('.text-danger').text('');
        $.ajax({
            url: "{{ route('Influencer_Create_Stream') }}",
            type: 'POST', // Change GET to POST
            data: new FormData(this), // Use FormData to handle file uploads
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success('Streem created successfully');
                $('#exampleModal_1').modal('hide');
                window.location.href = "{{ route('Influencer_Stream') }}";
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#' + key + 'Error').text(value[0]);
                    });
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    });
});

// End creating stream  //



// showing preview image //

function previewImage() {
    var reader = new FileReader();
    var file = document.getElementById("thumbnail_img").files[0];

    // Check if file is selected
    if (file) {
        // Check if the selected file is an image
        if (file.type.match('image.*')) {
            reader.onload = function(e) {
                $('#thumbnail_preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            toastr.error('Please select a valid image file.');
            // Clear file input field (optional)
            document.getElementById("thumbnail_img").value = "";
            $('#thumbnail_preview').hide(); // Hide preview if invalid file
        }
    }
}

// end for showing preview image //
</script>


<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyC9NuN_f-wESHh3kihTvpbvdrmKlTQurxw&libraries=places">
</script>
<script>
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
    var input = document.getElementById('address1');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        // place variable will have all the information you are looking for.
        document.getElementById("latitude").value = place.geometry['location'].lat();
        document.getElementById("longitude").value = place.geometry['location'].lng();
    });
}
</script>
<script>
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
    var input = document.getElementById('address2');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        // place variable will have all the information you are looking for.
        document.getElementById("latitude").value = place.geometry['location'].lat();
        document.getElementById("longitude").value = place.geometry['location'].lng();
    });
}
</script>
<script>
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
    var input = document.getElementById('address3');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        // place variable will have all the information you are looking for.
        document.getElementById("latitude").value = place.geometry['location'].lat();
        document.getElementById("longitude").value = place.geometry['location'].lng();
    });
}
</script>
<style>
.pac-container {
    z-index: 9999;
}
</style>


@foreach($postData as $key => $value)

<script>
 
  $(document).ready(function() {
    $("#current-box-{{$key}}").owlCarousel({
      items: 1,
      loop: false,
      center: false,
      autoplay: false,
      margin: 20,
      dots: true,
      nav: true,
      rewind: true,
      autoplayTimeout: 3000,
      autoplaySpeed: 1000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 1,
        }
      }
    });
    $(".owl-prev").html('<i class="far fa-chevron-left"></i>');
    $(".owl-next").html('<i class="far fa-chevron-right"></i>');
  });
</script>


@endforeach