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
        .emoji {
            cursor: pointer;
            font-size: 20px;
            margin: 5px;
            display: inline-block;
            transition: transform 0.1s ease-in-out;
        }
        .emoji:hover {
            transform: scale(1.3);
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
                    <div class="col-lg-6 col-md-12">
                        <div class="live-video-inner">
                            <div class="live-video-inner-btns">
                                <button type="button" class="d-none" id="start-stream" data-channel="{{ $data['channel'] }}" data-token="{{ $data['token'] }}" data-uid=""></button>
                                <button type="button" id="stop-stream"><img src="{{ asset('agorachat/assets/live-video/end-call.svg')}}" alt=""></button>
                            </div>
                            <div id="streamVideo" class="details_video" style="height: 420px;">
                                <!-- Streaming Video -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="details_right one_line" id="giftContainer">
                            <!-- Gift Box -->
                        </div>

                        <div class="comment_box">
                            <!-- Comment Box -->
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
                                <li>
                                    <!--<a href="javascript:void(0)" onclick="setEmoji()"><i class="far fa-smile"></i></a>-->
                                    <a href="javascript:void(0)" onclick="toggleEmojiPicker()"><i class="far fa-smile"></i></a>
                                    <!-- Emoji List -->
                                    <div id="emojiList" style="display: none; position: absolute; background: #fff; border: 1px solid #ccc; padding: 5px; max-width: 300px; z-index: 999;">
                                        <span class="emoji">😀</span>
                                        <span class="emoji">😃</span>
                                        <span class="emoji">😄</span>
                                        <span class="emoji">😁</span>
                                        <span class="emoji">😆</span>
                                        <span class="emoji">😅</span>
                                        <span class="emoji">😂</span>
                                        <span class="emoji">🤣</span>
                                        <span class="emoji">😊</span>
                                        <span class="emoji">😇</span>
                                        <span class="emoji">🙂</span>
                                        <span class="emoji">🙃</span>
                                        <span class="emoji">😉</span>
                                        <span class="emoji">😍</span>
                                        <span class="emoji">😘</span>
                                        <span class="emoji">😗</span>
                                        <span class="emoji">😙</span>
                                        <span class="emoji">😚</span>
                                        <span class="emoji">😋</span>
                                        <span class="emoji">😛</span>
                                        <span class="emoji">😝</span>
                                        <span class="emoji">😜</span>
                                        <span class="emoji">🤪</span>
                                        <span class="emoji">🤨</span>
                                        <span class="emoji">🧐</span>
                                        <span class="emoji">🤓</span>
                                        <span class="emoji">😎</span>
                                        <span class="emoji">🥳</span>
                                        <span class="emoji">🥺</span>
                                        <span class="emoji">😢</span>
                                        <span class="emoji">😭</span>
                                        <span class="emoji">😡</span>
                                        <span class="emoji">😤</span>
                                        <span class="emoji">🤬</span>
                                        <span class="emoji">😱</span>
                                        <span class="emoji">😰</span>
                                        <span class="emoji">😨</span>
                                        <span class="emoji">😳</span>

                                    </div>
                                </li>
                                
                                <li><a href="javascript:void(0)" onclick="heart()"><img src="{{asset('Influencer/images/heart.png')}}" alt=""></a></li>
                                <li class="send_button"><a href="javascript:void(0)" onclick="slap()"><img src="{{asset('Influencer/images/hi.png')}}" class="pr-1">Wave</a></li>
                                <li class="send_button"><a href="javascript:void(0)" onclick="endBid('{{request()->segment(2)}}')">End Bid</a></li>
                            </ul>
                        </div>

                        <p class="bottom-text-line">
                            <span style="color: #000">15</span> Mins {{ $streamdataDetail->what_to_expect == 'Private_chat' ? 'Private Chat' : 'Private Video' }} | Base Price:
                            <span class="baseprice" style="color: green">${{ isset($streamdataDetail->baseBidPrice) ? $streamdataDetail->baseBidPrice : 'N/A' }}</span> |
                            Current Bid: <span>$</span><span class="bidPrice"></span>
                        </p>

                        @if($streamdataDetail->bid_end_status == 1 && $streamdataDetail->what_to_expect == 'Private_Video_call')
                        <p>
                            <a class="send_button" href="{{ url('video-chat/' . (isset($getLastBid->user_id) ? $getLastBid->user_id : 'NA')) }}">
                                Video call
                            </a>
                        </p>
                        @endif

                        @if($streamdataDetail->bid_end_status == 1 && $streamdataDetail->what_to_expect == 'Private_chat')
                        <p>
                            <a class="send_button" href="{{ isset($getLastBid->user_id) ? url('influencer-chat/' . $getLastBid->user_id) : '#' }}">
                                Private chat
                            </a>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <div class="main_influncer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-9 col-sm-8 col-7">
                        <div class="live_h mt-4 pb-4">
                            <h3>Upcoming Live Streams</h3>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-4 col-5">
                        <div class="live_h live2 mt-4 pb-4">
                            <a href="#">View All</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($streamdata as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1 ">
                            <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
                            <div class="influtext">
                                <h3><a href="#">{{$value->streamTitle}}</a></h3>
                                <p>{{$value->what_to_expect}}</p>
                                <div class="shedul">
                                    <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt=""><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                                    <p class="gray_text"><i class="far fa-clock"></i> {{$value->streamTime}}</p>
                                </div>
                                <p class="pink_text1"><span>Base Price :</span>${{$value->baseBidPrice}}</p>
                                <div class="stream_btn">
                                    <a href="#" class="notify_btn spac_btn edit-link" data-stream="{{json_encode($value)}}" data-bs-toggle="modal" data-bs-target="#edit-stream">Edit</a>
                                    <a href="#" class="join_btn spac_btn deleteStream" data-bs-toggle="modal" data-bs-target="#delete-stream" data-id="{{$value->id}}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- Main-Section -->
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/emoji-mart@5.4.0/dist/browser/emoji-mart.js"></script>
@if($streamdataDetail->bid_end_status == 2)
<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('#start-stream').click();
        }, 2000);

        let sid = '';
        $('#start-stream').click(() => {
            setTimeout(() => {
                $.ajax({
                    method: "POST",
                    data: {
                        id: "{{ $streamdataDetail->id }}",
                        resourceId: "{{ $data['resourceId'] }}",
                        channel: "{{ $data['channel'] }}",
                        token: "{{ $data['token'] }}",
                        uid: "{{ $data['uid'] }}",
                    },
                    url: "{{ url('api/start-recording') }}",
                    dataType: "JSON",
                    success: function(response) {
                        sid = response.sid;
                    },
                    error: function() {
                        console.log('Recording not started');
                    }
                })
            }, 2000)
        })

        $('#stop-stream').click(() => {
            $.ajax({
                method: "POST",
                data: {
                    resourceId: "{{ $data['resourceId'] }}",
                    channel: "{{ $data['channel'] }}",
                    sid,
                    uid: "{{ $data['uid'] }}",
                },
                url: "{{ url('api/stop-recording') }}",
                dataType: "JSON",
                success: function(response) {
                    location.reload();
                },
                error: function() {
                    console.log('Recording not stoped');
                }
            })
        })
    })
