@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>My Streams and Post Stream | TidBid</title>
    <style>
        .right-upload {
            right: 10px;
        }

        .what_to_expect {
            width: 100%;
            height: auto;
            padding: 12px 5px 12px 15px;
            border-radius: 30px;
            border: 1px solid rgba(176, 42, 172, 1);
            background: #FFF;
        }
    </style>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
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
                    <!-- <div class="col-lg-3"></div> -->
                    <div class="col-lg-12 ">
                        <div class="profile_box">
                            @if(request()->session()->has('profile_img'))
                            <!--<div class="profile_img"><img src="{{asset('Influencer/images/profile_img/'.$user->profile_img)}}"></div>-->
                            <div class="profile_img"><img src="{{asset('Influencer/images/profile_img/'.$user->profile_img)}}"></div>

                            @else
                            <!-- Display a default image when no image is uploaded -->
                            <div class="profile_img">
                                <a href="{{ route('Influencer_My_Profile') }}">
                                    <img src="{{ asset('Influencer/images/profile_img/1714652397_dummy_image.png') }}">
                                </a>
                            </div>
                            @endif

                            <div class="profile_text">
                                <h5>{{ $user->name }}</h5>
                                <p>{{ implode(' ', array_slice(str_word_count($user->bio, 1), 0, 100)) }}</p>
                            </div>

                            <div class="follow_sect">
                                <p class="text_follow"><b class="text-dark">{{$totalcount}} </b>Posts</p>
                                <p class="text_follow"><b class="text-dark">{{$streamcount}} </b>Streams</p>
                                <p class="text_follow"><b class="text-dark">{{$totalfollowers}} </b>Followers</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="thre_btn">
                            {{-- <a href="{{route('go_live')}}"><img src="{{asset('Influencer/images/ri_live-line.png') }}"> Go Live</a> --}}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#go_live"><img src="{{asset('Influencer/images/ri_live-line.png') }}"> Go Live</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#create-stream"><i class="far fa-plus"></i> Create Post
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
                            <a href="{{route('Influencer_Stream')}}" class="nav-link1 active">Streams</a>
                            <a href="{{route('Influencer_Post')}}" class="nav-link1">Posts</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Upcoming Live Streams</h2>
                        </div>
                    </div>

                    <!--itme-->
                    @if ($streamdata->isEmpty())
                    <h5>No stream data found !</h5>
                    @else
                    @foreach($streamdata as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1">
                            <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'.$value->thumbnail_img)}}" style="height: 200px;"></div>
                            <div class="influtext">
                                <h3>
                                    <!-- <a href="{{url('/influencer-my-stream-details?stream_id='.$value->id)}}">{{$value->streamTitle}}</a> -->
                                    <a href="#">{{$value->streamTitle}}</a>
                                </h3>
                                {{-- <p>{{$value->what_to_expect}}</p> --}}
                                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 9)) }}</p>
                                <div class="shedul">
                                    <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt="">
                                        <?php echo date('d-m-Y', strtotime($value->streamDate)); ?>
                                    <p class="gray_text"><i class="far fa-clock"></i>
                                        {{date('h:i A', strtotime($value->streamTime))}}
                                    </p>
                                </div>
                                <p class="pink_text1"><span>Base Price :</span> ${{$value->baseBidPrice}}</p>

                                <div class="stream_btn">
                                    @php
                                    $date = date('Y-m-d');
                                    $Currenttime = date('H:i:s');
                                    @endphp
                                    @if($value->streamDate == $date && $value->streamTime <= $Currenttime)
                                    <a href="{{url('influencer-my-live-stream/'.$value->id)}}" class="notify_btn spac_btn edit-link">Start Now</a>
                                    @else
                                    <a href="javascript:void(0)" class="notify_btn spac_btn edit-link" data-stream="{{json_encode($value)}}" data-bs-toggle="modal" data-bs-target="#edit-stream">Edit</a>
                                    <a href="javascript:void(0)" class="join_btn spac_btn deleteStream" data-bs-toggle="modal" data-bs-target="#delete-stream" data-id="{{$value->id}}">Delete</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <!--itme-->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading mt-4">
                            <h2>Past Streams</h2>
                        </div>
                    </div>
                    <!--itme-->
                    @if ($paststreamdata->isEmpty())

                    <h5>No past stream data found !</h5>
                    @else
                    @foreach($paststreamdata as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1 ">
                            <div class="top_tag">
                                <a href="#" class="strem_tag">&nbsp;</a>
                                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
                            </div>
                            <div class="influimg1"><img src="{{asset('/Influencer/images/thumbnail/'. $value->thumbnail_img)}}" style="height: 200px;"></div>
                            <div class="influtext">
                                <h3><a href="{{url('/influencer-my-stream-details?stream_id='.$value->id)}}">{{$value->streamTitle}}</a>
                                </h3>
                                {{-- <p>{{$value->what_to_expect}}</p> --}}
                                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 9)) }}</p>
                                <div class="shedul">
                                    <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt="">
                                        <?php echo date('m-d-Y', strtotime($value->streamDate)); ?>
                                    </p>

                                    <p class="gray_text"><i class="far fa-clock">&nbsp;</i>{{date('h:i A', strtotime($value->streamTime))}}
                                    </p>
                                </div>
                                <div class="stream_btn">
                                    <a href="{{url('/influencer-my-stream-details?stream_id='.$value->id)}}" class="notify_btn">View detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <!--itme-->
                </div>
            </div>
        </div>
    </main>
    <!-- Main-Section -->
    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->

    <!-- Popup share -->
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body pt-0 pb-5 ">
                    <h1 class="modal-title text-center report-h5">Share </h1>
                    <ul class="social_icon">
                        <li><a href="https://www.facebook.com/" target="_blank"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
                        <li><a href="https://www.instagram.com/" target="_blank"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                        <li><a href="https://x.com/?lang=en" target="_blank"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
                        <li><a href="https://in.linkedin.com/" target="_blank"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup share -->

    <!-- Go Live Pop-up -->
    <div class="modal fade" id="go_live" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close close-modal-data" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <h1 class="modal-title text-center report-h5">Live Stream</h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sign-in-inner ">
                                <form id="go_live_form" action="" style="flex:unset; align-items: flex-start;">
                                    @csrf
                                    <label for="">
                                        <input type="text" name="streamTitle" id="streamTitle" placeholder="Event Title">
                                        <span class="text-danger" id="streamTitleError"></span>
                                    </label>

                                    {{-- <label for="">
                                        <div class="password-inner ">
                                            <input type="text" id="streamDate" class="streamDate" placeholder="Date" name="streamDate" class="password">
                                        </div>
                                        <span class="text-danger" id="streamDateError"></span>
                                    </label> --}}

                                    {{-- <label for="">
                                        <div class="password-inner">
                                            <input type="time" name="streamTime" value="timepicker password" placeholder="Time" class="password stream-time">
                                        </div>
                                    </label> --}}

                                    <span class="text-danger" id="streamTimeError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <input type="price" placeholder="Base Price" name="baseBidPrice" class="password">
                                        </div>
                                        <span class="text-danger" id="baseBidPriceError"></span>
                                    </label>
                                    <label for="">
                                        <div class="input-fields-item">
                                            <div class="input-fields-item-image">
                                                <img src="{{ 'web-css-js-image/images/business-dashboard/profile/form-icons/2.svg' }}" alt="">
                                            </div>
                                            <!-- <input type="text" name="location" class="common_read" id="address1" placeholder="Address*" value=""> -->
                                            <input type="hidden" name="latitude" id="latitude" value="" readonly />
                                            <input type="hidden" name="longitude" id="longitude" value="" readonly />
                                        </div>
                                    </label>
                                    <span class="text-danger" id="locationError"></span>
                                    <label for="">
                                        <div class="password-inner">
                                            <select name="what_to_expect" class="what_to_expect">
                                                <option value="">Select what to expect</option>
                                                <option value="Private_Video_call">Private Video call</option>
                                                <option value="Private_chat">Private chat</option>
                                            </select>

                                        </div>
                                        <span class="text-danger" id="what_to_expectError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <textarea placeholder="Terms and conditions" name="term_and_conditions"></textarea>

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
                                            <input type="file" accept="image/*" class="thumbnail_img" name="thumbnail_img" id="thumbnail_img" placeholder="Upload Thumbnail" onchange="previewImage()">
                                        </div>
                                        <span class="text-danger" id="thumbnail_imgError"></span>
                                    </label>
                                    <img src="#" alt="Thumbnail Preview" id="thumbnail_preview" style="display: none; max-width: 200px; max-height: 200px;">
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
    <!-- Go Live Pop-up -->

    <!-- Create stream -->
    <div class="modal fade" id="create-stream" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close close-modal-data" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <h1 class="modal-title text-center report-h5">Create Post & Live Stream</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav nav-tabs1 nav popup_nav mb-4">
                                <a href="" class="nav-link1 active" data-bs-toggle="modal" data-bs-target="#streamform">Stream</a>
                                <a href="" class="nav-link1" data-bs-toggle="modal" data-bs-target="#post-stream">Post</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sign-in-inner ">
                                <form id="streamform" action="" style="flex:unset; align-items: flex-start;">
                                    @csrf
                                    <!-- <button><img src="images/user-signin/google-icon.svg" alt=""> Login with Google</button> -->
                                    <!-- <div class="or-line"><span>Or</span></div> -->
                                    <label for="">
                                        <input type="text" name="streamTitle" id="streamTitle" placeholder="Event Title">
                                        <span class="text-danger" id="streamTitleError"></span>
                                    </label>


                                    <label for="">
                                        <div class="password-inner ">
                                            <input type="text" id="streamDate" class="streamDate" placeholder="Date" name="streamDate" class="password">

                                        </div>
                                        <span class="text-danger" id="streamDateError"></span>
                                    </label>

                                    <!-- <label for="">
                    <div class="password-inner">
                      <input type="text" id="streamTime" placeholder="Time" name="streamTime" class="password">
                    </div> -->


                                    <label for="">
                                        <div class="password-inner">
                                            <input type="time" name="streamTime" value="timepicker password" placeholder="Time" class="password stream-time">
                                        </div>
                                    </label>

                                    <span class="text-danger" id="streamTimeError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <input type="price" placeholder="Base Price" name="baseBidPrice" class="password">
                                        </div>
                                        <span class="text-danger" id="baseBidPriceError"></span>

                                    </label>

                                    <label for="">
                                        <!-- <div class="password-inner">
                      <input type="price"  id="locationInput" placeholder="Location" name="baseBidPrice" class="password">
                    </div> -->
                                        <div class="input-fields-item">
                                            <div class="input-fields-item-image">
                                                <img src="{{ 'web-css-js-image/images/business-dashboard/profile/form-icons/2.svg' }}" alt="">
                                            </div>
                                            <!-- <input type="text" name="location" class="common_read" id="address1" placeholder="Address*" value=""> -->
                                            <input type="hidden" name="latitude" id="latitude" value="" readonly />
                                            <input type="hidden" name="longitude" id="longitude" value="" readonly />
                                        </div>


                                    </label>
                                    <span class="text-danger" id="locationError"></span>
                                    <label for="">
                                        <div class="password-inner">
                                            <select name="what_to_expect" class="what_to_expect">
                                                <option value="">Select what to expect</option>
                                                <option value="Private_Video_call">Private Video call</option>
                                                <option value="Private_chat">Private chat</option>
                                            </select>

                                        </div>
                                        <!-- <div class="password-inner">
                                            <textarea placeholder="What to expect" name="what_to_expect"></textarea>

                                        </div> -->
                                        <span class="text-danger" id="what_to_expectError"></span>
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <textarea placeholder="Terms and conditions" name="term_and_conditions"></textarea>

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
                                            <input type="file" accept="image/*" class="thumbnail_img" name="thumbnail_img" id="thumbnail_img" placeholder="Upload Thumbnail" onchange="previewImage()">
                                        </div>
                                        <span class="text-danger" id="thumbnail_imgError"></span>
                                    </label>
                                    <img src="#" alt="Thumbnail Preview" id="thumbnail_preview" style="display: none; max-width: 200px; max-height: 200px;">
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

    <!-- Create Posts -->
    <div class="modal fade" id="post-stream" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="reset()" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <h1 class="modal-title text-center report-h5">Create Post & Live Stream</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav nav-tabs1 nav popup_nav mb-4">
                                <a href="" class="nav-link1" data-bs-toggle="modal" data-bs-target="#create-stream">Stream</a>
                                <a href="" class="nav-link1 active" data-bs-toggle="modal" data-bs-target="#post-stream">Post</a>
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
                                        <input type="file" accept="image/*,video/*" id="media_upload" name="media_upload[]" accept="image/*, video/*" style="display:none;" multiple>

                                    </div>

                                    <span class="text-danger" id="media_uploadError"></span>
                                    <div class="add-imag row"></div>



                                    <span class="text-danger" id="post_imgError"></span>
                                    <div id="image-preview"></div>
                                    <div class="post_dect">
                                        <p><b>Video Length :</b> 60 sec</p>
                                        <p><b>Photo Size :</b> 5MB/1024px</p>
                                    </div>
                                    <label for="">
                                        <b>Post Title:</b>
                                        <input type="text" name="title" id="title" placeholder="Title">
                                        <span class="text-danger" id="titleError"></span>
                                    </label>


                                    <!--<label for="">-->
                                    <!--    <b>Location:</b>-->
                                    <!--    <div class="input-fields-item">-->
                                    <!--        <div class="input-fields-item-image">-->
                                    <!--            <img src="{{ 'web-css-js-image/images/business-dashboard/profile/form-icons/2.svg' }}" alt="">-->
                                    <!--        </div>-->
                                            <!-- <input type="text" name="location" class="common_read" id="address2" placeholder="Address*" value=""> -->
                                    <!--        <input type="hidden" name="latitude" id="latitude" value="" readonly />-->
                                    <!--        <input type="hidden" name="longitude" id="longitude" value="" readonly />-->
                                    <!--    </div>-->
                                        <!-- <span class="text-danger" id="Error"></span> -->
                                    <!--</label>-->


                                    <!-- <label for="">
                    <b>Description:</b>
                    <div class="password-inner">
                      <textarea placeholder="Description" id="description" name="description"></textarea>
                      <span class="text-danger" id="descriptionError"></span>
                    </div>

                  </label> -->
                                    <label for="">
                                        <b>Description:</b>
                                        <div class="password-inner">
                                            <textarea placeholder="Description" id="description" name="description"></textarea>

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

    <!-- Edit Posts -->
    <div class="modal fade" id="edit-Post-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <h1 class="modal-title text-center report-h5">Edit Post & Live Stream</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav nav-tabs1 nav popup_nav mb-4">
                                <a href="" class="nav-link1 " data-bs-toggle="modal" data-bs-target="#edit-stream">Streams</a>
                                <a href="" class="nav-link1 active" data-bs-toggle="modal" data-bs-target="#post-stream">Posts</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sign-in-inner ">
                                <form action="" style="flex:unset; align-items: flex-start;">
                                    <div class="post_upload1">
                                        <a href="#"><i class="far fa-plus"></i>
                                            <p>Add Photos/Videos</p>
                                        </a>
                                    </div>
                                    <div class="upload_thumnail">
                                        <ul>
                                            <li>
                                                <div class="upl_img"><img src="{{asset('Influencer/images/upload_thumnail.png')}}"></div>
                                            </li>
                                            <li>
                                                <div class="upl_img">
                                                    <img src="{{asset('Influencer/images/upload_thumnail.png')}}">
                                                </div>
                                                <div class="playbtn"><img src="{{asset('Influencer/images/play.png')}}">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="upl_img">
                                                    <img src="{{asset('Influencer/images/upload_thumnail.png')}}">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="upl_img">
                                                    <img src="{{asset('Influencer/images/upload_thumnail.png')}}">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="post_dect">
                                        <p><b>Video Length :</b> 60 sec</p>
                                        <p><b>Photo Size :</b> 5MB/1024px</p>
                                    </div>
                                    <label for="">
                                        Post Title:
                                        <input type="text" placeholder="Lorem Ipsum is simply">
                                    </label>
                                    <label for="">
                                        <div class="password-inner">
                                            <textarea placeholder="Lorem Ipsum is simply dummy"></textarea>
                                        </div>
                                    </label>
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

    <!-- Edit Stream -->
    <div class="modal fade" id="edit-stream" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body p-0 ">
                    <h1 class="modal-title text-center report-h5">Edit Live Stream</h1>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="nav nav-tabs1 nav popup_nav mb-4">
                                <a href="" class="nav-link1 active" data-bs-toggle="modal" data-bs-target="#create-stream">Streams</a>
                                <!-- <a href="" class="nav-link1" data-bs-toggle="modal" data-bs-target="#edit-Post-1">Posts</a> -->
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sign-in-inner ">

                                <form action="" id="popupform" style="flex:unset; align-items: flex-start;" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="streamId" class="streamId" name="user_id" value="">
                                    <label for="">
                                        Stream Title:
                                        <input class="stream-title" type="text" id="streamTitle" value="" name="streamTitle" placeholder="Lorem Ipsum is simply" required>
                                    </label>
                                    <label for="">
                                        Stream Date:
                                        <div class="password-inner">
                                            <input type="text" name="streamDate" class="streamDate" value="" placeholder="" class="password stream-date " required>
                                        </div>
                                    </label>
                                    <label for="">
                                        Stream Time:
                                        <div class="password-inner">
                                            <input type="time" name="streamTime" value="" placeholder="07:00 PM" class="password stream-time" required>
                                        </div>
                                    </label>
                                    <label for="">
                                        Base Price:
                                        <div class="password-inner">
                                            <input type="price" name="baseBidPrice" value="" placeholder="$100" class="password stream-bidprice" required>
                                        </div>
                                    </label>
                                    <label for="">
                                        What to Expect:
                                        <div class="password-inner">
                                            <textarea placeholder="15 mins private chat" class="stream-expect" name="what_to_expect" required></textarea>
                                        </div>
                                    </label>
                                    <label for="">
                                        Term & Condition:
                                        <div class="password-inner">
                                            <textarea class="stream-term" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry." name="term_and_conditions" id="term_and_conditions" required></textarea>
                                        </div>
                                    </label>
                                    <label for="">
                                        Description:
                                        <div class="password-inner">
                                            <textarea class="stream-description" placeholder="It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout." name="description" id="description" required></textarea>
                                        </div>
                                    </label>


                                     <img src="#" alt="Thumbnail Preview" id="thumbnail_preview" style="max-width: 200px; max-height: 200px;"> 
                                    <input type="file" class="password" name="thumbnail_img" id="stream-thumbnail_img" onchange="editpreviewImage()">


                                    <!-- Preview image container -->
                                    <!-- <img src="#" alt="Thumbnail Preview" id="thumbnail_preview" style="display: none; max-width: 200px; max-height: 200px;"> -->

                                    <input type="submit" value="submit" class="mb-5">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit stream-->

    <!-- Delete Stream-->
    <div class="modal fade" id="delete-stream" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog deletpopup">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <img src="{{asset('Influencer/images/delete_icon.png')}}">
                    <h1 class="modal-title text-center report-h5">Delete!</h1>
                    <p>Please confirm you want to delete this Stream?</p>
                    <input type="hidden" name="streamId" class="streamId">
                    <div class="delete_out">
                        <a href="#" type="submit" class="yestbtn" onclick="deleteStreams()">Yes</a>
                        <a href="#" class="nobtn" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Stream-->
