@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>User Chat | TidBid</title>

    <script type="module" crossorigin src="{{ asset('agorachat/assets/bundle.js') }}"></script>

    <style>
        /* .chatbox-input {
            position: relative;
            width: 100%;
            height: 47px;
            bottom: 0;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        } */

        .message.my-message {
            display: flex;
            justify-content: flex-end;
        }

    .container {
  position: relative; /* so the icon can be absolutely positioned inside it */
}

.back-icon {
  position: absolute;
  top: -22px;      /* adjust as needed */
  left: 0px;     /* adjust as needed */
  z-index: 9999;  /* large number to ensure it's on top */
  font-size: 18px;
  color: #fff;     /* or your preferred color */
  cursor: pointer;
}
.back-icon:hover {
    color: #000;
}

        .message.frnd-message {
            display: flex;
            justify-content: flex-start;
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
    <button class="d-none" id="connect" data-uid="{{ $userData->agora_id }}" data-token="{{ $data['token'] }}"></button>
    
    <!-- Main-Section -->
    <section class="chat-promoter-sec">
        <div class="container">
        <i class="fas fa-arrow-left back-icon" id="backButton"></i>

            <div class="chat-promoter-card">
                <div cLass="leftSide">
                    
                    <div class="imagetext">
                        <div class="profile_chat1">
                            @if(!empty($userData->profile_img))
                            <img src="{{ asset('/Influencer/images/profile_img/' . $userData->profile_img) }}" alt="">
                            @else
                            <img src="{{ asset('user.jpg') }}">
                            @endif
                        </div>

                        <div class="serch-chat">
                            <input type="text" placeholder="Search for start a new chat">
                            <i class="far fa-search"></i>
                        </div>
                    </div>

                    <!-- chatlist -->
                    <div class="chatlist scrollbar" id="style-2">
                        @foreach($getInfuList as $row)
                        <div class="blockbox infulancer-detail" data-profile="{{ asset('Influencer/images/profile_img/' . $row->getInfuList->profile_img) }}" data-channel="{{ $row->chanel_name }}" data-receiverid="{{ $row->getInfuList->id }}" data-peerid="{{ $row->getInfuList->agora_id }}" data-name="{{ $row->getInfuList->name }}">
                            <div class="imgbx">
                                <img src="{{ asset('Influencer/images/profile_img/' . $row->getInfuList->profile_img) }}" alt="">
                            </div>
                            <div class="detaills">
                                <div class="listhead">
                                    <h4>{{ $row->getInfuList->name }}</h4>
                                    @if ($row->getInfuLastMessage)
                                    <p>{{ $row->getInfuLastMessage->message }}</p>
                                    @endif
                                </div>
                                <div class="message_pp">
                                    @if ($row->getInfuLastMessage)
                                    <p class="timechat">
                                        {{ $row->getInfuLastMessage->created_at->format('h:i A')}}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- chatlist -->
                </div>

                <div class="rightSide">
                    <div class="profile_active">
                        <div class="detaills">
                            @if(!empty($getInfuList) && isset($getInfuList[0]))
                                <div class="imgbx infuimage">
                                    <img src="{{ asset('Influencer/images/profile_img/' . $getInfuList[0]->getInfuList->profile_img) }}" alt="">
                                </div>
                            @endif


                            <div class="listhead_2">
                                @if(!empty($getInfuList) && isset($getInfuList[0]))
                                    <h4 class="infulancer-name">{{ $getInfuList[0]->getInfuList->name }}</h4>
                                @endif

                                <p>Active today</p>
                            </div>
                        </div>
                        <div class="message_pp"><img src="{{asset('Influencer/images/Flag.png')}}"></div>
                    </div>

                    <!-- ----- Chatboxx -->
                    <div class="chatboxx scrollbar3" id="style-2">
                        <div class="message_alart">
                            <img src="{{ asset('Influencer/images/Lock.png') }}">
                            <p>
                                Messages are end-to-end encrypted. No one outside of this chat, not even TidBid can read
                                or listen to them click to learn more.
                            </p>
                        </div>

                        @foreach($AgoraMessage as $item)
                            <div class="message {{ $item->side == 'left' ? 'my-message' : 'frnd-message' }}">
                                <div class="userimg">
                                    <img src="{{ asset('Influencer/images/profile_img/' . $getInfuList[0]->getInfuList->profile_img) }}" alt="">
                                </div>
                                <div class="usertext">
                                    <p>{{$item->message}}</p>
                                </div>
                                <span>{{ date('h:i A') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="chatbox-input">
                        <div class="chatbox-input-inner">
                            <input type="hidden" id="peerId">
                            <input type="hidden" id="receiverId" value="{{ $checkChanel->reciver_id ?? '' }}">
                            <input type="hidden" id="channelId" value="{{ $checkChanel->chanel_name ?? '' }}">
                            <!--<i class="far fa-smile" onclick="setEmoji()"></i>-->
                            <i class="far fa-smile" onclick="toggleEmojiPicker()"></i>
                            <!-- Emoji List -->
                            <div id="emojiList" style="display: none; position: absolute; bottom: 30px; left: 0; background: #fff; border: 1px solid #ccc; padding: 5px; max-width: 300px; z-index: 999;">
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
                            <input id="message" type="text" placeholder="Send a message" class="messagebox">
                            <img id="sendMessage" src="{{asset('Influencer/images/send-icon.png')}}" alt="" class="send-message">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main-Section -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('#connect').click();
        }, 2000);

        // Get the CSRF token from the meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        $('#sendMessage').click(function() {
            var message = $('#message').val();
            var receiverId = $('#receiverId').val();
            var channelId = $('#channelId').val();
            
            if (message != '') {
                $.ajax({
                    url: "{{url('send-message')}}",
                    method: 'GET',
                    data: {
                        message,
                        receiverId,
                        channelId,
                        _token: csrfToken
                    },
                    success: function(response) {
                        // Clear the message input box
                        $('#message').val('');

                        let messageBox = `<div class="message my-message">
                            <div class="userimg"><img src="{{ asset('Influencer/images/userinflu_img1.png') }}" alt=""></div>
                            <div class="usertext">
                                <p>` + message + `</p>
                                <span>{{ date('h:i A') }}</span>
                            </div>
                        </div>`;

                        // Make sure to append it to the correct message container
                        $('.chatboxx').append(messageBox);

                        // Scroll to the bottom of the chat box to show the latest message
                        $('.chatboxx').scrollTop($('.chatboxx')[0].scrollHeight);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending message:', error);
                    }
                });
            }
        });
    });

    // setInterval(getchatMessage, 2000);
    // Combine chat fetching functions in one setInterval
    setInterval(function() {
        getchatMessage();
        getLastMessage();
    }, 2000);

    function getchatMessage() {
        var receiverId = $('#receiverId').val();

        $.ajax({
            url: "{{ url('get-message') }}",
            method: 'GET',
            dataType: 'json',
            data: {
                influencerId: receiverId
            },
            success: function(response) {
                    $('.chatboxx').html('');

                    // Append the new messages from the server response
                    $('.chatboxx').append(response.data);

                    // Scroll to the bottom after loading messages
                    $('.chatboxx').scrollTop($('.chatboxx')[0].scrollHeight);
            }
        })
    }

    function getLastMessage() {
        var receiverId = $('#receiverId').val();
        
        $.ajax({
            url: "{{ url('get-last-message') }}",  // The endpoint to get the last message
            method: 'GET',
            data: {
                influencerId: receiverId
            },
            success: function(response) {
                // Find the correct influencer block by data-receiverid and update the last message
                let influencerDetail = $('.infulancer-detail[data-receiverid="' + receiverId + '"]');
                    
                // Update the last message in the chat list
                influencerDetail.find('.listhead p').text(response.lastMessage);
                
                // Update the message time if necessary
                influencerDetail.find('.timechat').text(response.lastMessageTime);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching last message:', error);
            }
        });
    }
    
    function toggleEmojiPicker() {
        $('#emojiList').toggle();
    }
    
    $(document).on('click', '.emoji', function () {
        let emoji = $(this).text();
        $('.messagebox').val($('.messagebox').val() + emoji);
        $('#emojiList').hide(); // Optionally hide picker after selecting
    });

    function setEmoji() {
        $('.messagebox').val($('.messagebox').val() + 'ðŸ˜Š');
    }

    $('.infulancer-detail').click(function() {
        var name = $(this).data('name');
        var peerId = $(this).data('peerid');
        var profile = $(this).data('profile');
        var receiverId = $(this).data('receiverid');
        var channelId = $(this).data('channel');
        

        $('.infuimage').html('<img src="' + profile + '" alt="Influencer Image">');
        $('.infulancer-name').text(name);
        $('#receiverId').val(receiverId);
        $('#channelId').val(channelId);
        $('#peerId').val(peerId);
        $('.rightSide').show();

        getchatMessage();
        getLastMessage();

    });
</script>

<script>
    document.getElementById("backButton").addEventListener("click", function() {
        window.history.back(); // Pichle page par jane ke liye
    });
</script>


</html>
@endsection