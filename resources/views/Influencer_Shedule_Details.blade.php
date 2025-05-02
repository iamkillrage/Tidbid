@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers Details Posts | TidBid</title>

</head>

<body>
    <header>
        @if(auth()->check())
        @include('User.Navbar.nav')
        @else
        @include('Navbar1.nav1')
        @endif
    </header>
    <main>
        <section class="influ_profile">
            <div class="container">
                <div class="row influ_bg">
                    @foreach($sheduledata as $value)
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 ">
                        <div class="profile_box">
                            <div class="profile_img"><img
                                    src="{{ asset('Influencer/images/profile_img/' . ($value->profile_img )) }}"></div>
                            <div class="profile_text">
                                <h5>{{$value->name}}</h5>
                                <p>{{$value->bio}} </p>
                            </div>

                            <div class="follow_sect">
                                <p class="text_follow"><b
                                        class="text-dark">{{$value->upcomingstreamcount ? count($value->upcomingstreamcount) : 0 }}</b>
                                    Upcoming Streams</p>
                                <p class="text_follow"><b
                                        class="text-dark">{{$value->followerscount ? count($value->followerscount) : 0 }}
                                    </b> Followers</p>
                            </div>
                            @endforeach
                            <div class="follow_btn">
                                @if($checkFollow)
                                <a href="javascript:void(0)" data-userId="{{$sheduledata[0]->id }}"
                                    data-url="{{url('/')}}" class="userFollow">Followed</a>
                                @else
                                <a href="javascript:void(0)" data-userId="{{$sheduledata[0]->id }}"
                                    data-url="{{url('/')}}" class="userFollow">Follow</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="chat_btn"><a href="{{url('user-chat/{id}')}}">Chat <img
                                    src="{{asset('Influencer/images/chat.svg')}}"></a></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="main_influncer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav nav-tabs1 mb-5" style="padding: 13px 0px 13px 0px;">
                            <li>
                                <a href="{{ url('influencer-stream-details', ['id' => request()->segment(2)]) }}"
                                    class="nav-link1 @if(request()->segment(1) == 'influencer-stream-details')active @endif">Streams</a>
                            </li>
                            <li>
                                <a href="{{ url('influencer-post-details', ['id' => request()->segment(2)]) }}"
                                    class="nav-link1 @if(request()->segment(1) == 'influencer-post-details')active @endif">Posts</a>
                            </li>
                            <li>
                                <a href="{{ url('influencer-shedule-details',['id' => request()->segment(2)]) }}"
                                    class="nav-link1 @if(request()->segment(1) == 'influencer-shedule-details') active @endif">
                                    Schedule</a>
                            </li>
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
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times-circle"></i></button>

                <div class="modal-body1 pt-0 pb-5">
                    <h1 class="modal-title1 text-center report-h5">Share</h1>

                    <ul class="social_icon">
                        <li><a href="https://www.facebook.com/"><img
                                    src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
                        <li><a href="https://www.instagram.com/"><img
                                    src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                        <li><a href="https://twitter.com/"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a>
                        </li>
                        <li><a href="https://in.linkedin.com/"><img
                                    src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <!-- End Popup share -->

    <!-- Footer-Section -->
    <!-- @include('Influencer.layout.footer') -->
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
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script>
$(document).on('click', '.open-popup', function() {
    $("#eventModal").modal('hide');
    $("#share").modal("show");


})





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
            url: "{{ route('eventdatas') }}",
            data: function() {

                return {
                    param: "{{request()->segment(2)}}",

                };
            }
        },
        selectable: true,
        selectHelper: true,
        editable: false,

        eventClick: function(calEvent, jsEvent, view) {

            $('.buttondata').html('');
            $('.shareButton').html('');
            var targetTimezone = 'America/New_York';
            var streamDate = calEvent.start;
            var url = "{{ url('/') }}";
            //var timeStamp = streamDate.getTime();
            var id = calEvent.id;
            var eventTitle = calEvent.title;
            var thumbnail_img = '<img src="' + url + '/Influencer/images/thumbnail/' + calEvent
                .thumbnail_img + '">';
            var baseBidPrice = calEvent.baseBidPrice;

            var description = calEvent.description;
            // var timestamp = streamDate.getTime();
            var notifyStatus = calEvent.notifyStatus; // assuming calEvent.start is a Date object
            var currentDate = new Date();
            if (streamDate > currentDate) {
                if (notifyStatus == 1) {
                    $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
                        '" class="watch_btn" onclick="notifyMeee(' + id +
                        ', \'notify\')">Subscribed</a>');
                } else {
                    $('.buttondata').html('<a href="javascript:void(0)" data-id="' + id +
                        '" class="watch_btn" onclick="notifyMeee(' + id + ')">Notify</a>')
                }
            } else {
                $('.buttondata').html('<a href="javascript:void(0)" onclick="watch(' + id +
                    ')" class="watch_btn">Watch Past Stream</a>')
                $('.shareButton').html(
                    '<a href="javascript:void(0);" class="share_btn open-popup"> Share</a>')
            }
            var formatter = new Intl.DateTimeFormat('en-US', {
                timeZone: targetTimezone,
                weekday: 'long', // Full day name (e.g., "Monday")
                day: 'numeric', // Day of the month (1-31)
                month: 'long', // Full month name (e.g., "July")
                year: 'numeric', // Full year (e.g., 2024)
                hour: 'numeric', // Hour (1-12)
                minute: 'numeric', // Minutes (0-59)
                hour12: true // 12-hour format (true) or 24-hour format (false)
            });
            var formattedDate = formatter.format(streamDate);
            console.log(formattedDate);

            $('#eventModal').modal('show');
            //$('.modal-title').text(eventTitle);

            $('.modal-body').html('<p>' + thumbnail_img + '</p>' + eventTitle + '<p></p><p>' +
                description + '</p><p>' + formattedDate + '</p>');

        }

    });



});

function watch(id) {
    window.location.href = "{{ url('my-stream-details') }}?id=" + id;
}

function notifyMeee(id, type = '') {
    $.ajax({
        url: "{{ url('notifyMeee') }}",
        method: 'GET',
        data: {
            stream_id: id,
            events: type
        },
        dataType: 'json',
        success: function(resp) {
            toastr.success(resp.message);

            if (resp.status == 1) {
                $('.buttondata').html(
                    `<a href="#"  data-id="' + id + '" class="watch_btn" onclick="notifyMeee(${id}, 'notify')">Subscribed</a>`
                );

            } else {
                $('.buttondata').html(
                    `<a href="#"  data-id="' + id + '" class="watch_btn" onclick="notifyMeee(${id})">Notify</a>`
                );
            }
            // Reload the page to reflect the changes  

            $('#eventModal').modal('hide');
            window.location.reload(true);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
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