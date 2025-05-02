@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers Details Posts | TidBid</title>
</head>
@php
$stream_id = [];
foreach($Notify as $Notifys) {
$stream_id[] = $Notifys->stream_id;
}
@endphp

<body>
    <!-- Header-Section -->
    @if(session('user_id'))
    @include('Influencer.layout.header1')
    @else
    @include('Influencer.layout.header')
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
                            <div class="profile_img">
                                @if($data->profile_img == '')
                                <img src="{{asset('user.jpg')}}">
                                @else
                                <img src="{{asset('Influencer/images/profile_img/'.$data->profile_img)}}">
                                @endif
                            </div>
                            <div class="profile_text">
                                <h5>{{ $data->userName}}</h5>
                                <p>{{ $data->bio}}</p>
                            </div>

                            <div class="follow_sect">
                                <p class="text_follow"><b class="text-dark">{{ $upcommingtreamdata}} </b>Upcoming
                                    Streams</p>
                                <p class="text_follow"><b class="text-dark">{{$totalfollowers}} </b>Followers</p>
                            </div>

                            <div class="follow_btn">
                                @if($checkFollow)
                                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" data-role="{{ $data->role }}" class="followUser">Followed</a>
                                @else
                                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" data-role="{{ $data->role }}" class="followUser">Follow</a>
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
                            <a href="{{ route('Detail_Stream_Page', ['id' => $data->id]) }}" class="nav-link1 ">Streams</a>
                            <a href="{{route('Detail_Post_Page', ['id' => $data->id])}}" class="nav-link1">Posts</a>
                            <a href="{{route('Detail_Schedule_Page', ['id' => $data->id])}}" class="nav-link1 active">
                                Schedule</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="Schedule_h">
                            @if(isset($datas[0]))
                            <h3>The Next Stream Is on {{ date('m-d-Y', strtotime($datas[0]['streamDate'])) }}</h3>
                            @else
                            <h3>No upcoming streams</h3>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="cal_bg">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal HTML -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{asset('close-popup.svg')}}" alt="">
                    </span>
                </button>
                <div class="modal-body">
                    <div id="eventDetails">
                        <!-- Event details content -->
                    </div>
                </div>
                <div class="blow_btn">
                    <span class="buttondata"></span>
                    <span class="shareButton"></span>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    </div>

    <div class="modal fade1" id="share" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>

                <div class="modal-body1 pt-0 pb-5">
                    <h1 class="modal-title1 text-center report-h5">Share</h1>

                    <ul class="social_icon">
                        <li><a href="https://www.facebook.com/"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
                        <li><a href="https://www.instagram.com/"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                        <li><a href="https://twitter.com/"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a>
                        </li>
                        <li><a href="https://in.linkedin.com/"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Popup share -->

    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->
</body>
<style>
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        height: 65px;
    }

    .fc-resizable {
        height: 60px !important;
    }
</style>

</html>

