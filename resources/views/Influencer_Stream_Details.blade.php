@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers Details Streams | TidBid</title>
</head>
@php
$stream_id = [];
foreach($Notify as $Notifys) {
$stream_id[] = $Notifys->stream_id;
}
@endphp

<body>
    <!-- Header-Section -->
    <header>
        @if(auth()->check())
        @include('User.Navbar.nav')
        @else
        @include('Navbar1.nav1')
        @endif
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>
        <section class="influ_profile">
            <div class="container">
                <div class="row influ_bg">
                    @foreach($influencerdata as $value)
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 ">
                        <div class="profile_box">
                            <div class="profile_img"> <img src="{{ asset('Influencer/images/profile_img/' . ($value->profile_img )) }}"></div>
                            <div class="profile_text">
                                <h5>{{$value->name}}</h5>

                                <p>{{$value->bio}} </p>
                            </div>

                            <div class="follow_sect">
                                <p class="text_follow"><b class="text-dark">{{$value->upcomingstreamcount ? count($value->upcomingstreamcount) : 0 }}
                                    </b> Upcoming Streams</p>
                                <p class="text_follow"><b class="text-dark">{{$value->followerscount ? count($value->followerscount) : 0 }}</b>
                                    Followers</p>
                            </div>
                            @endforeach
                            <div class="follow_btn">
                                @if($checkFollow)
                                <a href="javascript:void(0)" data-userId="{{$influencerdata[0]->id }}" data-url="{{url('/')}}" class="userFollow">Followed</a>
                                @else
                                <a href="javascript:void(0)" data-userId="{{$influencerdata[0]->id }}" data-url="{{url('/')}}" class="userFollow">Follow</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-3">
                        <div class="chat_btn"><a href="{{url('user-chat/'.$influencerdata[0]->id)}}">Chat <img src="{{asset('Influencer/images/chat.svg')}}"></a></div>
                    </div> -->
                </div>
            </div>
        </section>

        <div class="main_influncer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav nav-tabs1 mb-5" style="padding: 13px 0px 13px 0px;">
                            <li>
                                <a href="{{ url('influencer-stream-details', ['id' => request()->segment(2)]) }}" class="nav-link1   @if(request()->segment(1) == 'influencer-stream-details')active @endif">Streams</a>
                            </li>

                            <li>
                                <a href="{{ url('influencer-post-details', ['id' => request()->segment(2)]) }}" class="nav-link1   @if(request()->segment(1) == 'influencer-post-details')active @endif">Posts</a>
                            </li>

                            <li>
                                <a href="{{ url('influencer-shedule-details',['id' => request()->segment(2)]) }}" class="nav-link1  @if(request()->segment(1) == 'influencer-shedule-details') active @endif">
                                    Schedule</a>
                            </li>
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

                    <!--itme-->
                    @if ($streamdata->isEmpty())
                    <div class="alert alert-secondary">
                        <strong>No Data Found !</strong>
                    </div>
                    @else
                    @foreach($streamdata as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1">
                            <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'.$value->thumbnail_img)}}"></div>
                            <div class="influtext">
                                <h3><a href="#">{{$value->streamTitle}}</a></h3>
                                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 20)) }}...
                                </p>
                                <div class="shedul">
                                    <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt=""><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                                    </p>
                                    <p class="gray_text"><i class="far fa-clock"></i> {{$value->streamTime}}</p>
                                </div>
                                <p class="pink_text1"><span>Base Price :</span> ${{$value->baseBidPrice}}</p>

                            </div>
                            <div class="stream_btn" id="changeButton_{{$value->id}}" style="padding-block: 19px;margin-left: 13px;margin-top: -13px;">
                                @if(in_array($value->id, $stream_id))
                                <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMeee('{{$value->id}}','notify')" class="notify_btn notifyMe">Subscribed</a>
                                @else
                                <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMeee('{{$value->id}}','Subscribe')" class="notify_btn notifyMe">Notify me</a>
                                @endif
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
                    <div class="alert alert-secondary">
                        <strong>No Data Found !</strong>
                    </div>
                    @else
                    @foreach($paststreamdata as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1 ">
                            <div class="top_tag">
                                <a href="#" class="strem_tag">&nbsp;</a>
                                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
                            </div>
                            <div class="influimg1"><img src="{{asset('/Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
                            <div class="influtext">
                                <h3><a href="influencers-my-streams-details.html">{{$value->streamTitle}}</a></h3>

                                <p> {{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 20)) }}....
                                </p>
                                <div class="shedul">
                                    <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt=""><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                                    </p>
                                    <p class="gray_text"><i class="far fa-clock">&nbsp;</i>{{$value->streamTime}} </p>
                                </div>
                                <div class="stream_btn">
                                    <a href="{{route('MyStreamDetails',['id' => $value->id])}}" class="notify_btn">View
                                        detail</a>
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
                            <h1 class="small_text"> {{$data->userName}} suggests these influencers</h1>
                        </div>


                    </div>
                    <div class="col-lg-12">
                        <div id="recent-reviews-slider_1" class="owl-carousel owl-loaded owl-drag">
                            <!-- ITEM -->

                            <!-- ITEM -->
                            <!-- ITEM -->

                            <!-- ITEM -->
                            <!-- ITEM -->

                            <!-- ITEM -->
                            <!-- ITEM -->

                            <!-- ITEM -->
                            <!-- ITEM -->

                            <!-- ITEM -->
                            <!-- ITEM -->

                            <!-- ITEM -->
                            <!-- ITEM -->

                            <!-- ITEM -->
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1176px;">

                                    @forelse($get_suggest_influencer as $get_suggest_influencera)
                                    <div class="owl-item active" style="width: 148px; margin-right: 20px;">
                                        <div class="upcoming-events-in events-in">
                                            <div class="influ_img">
                                                @if($get_suggest_influencera->user->profile_img == '')
                                                <img src="{{ asset('user-profile-icon.webp') }}" alt="">
                                                @else
                                                <img src="{{ asset('Influencer/images/profile_img/' . $get_suggest_influencera->user->profile_img) }}">
                                                @endif
                                            </div>
                                            <div class="inner_text_1">
                                                <a href="{{ url('detail-stream-page?id=' . $get_suggest_influencera->suggest_influencer_id) }}">{{ $get_suggest_influencera->user->name }}</a>
                                                <p>Live</p>
                                            </div>

                                        </div>
                                    </div>
                                    @empty
                                    <h6>No Suggested Influencers Found</h6>
                                    @endforelse


                                </div>
                            </div>


                            <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i class="far fa-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="far fa-chevron-right"></i></button>
                            </div>
                            <div class="owl-dots disabled"><button role="button" class="owl-dot active"><span></span></button></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
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
                        <li><a href="https://www.facebook.com/" target="_blank"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
                        <li><a href="https://www.instagram.com/accounts/login/" target="_blank"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                        <li><a href="https://twitter.com/?lang=en" target="_blank"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
                        <li><a href="https://in.linkedin.com/" target="_blank"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup share -->