</body>
</html>
@endsection

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<script>
    $(function() {
        $(".streamDate").datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0,

        });
    }); 
</script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
    function reset() {
        location.reload(true)
    }
    $(document).ready(function() {
        $('#media_upload').change(function(e) {
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
    // document.addEventListener('DOMContentLoaded', function() {

    //     flatpickr(".stream-time", {
    //         enableTime: true,
    //         noCalendar: true,
    //         dateFormat: "h:i K",
    //         time_24hr: false
    //     });
    // });
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

{{-- 13-11-2025 --}}
<script>
    $(document).ready(function() {
        $(document).on('click', '#upload-image', function(e) {
            e.preventDefault();

            $('#media_upload').click();
        })
        $('#go_live').on('hidden.bs.modal', function() {
            $('#go_live_form')[0].reset();
        });
    });

    $(document).ready(function() {
        $('#go_live_form').submit(function(e) {
            e.preventDefault();
            $('.text-danger').text('');
            $.ajax({
                url: "{{ route('Influencer_Live_Stream') }}",
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('#exampleModal_1').modal('hide');
                        // toastr.success('Stream created successfully');
                        window.location.href = "{{ url('influencer-my-live-stream') }}/" + response.data.id;
                    }
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
</script>
{{-- 13-11-2025 --}}

<script>
    $(document).ready(function() {
        $(document).on('click', '#upload-image', function(e) {
            e.preventDefault();

            $('#media_upload').click();
        })
        $('#create-stream').on('hidden.bs.modal', function() {
            $('#streamform')[0].reset();
        });
    });
    $(document).ready(function() {
        $('#post-stream').on('hidden.bs.modal', function() {
            $('#createPostForm')[0].reset();
        });
    });

    $(document).ready(function() {
        $('#streamform').submit(function(e) {
            e.preventDefault();
            $('.text-danger').text('');
            $.ajax({
                url: "{{ route('Influencer_Create_Stream') }}",
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#exampleModal_1').modal('hide');
                    toastr.success('Streem created successfully');
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

    function editpreviewImage() {
        var reader = new FileReader();
        var file = document.getElementById("stream-thumbnail_img").files[0];
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
                document.getElementById("stream-thumbnail_img").value = "";
                $('#thumbnail_preview').hide(); // Hide preview if invalid file
            }
        }
    }

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

    // data fetching for edit stream //
    $(document).ready(function() {
        $('.edit-link').on('click', function() {
            var stream = $(this).data('stream');
            // console.log('stream',stream);
            var momentDate = moment(stream.streamDate);

            var date = momentDate.format('DD-MM-YYYY')

            $('.streamId').val(stream.id);
            $('.stream-title').val(stream.streamTitle);
            $('.streamDate').val(date);
            $('.stream-time').val(stream.streamTime);
            $('.stream-bidprice').val(stream.baseBidPrice);
            $('.stream-expect').val(stream.what_to_expect);
            $('.stream-term').val(stream.term_and_conditions);
            $('.stream-description').val(stream.description);
            $('.stream-thumbnail_img').val(stream.thumbnail_img);

            // $('.stream-thumbnail_img').val(stream.thumbnail_img);
            console.log('hi');
        });
    });



    // End data fetching for edit stream //



    // updating the stream //
    $(document).ready(function() {
        $('#popupform').submit(function(event) {
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "{{ route('Influencer_Update_Stream') }}",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // alert('hi');
                    console.log(response.success);
                    if (response.success) {
                        window.location.reload();
                        $('#edit-stream').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });

    // End updating stream //

    //delete stream //

    $(document).ready(function() {
        $(document).on('click', '.deleteStream', function() {
            var streamId = $(this).data('id');
            // alert(streamId);
            if (streamId) {
                $('.streamId').val(streamId);
                $('#delete-stream').modal('show');
            } else {
                alert('Stream id not found')
            }
        });
    });

    function deleteStreams() {
        var id = $('.streamId').val();
        $.ajax({
            url: "{{route('Influencer_Delete_Stream')}}",
            method: 'GET',
            data: {
                streamId: id
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
                $('#delete-stream').model('hide');
            },
            error: function(xhr, status, error) {
                alert('Error deleting Stream');
            }
        });
    }

    //delete stream //

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
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyC9NuN_f-wESHh3kihTvpbvdrmKlTQurxw&libraries=places">
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
<style>
    .pac-container {
        z-index: 9999;
    }
</style>