@extends('User.LayoutWebsite.masterwebsite')
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
        .comment_text {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .comment_text p {
            margin-bottom: 0px !important;
        }

        .commentProfile {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }
        
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
        @include('User.Navbar.nav')
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>
        @if ($streamdata->status == 'Activate')
        <section class="details_sect mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="video_profile">
                            <div class="profile_details mt-0">
                                @if($streamdata->getInfluencer->profile_img !='')
                                <div class="details_img"><img src="{{asset('Influencer/images/profile_img/' . $streamdata->getInfluencer->profile_img)}}">
                                </div>
                                @else
                                <div class="details_img"><img src="{{asset('user.jpg')}}"></div>
                                @endif
                                <div class="profile_dec">
                                    <h6>{{ $streamdata->streamTitle }}</h6>
                                    <p>{{ $streamdata->getInfluencer->bio }}</p>
                                </div>
                            </div>

                            <div class="group_btn">
                                @if($checkFollow)
                                <a href="javascript:void(0)" data-userId="{{$streamdata->getInfluencer->id }}" data-url="{{url('/')}}" class="userFollow"><i class="fas fa-users"></i> Followed</a>
                                @else
                                <a href="javascript:void(0)" data-userId="{{$streamdata->getInfluencer->id }}" data-url="{{url('/')}}" class="userFollow"><i class="fas fa-users"></i> Follow</a>
                                @endif
                            </div>
                        </div>
                        <div class="live-video-inner">
                            <div id="streamVideo" class="details_video" style="height: 420px;">
                                <!-- Streaming Video -->
                            </div>
                        </div>
                        <button type="button" class="d-none" id="join-stream" data-channel="{{ $data['channel'] }}" data-token="{{ $data['token'] }}" data-uid="{{ $data['uid'] }}">Join as audience</button>
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
                                    <input type="hidden" placeholder="Comment" id="stream_id" name="stream_id" value="{{ $streamdata->id }}">
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
                            </ul>
                        </div>

                        <div class="send_gift">
                            @if($streamdata->what_to_expect == 'Private_Video_call')
                            <a href="javascript:void(0)" class="send-button PrivateChat" style="display: none;" target="_blank">Private Video</a>
                            @else
                            <a href="javascript:void(0)" class="send-button PrivateChat" style="display: none;" target="_blank">Private Chat</a>
                            @endif

                            @if(count($saveCard) > 0)
                            <a href="javascript:void(0)" class="send-button" data-bs-toggle="modal" data-bs-target="#exampleModal_1">Send Gift</a>
                            @else
                            <a href="javascript:void(0)" class="send-button" data-bs-toggle="modal" data-bs-target="#check-payment-method">Send Gift</a>
                            @endif

                            @if(count($saveCard) > 0)
                            @if($streamdata->bid_end_status == 2)
                            <a href="{{ url('user-auction/' . $streamdata->id) }}">Bid Now</a>
                            @endif

                            @else
                            <a href="javascript:void(0)" data-bs-toggle="modal" class="bid_btn" data-bs-target="#exampleModal_2">Bid Now</a>
                            @endif
                        </div>

                        <div class="live_tag">
                            <p>
                                <span style="color: #000">15</span> Mins {{ $streamdata->what_to_expect == 'Private_chat' ? 'Private Chat' : 'Private Video' }} | Base Price :
                                <span>${{$streamdata->baseBidPrice}}</span> | Current Bid :
                                <span style="color: green;">$</span><span class="bidPrice">{{isset($lastBid->bid_price) ? $lastBid->bid_price:''}} @if(!empty($lastBid->getUser)) <span style="color: #971C93;">
                                    ({{ isset($lastBid->getUser->name) ? $lastBid->getUser->name : '' }})
                                </span> @endif</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @else
        <script>
            setTimeout(() => {
                window.location.reload();
            }, 10000);
        </script>
        @endif

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
                    <!--itme-->
                    @if ($upcoming->isEmpty())
                    <div class="alert alert-secondary">
                        <strong>No Upcoming Live Stream !</strong>
                    </div>
                    @else

                    @foreach($upcoming as $value)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
                        <div class="influ_box_1 ">
                            <div class="influimg1"><img src="{{asset('Influencer/images/profile_img/'.$value->getInfluencer->profile_img)}}">
                            </div>
                            <div class="influtext">
                                <h3><a href="#">{{ $value->streamTitle}}</a>
                                </h3>
                                <p>{{$value->description}}</p>
                                <div class="shedul">
                                    <p class="gray_text"><i class="fas fa-calendar-alt"></i>{{$value->streamDate}}
                                    </p>
                                    <p class="gray_text"><i class="far fa-clock"></i>{{$value->streamTime}}</p>
                                </div>

                                @php
                                $stream_id = [];
                                foreach($Notify as $Notifys) {
                                $stream_id[] = $Notifys->stream_id;
                                }
                                @endphp
                                <div class="stream_btn" id="changeButton_{{$value->id}}">
                                    @if(in_array($value->id, $stream_id))
                                    <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'notify')" class="notify_btn notifyMe">Subscribed</a>
                                    @else
                                    <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'Subscribe')" class="notify_btn notifyMe">Notify Me</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--itme-->
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
    <!-- Main-Section -->

    <!-- Popup gift -->
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0 pb-5 ">
                    <div class="gift_logo">
                        <img src="{{asset('Influencer/images/gift_logo.png')}}">
                    </div>
                    <h1 class="modal-title text-center report-h5 pt-3">Enter Gift Amount </h1>

                    <div class="type_ammount">
                        <input type="text" class="send-gift-amt">
                    </div>

                    <div class="sugg_btn">
                        <h3>Suggested Amount</h3>
                    </div>

                    <div class="ammount_box">
                        <button class="price_btn1 get-price" data-price="5">$5</button>
                        <button class="price_btn1 get-price" data-price="25">$25</button>
                        <button class="price_btn1 get-price" data-price="50">$50</button>
                        <button class="price_btn1 get-price" data-price="100">$100</button>
                        <button class="price_btn1 get-price" data-price="250">$250</button>
                        <button class="price_btn1 get-price" data-price="500">$500</button>
                    </div>

                    <div class="submit_btn">
                        <a href="javascript:void(0)" onclick="sendGift()">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup gift -->

    <!-- Popup gift -->
    <div class="modal fade" id="exampleModal_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0 pb-5 ">
                    <h1 class="modal-title text-center report-h5 pt-3">Tidbid</h1>

                    <div class="gift_logo">
                        <img src="{{asset('Influencer/images/gift_logo.png')}}">
                    </div>
                    <p class="text-center pt-4">To enter TidBid Auction you must have a valid payment option</p>
                    <div class="submit_btn">
                        <a href="{{url('user-no-save-card')}}">Add Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup gift -->

    <!---check card  added or not--->
    <div class="modal fade" id="check-payment-method" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0 pb-5 ">
                    <h1 class="modal-title text-center report-h5 pt-3">Tidbid</h1>

                    <div class="gift_logo">
                        <img src="{{asset('Influencer/images/gift_logo.png')}}">
                    </div>
                    <p class="text-center pt-4">Send to gift add valid payment option</p>
                    <div class="submit_btn">
                        <a href="{{url('user-no-save-card')}}">Add Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/emoji-mart@5.4.0/dist/browser/emoji-mart.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('#join-stream').click();
        }, 2000);
    })

    function get_chat_video_url() {
        var streamId = "{{ $streamdata->id }}";

        $.ajax({
            url: "{{ url('get-video-url') }}",
            method: "GET",
            data: {
                streamId
            },
            dataType: "json",
            success: function(response) {
                if (response.data != '') {
                    var urldata = "{{ url('') }}" + '/' + response.data;

                    $('.PrivateChat').show();
                    $('.PrivateChat').attr('href', urldata);
                }
            }
        })
    }
    
    function toggleEmojiPicker() {
        $('#emojiList').toggle();
    }
    
    $(document).on('click', '.emoji', function () {
        let emoji = $(this).text();
        var stream_id = $('#stream_id').val();
        
        $.ajax({
            url: "{{url('sendLiveComment')}}",
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
            url: "{{url('sendLiveComment')}}",
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
            url: "{{url('sendLiveComment')}}",
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
            url: "{{url('sendLiveComment')}}",
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
        var commentcontent = $('#comment-content').val();
        var stream_id = $('#stream_id').val();

        if (commentcontent) {
            $.ajax({
                url: "{{url('sendLiveComment')}}",
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
    });

    function getComment() {
        var stream_id = "{{$streamdata->id}}";

        if (stream_id != '') {
            $.ajax({
                url: "{{url('LiveStreamComment')}}",
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

                    if (res?.lastBid) {
                        $('.bidPrice').text(res?.lastBid?.bid_price + ' (' + res?.lastBid?.get_user.name + ')');
                    }

                    if (res?.bidStatus == 1) {
                        get_chat_video_url();
                    }
                }
            })
        }
    }

    setInterval(getComment, 5000);
</script>

<script>
    // straming comment
    function getEvent_gift() {
        var eventId = "{{$streamdata->id}}";

        if (eventId != '') {
            $.ajax({
                url: "{{url('send_gift_user')}}",
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

    getEvent_gift();

    $(document).on('click', '.get-price', function() {
        var price = $(this).attr('data-price');
        $('.send-gift-amt').val(price);
    })

    $(document).on('click', '.send-button', function() {
        $('.send-gift-amt').val('');
    });

    //Send gift to 
    function sendGift() {
        var price = $('.send-gift-amt').val();
        var stream_id = "{{ $streamdata->id }}";
        var infuId = "{{$streamdata->influencer_id}}";
        if (price == '') {
            toastr.error('Please enter gift amount');
            return false;
        }

        $.ajax({
            url: "{{route('send_gift')}}",
            type: "get",
            data: {
                price: price,
                stream_id: stream_id,
                influencer_id: infuId
            },
            success: function(data) {
                if (data.status == 1) {
                    $('#exampleModal_1').modal("hide");
                    toastr.success(data.message);
                    getEvent_gift();
                } else {
                    toastr.error(data.message);
                }
            }
        })
    }
</script>

<script>
    function notifyMee(id, events) {
        $.ajax({
            url: "{{ url('notifyMee') }}",
            method: 'GET',
            data: {
                stream_id: id,
                events: events
            },
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 1) {
                    $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMee(' + resp.id + ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
                    toastr.success(resp.message);
                } else if (resp.status == 2) {
                    $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMee(' + resp.id + ', \'Subscribe\')" class="notify_btn notifyMe" >Notify Me</a>');
                    toastr.success(resp.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); // Log any errors for debugging purposes
            }
        });
    }
</script>

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
                    }

                    if (resp.status == 2) {
                        $('.userFollow').text('Follow');
                        toastr.success(resp.message);
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

</html>
@endsection