</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).on('click', '.userFollow', function() {
        var influencerId = $(this).attr('data-userId');
        var url = $(this).attr('data-url');
        var role = 'user';
        if (influencerId != '' && url != '' && role != '') {
            $.ajax({
                url: url + '/follower-users',
                method: "GET",
                data: {
                    influencerId: influencerId,
                    role: role
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 'false') {
                        toastr.error('Please login first to follow this Influencer');
                        return false;
                    }

                    if (resp.status == 1) {
                        $('.userFollow').text('Followed');
                        toastr.success(resp.message);
                        window.location.reload(true);
                    }
                    if (resp.status == 2) {
                        $('.userFollow').text('Follow');
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


        // Now you can use influencerId variable to perform further actions
    });
</script>

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


<!-- <script>
    $(document).ready(function() {
        $(".notifyMe").click(function() {
            var button = $(this);
            var streamId = button.data("id");

            if (!localStorage.getItem("subscribed_" + streamId)) {
                localStorage.setItem("subscribed_" + streamId, "true");
                button.text("Subscribed");
                showNotification("You are now subscribed to notifications for Stream ");
            } else {
                localStorage.removeItem("subscribed_" + streamId);
                button.text("Notify Me");
                showNotification("You have Notify from notifications for Stream ");
            }

        });

        $(".notifyMe").each(function() {
            var button = $(this);
            var streamId = button.data("id");

            if (localStorage.getItem("subscribed_" + streamId)) {
                button.text("Subscribed");
            }
        });

        function showNotification(message) {
            toastr.success(message);
        }

        function showNotification(message) {
            toastr.success(message);
        }
    });
    </script> -->
<script>
    function notifyMeee(id, events) {
        event.preventDefault(); // Commenting out this line since there's no event parameter in this function

        $.ajax({
            url: "{{ url('notifyMeee') }}",
            method: 'GET',
            data: {
                stream_id: id,
                events: events
            },
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 1) {
                    $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMeee(' + resp
                        .id + ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
                    toastr.success(resp.message);
                } else if (resp.status == 2) {
                    $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMeee(' + resp
                        .id + ', \'Subscribe\')" class="notify_btn notifyMe" >Notify me</a>');
                    toastr.success(resp.message);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); // Log any errors for debugging purposes
            }
        });
    }
</script>



@endsection