<link href="{{asset('Influencer/css/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script>
    $(document).on('click', '.open-popup', function() {
        $("#eventModal").modal('hide');
        $("#share").modal("show");
    })

    // $(document).ready(function() {
    //     $('#calendar').fullCalendar({
    //         header: {
    //             left: 'prev,next',
    //             center: 'title',
    //             right: 'agendaWeek'
    //         },
    //         defaultView: 'agendaWeek',
    //         editable: false,
    //         events: {

    //             url: "{{ route('eventdata') }}",
    //             data: function() {
    //                 return {
    //                     param: "{{$data->id}}",
    //                 };
    //             }
    //         },
    //         selectable: false,
    //         selectHelper: false,
    //         editable: false,
    //         eventClick: function(calEvent, jsEvent, view) {
    //             console.log(view);
    //             $('.buttondata').html('');
    //             $('.shareButton').html('');
    //             var targetTimezone = 'America/New_York';
    //             var streamDate = calEvent.start;
    //             var url = "{{ url('/') }}";

    //             var id = calEvent.id;
    //             console.log(calEvent);
    //             var eventTitle = calEvent.title;
    //             var thumbnail_img = '<img src="' + url + '/Influencer/images/thumbnail/' + calEvent
    //                 .thumbnail_img + '">';
    //             var baseBidPrice = calEvent.baseBidPrice;
    //             var description = calEvent.description;

    //             var notifyStatus = calEvent.notifyStatus; // assuming calEvent.start is a Date object
    //             var currentDate = new Date();
    //             if (streamDate > currentDate) {
    //                 if (notifyStatus == 1) {
    //                     $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
    //                         '" class="watch_btn" onclick="notifyme(' + id +
    //                         ', \'notify\')">Subscribed</a>');
    //                 } else {
    //                     $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
    //                         '" class="watch_btn" onclick="notifyme(' + id + ')">Notify</a>')
    //                 }
    //             } else {
    //                 $('.buttondata').html('<a href="javascript:void(0)" onclick="watch(' + id +
    //                     ')" class="watch_btn">Watch Past Stream</a>')
    //                 $('.shareButton').html(
    //                     '<a href="javascript:void(0);" class="share_btn open-popup"> Share</a>')
    //             }
    //             var formatter = new Intl.DateTimeFormat('en-US', {
    //                 timeZone: targetTimezone,
    //                 weekday: 'long', // Full day name (e.g., "Monday")
    //                 day: 'numeric', // Day of the month (1-31)
    //                 month: 'long', // Full month name (e.g., "July")
    //                 year: 'numeric', // Full year (e.g., 2024)
    //                 hour: 'numeric', // Hour (1-12)
    //                 minute: 'numeric', // Minutes (0-59)
    //                 hour12: true // 12-hour format (true) or 24-hour format (false)
    //             });
    //             var formattedDate = formatter.format(streamDate);

    //             $('#eventModal').modal('show');

    //             $('.modal-body').html('<div class="eventmodal-image">' + thumbnail_img + '</div>' + '<h3>' + eventTitle + '</h3>' + '<p>' +
    //                 description + '</p>' + '<span>' + formattedDate + '</span>');
    //         }
    //     });
    // });
    
   $(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'agendaWeek'
        },
        defaultView: 'agendaWeek',
        editable: false,
        events: {
            url: "{{ route('eventdata') }}",
            data: function() {
                return {
                    param: "{{$data->id}}",
                };
            }
        },
        selectable: false,
        selectHelper: false,
        editable: false,

        // Custom event rendering with a single wrapper div
        eventRender: function(event, element) {
            var url = "{{ url('/') }}";

            var eventTime = moment(event.start).format('hh:mm A'); // Time Format
            var thumbnail_img = '<div class="fc-image">' +
                '<img src="' + url + '/Influencer/images/thumbnail/' + event.thumbnail_img + '" style="width: 80px; height: 76px; border-radius: 5px;">' +
                '</div>';

            var eventDetails = '<div class="fc-event-content">' + 
                '<h3 class="fc-title" style="font-weight: bold; font-size: 14px;">' + event.title + '</h3>' +
                '<p class="fc-time" style="font-size: 12px; color: #666;">' + eventTime + '</p>' +
                '<span class="fc-description" style="font-size: 12px; color: #666;">' + event.description + '</span>' +
            '</div>';

            // Maintain default event background styling
            element.css("background-color", "#fff"); // White background
            element.css("border", "1px solid #ddd"); // Light border

            element.html(thumbnail_img + eventDetails);
        },

        eventClick: function(calEvent, jsEvent, view) {
            console.log(view);
            $('.buttondata').html('');
            $('.shareButton').html('');
            var targetTimezone = 'America/New_York';
            var streamDate = calEvent.start;
            var url = "{{ url('/') }}";
            var id = calEvent.id;
            console.log(calEvent);
            var eventTitle = calEvent.title;
            var thumbnail_img = '<img src="' + url + '/Influencer/images/thumbnail/' + calEvent.thumbnail_img + '">';
            var baseBidPrice = calEvent.baseBidPrice;
            var description = calEvent.description;
            var notifyStatus = calEvent.notifyStatus;
            var currentDate = new Date();
            
            if (streamDate > currentDate) {
                if (notifyStatus == 1) {
                    $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
                        '" class="watch_btn" onclick="notifyme(' + id +
                        ', \'notify\')">Subscribed</a>');
                } else {
                    $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
                        '" class="watch_btn" onclick="notifyme(' + id + ')">Notify</a>')
                }
            } else {
                $('.buttondata').html('<a href="javascript:void(0)" onclick="watch(' + id +
                    ')" class="watch_btn">Watch Past Stream</a>')
                $('.shareButton').html(
                    '<a href="javascript:void(0);" class="share_btn open-popup"> Share</a>')
            }
            
            var formatter = new Intl.DateTimeFormat('en-US', {
                timeZone: targetTimezone,
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            });
            var formattedDate = formatter.format(streamDate);

            $('#eventModal').modal('show');

            $('.modal-body').html('<div class="eventmodal-image">' + thumbnail_img + '</div>' + '<h3>' + eventTitle + '</h3>' + '<p>' +
                description + '</p>' + '<span>' + formattedDate + '</span>');
        }
    });
});


    function watch(id) {
        window.location.href = "{{ url('influencer-my-stream-details') }}?stream_id=" + id;
    }

    function notifyme(id, type = '') {
        $.ajax({
            url: "{{ url('notifyMe') }}",
            method: 'GET',
            data: {
                stream_id: id,
                events: type
            },
            dataType: 'json',
            success: function(resp) {
                toastr.success(resp.message);
                if (resp.status == 1) {
                    $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
                        '" class="watch_btn" onclick="notifyme(' + id + ', \'notify\')">Subscribed</a>');
                } else {
                    $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
                        '" class="watch_btn" onclick="notifyme(' + id + ')">Notify</a>')
                }

                location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); // Log any errors for debugging purposes
            }
        });
    }
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
    $(document).ready(function() {
        $(document).on("click", ".close", function() {
            $('#eventModal').modal('hide');
        });
    });
</script>
@endsection