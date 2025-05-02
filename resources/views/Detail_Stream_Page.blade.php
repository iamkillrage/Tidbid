@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers Details Streams | TidBid</title>
</head>

<body>
    @php
    $stream_id = [];
    foreach($Notify as $Notifys) {
    $stream_id[] = $Notifys->stream_id;
    }
    @endphp
    <!-- Header-Section -->
    {{-- @include('Influencer.layout.header') --}}
    @if(session('user_id') || auth()->check())
    @if(session('user_id'))
    @include('Influencer.layout.header1')
    @elseif(auth()->check())
    @include('User.Navbar.nav')
    @endif
    @else
    @include('Influencer.layout.header')
    {{-- @include('Navbar1.nav1') --}}
    @endif
    <!-- End-Header-Section-->

    <!-- Main-Section -->
    <main>

        <section class="influ_profile">
            <div class="container">
                <div class="row influ_bg">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 ">
                        <div class="profile_box">
                            @if($data->profile_img == '')
                            <div class="profile_img"><img src="{{asset('user-profile-icon.webp')}}" alt=""></div>
                            @else
                            <div class="profile_img"><img src="{{asset('Influencer/images/profile_img/'.$data->profile_img)}}"></div>
                            @endif
                            <div class="profile_text">
                                <h5>{{$data->userName}}</h5>
                                <p>{{$data->bio}} </p>
                            </div>

                            <div class="follow_sect">
                                <p class="text_follow"><b class="text-dark">{{ count($upCommingStreem) }} </b>Upcoming
                                    Streams</p>
                                <p class="text_follow"><b class="text-dark">{{ $totalfollowers}} </b>Followers</p>
                            </div>

                            <div class="follow_btn">
                                @if($checkFollow)
                                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" data-role="{{ $data->role }}" class="followUser">Followed</a>
                                @else
                                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" data-role="{{ $data->role }}" class="followUser">Follow</a>
                                @endif

                                @if(empty($suggest_influencer))
                                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" class="suggest-user">Suggest Influencer</a>
                                @else
                                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" class="suggest-user">Suggested Influencer</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-3">
                        <div class="chat_btn"><a href="{{url('influencer-chat/{id}')}}">Chat <img src="{{asset('Influencer/images/chat.svg')}}"></a></div>
                    </div> -->
                </div>
            </div>
        </section>

        <div class="main_influncer">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="nav nav-tabs1 mb-5 ">
                            <a href="{{ route('Detail_Stream_Page', ['id' => $data->id]) }}" class="nav-link1 active">Streams</a>
                            <a href="{{route('Detail_Post_Page', ['id' => $data->id])}}" class="nav-link1">Posts</a>
                            <a href="{{route('Detail_Schedule_Page', ['id' => $data->id])}}" class="nav-link1">
                                Schedule</a>
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
                    @forelse($upCommingStreem as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1 ">
                            <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
                            <div class="influtext">
                                <h3><a href="#">{{$value->streamTitle}}</a></h3>
                                {{-- <p>{{$value->what_to_expect}}</p> --}}
                                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 9)) }}</p>

                                <div class="shedul">
                                    <p class="gray_text"><img class="callender" src="images/callender.png" alt=""><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                                    <p class="gray_text"><i class="far fa-clock"></i>
                                        {{date('h:i A', strtotime($value->streamTime))}}
                                    </p>
                                </div>

                                <div class="stream_btn" id="changeButton_{{$value->id}}">
                                    @if(in_array($value->id, $stream_id))
                                    <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}','notify')" class="notify_btn notifyMe">Subscribed</a>
                                    @else
                                    <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}','Subscribe')" class="notify_btn notifyMe">Notify Me</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <h5>No upcomming streem found</h5>
                    @endforelse
                    <!--itme-->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading mt-4">
                            <h2>Past Streams</h2>
                        </div>
                    </div>
                    <!--itme-->
                    @if ($PastStreem->isEmpty())

                    <h5>No past stream data found !</h5>

                    @else
                    @foreach($PastStreem as $value1)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1 ">
                            <div class="top_tag">
                                <a href="#" class="strem_tag">&nbsp;</a>
                                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
                            </div>
                            <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'.$value1->thumbnail_img)}}"></div>
                            <div class="influtext">
                                <h3><a href="">{{$value1->streamTitle}}</a></h3>
                                <p>{{ implode(' ', array_slice(str_word_count($value1->what_to_expect, 1), 0, 9)) }}</p>
                                <div class="shedul">
                                    <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt=""><?php echo date('m-d-Y', strtotime($value1->streamDate)); ?></p>
                                    <p class="gray_text"><i class="far fa-clock">&nbsp;</i>{{date('h:i A', strtotime($value1->streamTime))}}
                                    </p>
                                </div>
                                <div class="stream_btn">
                                    <a href="{{url('/influencer-my-stream-details?stream_id='.$value1->id)}}" class="notify_btn">View detail</a>
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

        <!-- Influencers -->
        <div class="upcoming-events-wrap pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="heading-wrap">
                            <h1 class="small_text">{{$data->userName}} suggests these influencers</h1>
                        </div>

                        <div id="recent-reviews-slider_1" class="owl-carousel">
                            <!-- ITEM -->
                            @forelse($get_suggest_influencer as $get_suggest_influencera)
                            <div class="upcoming-events-in events-in">
                                <div class="influ_img">
                                    @if($get_suggest_influencera->user->profile_img == '')
                                    <img src="{{ asset('user-profile-icon.webp') }}" alt="">
                                    @else
                                    <img src="{{ asset('Influencer/images/profile_img/' . $get_suggest_influencera->user->profile_img) }}">
                                    @endif
                                </div>
                                <div class="inner_text_1">
                                    <a href="{{url('detail-stream-page?id='.$get_suggest_influencera->suggest_influencer_id)}}">{{ $get_suggest_influencera->user->name }}</a>
                                    <p>Live</p>
                                </div>
                            </div>
                            <h6>@empty No Suggests Influencer Found</h6>

                            @endforelse
                        </div>
                        <!-- /recent-reviews-slider_1 -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Influencers -->

        <!-- Influencers -->
    </main>
    <!-- Main-Section -->
    <!-- Popup share -->
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0 pb-5 ">
                    <h1 class="modal-title text-center report-h5">Share </h1>

                    <ul class="social_icon">
                        <li><a href="#"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
                        <li><a href="#"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                        <li><a href="#"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
                        <li><a href="#"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <!-- Popup share -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).on('click', '.suggest-user', function() {
            var influencerId = $(this).attr('data-userId');
            var url = $(this).attr('data-url');
            if (influencerId) {
                $.ajax({
                    url: url + '/Suggest_Influencer',
                    method: 'GET',
                    data: {
                        influencerId: influencerId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.login_status == 'false') {
                            toastr.error('Please login first to Suggest this Influencer');
                            return false;
                        }
                        if (data.status == 1) {
                            $('.suggest-user').text('Suggested Influencer');
                            toastr.success(data.message);
                        } else if (data.status == 2) {
                            $('.suggest-user').text('Suggeste Influencer');
                            toastr.success(data.message);
                        } else {
                            $('.suggest-user').text('Suggeste Influencer');
                            toastr.error(data.message);
                        }
                    }
                })
            } else {
                toastr.error('All input field are required..');
            }

        })
    </script>

    <script>
        $(document).on('click', '.followUser', function() {
            var influencerId = $(this).attr('data-userId');
            var url = $(this).attr('data-url');
            var role = $(this).attr('data-role');
            if (influencerId != '' && url != '' && role != '') {
                $.ajax({
                    url: url + '/follower-user',
                    method: "GET",
                    data: {
                        influencerId: influencerId,
                        role: role
                    },
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.login_status == 'false') {
                            toastr.error('Please login first to follow this Influencer');
                            return false;
                        }

                        if (resp.status == 1) {
                            $('.followUser').text('Followed');
                            toastr.success(resp.message);
                            window.location.reload(true);
                        }
                        if (resp.status == 2) {
                            $('.followUser').text('Follow');
                            toastr.success(resp.message);
                            window.location.reload(true);
                        }
                        if (resp.status == 0) {
                            toastr.error('All input field are required..');
                        }
                    }
                })
            } else {
                toastr.error('All input field are required..');
            }
        });
    </script>
    <script>
        function notifyMe(id, events) {
            event.preventDefault(); // Commenting out this line since there's no event parameter in this function

            $.ajax({
                url: "{{ url('notifyMe') }}",
                method: 'GET',
                data: {
                    stream_id: id,
                    events: events
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 1) {
                        $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMe(' + resp.id + ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
                        toastr.success(resp.message);
                    } else if (resp.status == 2) {
                        $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMe(' + resp.id + ', \'Subscribe\')" class="notify_btn notifyMe" >Notify Me</a>');
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                    // location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown); // Log any errors for debugging purposes
                }
            });
        }
    </script>
    @endsection