</script>
@endif

<script>
    function endBid(id) {
        if (id) {
            $.ajax({
                url: "{{url('endBid')}}",
                method: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(resp) {
                    if (resp.success) {
                        $('#stop-stream').click();
                        toastr.success(resp.message);
                    } else {
                        toastr.error("Failed to end the bid.");
                    }
                },
                error: function() {
                    toastr.error("An error occurred while ending the bid.");
                }
            });
        } else {
            toastr.warning("Something went wrong.");
        }
    }
    
    function toggleEmojiPicker() {
        $('#emojiList').toggle();
    }
    
    $(document).on('click', '.emoji', function () {
        let emoji = $(this).text();
        var stream_id = $('#stream_id').val();
        
        $.ajax({
            url: "{{url('infusendLiveComment')}}",
            method: "GET",
            data: {
                commentcontent: emoji,
                stream_id: stream_id
            },
            dataType: "json",
            success: function(resp) {
                getComment();
            }
        })
        
        //$('.messagebox').val($('.messagebox').val() + emoji);
        $('#emojiList').hide(); // Optionally hide picker after selecting
    });

    function setEmoji() {
        var stream_id = $('#stream_id').val();

        $.ajax({
            url: "{{url('infusendLiveComment')}}",
            method: "GET",
            data: {
                commentcontent: '😊',
                stream_id: stream_id
            },
            dataType: "json",
            success: function(resp) {
                getComment();
            }
        })
    }

    function heart() {
        var stream_id = $('#stream_id').val();

        $.ajax({
            url: "{{url('infusendLiveComment')}}",
            method: "GET",
            data: {
                commentcontent: '❤️',
                stream_id: stream_id
            },
            dataType: "json",
            success: function(resp) {
                getComment();
            }
        })
    }

    function slap() {
        var stream_id = $('#stream_id').val();

        $.ajax({
            url: "{{url('infusendLiveComment')}}",
            method: "GET",
            data: {
                commentcontent: '👏',
                stream_id: stream_id
            },
            dataType: "json",
            success: function(resp) {
                getComment();
            }
        })
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
                        $('.comment_box').html(res.html); // Update the HTML content of the container
                    } else {
                        $('.comment_box').html('<p>No comment found for this event.</p>');
                    }

                    // if (res?.lastBid) {
                    //     $('.bidPrice').text(res?.lastBid?.bid_price + ' (' + res?.lastBid?.get_user.name + ')');
                    // }

                    if (res?.lastBid) {
                        $('.bidPrice').html(
                            '<span style="color: green;">' + res?.lastBid?.bid_price + '</span>' +
                            ' <span style="color: #971C93;">(' + res?.lastBid?.get_user.name + ')</span>'
                        );
                    }

                    // if (res.lastBid && res.lastBid.bid_price && res.lastBid.get_user && res.lastBid.get_user.name) {
                    //     $('.bidPrice').text(res.lastBid.bid_price + ' (' + res.lastBid.get_user.name + ')');
                    // } else {
                    //     $('.bidPrice').text('No bids yet');
                    // }
                }
            })
        }
    }

    setInterval(() => {
        getComment();
    }, 2000);
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
        }
    }

    setInterval(() => {
        getEvent_gift();
    }, 5000);
</script>

</html>
@endsection