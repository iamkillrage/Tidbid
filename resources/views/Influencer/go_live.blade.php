@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Live Stream | TidBid</title>
    <link rel="stylesheet" href="https://unpkg.com/emoji-mart@5.4.0/dist/browser/emoji-mart.css">

    <script src="{{ asset('agorachat/dist/bundle.js') }}"></script>

    <style>
        .live-video-inner {
            width: 100%;
            height: auto;
            position: relative;
        }

        .live-video-inner video {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .live-video-inner .live-video-inner-btns {
            width: 100%;
            height: auto;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
            z-index: 9999;
        }

        .live-video-inner .live-video-inner-btns button {
            width: 45px;
            height: 45px;
            background: none;
            border-radius: 50%;
            border: none;
            outline: none;
        }

        .live-video-inner #streamVideo {
            width: 100%;
            border-radius: 20px;
            border: 1px solid #D31E90;
        }

        .live-video-inner .live-video-inner-btns button img {
            width: 100%;
            height: 100%;
        }

        .live-video-inner #streamVideo div {
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <!-- Header-Section -->
    <header>
        @include('Influencer.layout.header1')
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>
        <section class="details_sect mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <div class="live-video-inner">
                            <div class="live-video-inner-btns">
                                <button type="button" class="d-none" id="start-stream" data-channel="{{ $data['channel'] }}" data-token="{{ $data['token'] }}" data-uid="{{ $data['uid'] }}"></button>
                                <button type="button" id="stop-stream"><img src="{{ asset('agorachat/assets/live-video/end-call.svg')}}" alt=""></button>
                                <button type="button"><img src="{{ asset('agorachat/assets/live-video/mic-on.svg')}}" alt=""></button>
                            </div>
                            <div id="streamVideo" class="details_video" style="height: 420px;">
                                <!-- Streaming Video -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="details_right one_line" id="giftContainer">
                        </div>

                        <div class="comment_box">
                        </div>

                        <div class="detail_form">
                            <div class="searc_form_1">
                                <form id="comment-form-Streamlive">
                                    <input type="hidden" placeholder="Comment" id="stream_id" name="stream_id" value="{{request()->segment(2)}}">
                                    <input type="text" placeholder="Comment" id="comment-content" name="event_comment">
                                    <button type="button" class="comment_now"><img src="{{asset('Influencer/images/send2-icon.png')}}" alt=""></button>
                                </form>
                            </div>

                            <ul class="sent_icon">
                                <li><a href="javascript:void(0)" onclick="setEmoji()"><i class="far fa-smile"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" onclick="heart()"><img src="{{asset('Influencer/images/heart.png')}}" alt=""></a></li>
                                <li class="send_button"><a href="javascript:void(0)" onclick="slap()"><img src="{{asset('Influencer/images/hi.png')}}" class="pr-1">Wave</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Main-Section -->
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/emoji-mart@5.4.0/dist/browser/emoji-mart.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('#start-stream').click();
        }, 2000);
    })

    function setEmoji() {
        $('#comment-content').val($('#comment-content').val() + '😊');
    }

    function heart() {
        $('#comment-content').val($('#comment-content').val() + '❤️');
    }

    function slap() {
        $('#comment-content').val($('#comment-content').val() + '👏');
    }
</script>

<script>
    $(document).on('click', '.comment_now', function() {
        var commentcontent = $('#comment-content').val()
        var stream_id = $('#stream_id').val();

        if (commentcontent) {
            $.ajax({
                url: "{{url('infusendLiveComment')}}",
                method: "GET",
                data: {
                    commentcontent: commentcontent,
                    stream_id: stream_id
                },
                dataType: "json",
                success: function(resp) {
                    $('#comment-content').val('');
                    getComment();
                }
            })
        } else {
            toastr.error('Comment field are required...');
        }
    })

    setInterval(getComment, 5000);

    function getComment() {
        var stream_id = "{{request()->segment(2)}}";
        if (stream_id != '') {
            $.ajax({
                url: "{{url('InfuLiveStreamComment')}}",
                method: "GET",
                data: {
                    stream_id: stream_id,

                },
                dataType: "json",
                success: function(res) {
                    if (res.html) {
                        $('.comment_box').html(res.html);
                    } else {
                        $('.comment_box').html('<p>No comment found for this event.</p>');
                    }

                    $('.bidPrice').text(res.lastBid.bid_price + ' (' + res.lastBid.get_user.name + ')');
                }
            })
        } else {

        }
    }

    getComment();
</script>

<script>
    // straming comment
    function getEvent_gift() {
        var eventId = "{{request()->segment(2)}}";
        if (eventId != '') {
            $.ajax({
                url: "{{url('get_gift_infu')}}",
                method: "GET",
                data: {
                    eventId: eventId,
                },
                dataType: "json",
                success: function(res) {
                    if (res.html) {
                        $('#giftContainer').html(res.html); // Update the HTML content of the container

                    } else {
                        $('#giftContainer').html('<p>No gifts found for this event.</p>');
                    }
                }
            })
        } else {

        }
    }

    getEvent_gift();
    //Send gift to 
</script>

</html>

@endsection