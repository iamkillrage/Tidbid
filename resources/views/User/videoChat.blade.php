@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Video Chat | TidBid</title>
    <link rel="stylesheet" href="https://unpkg.com/emoji-mart@5.4.0/dist/browser/emoji-mart.css">

    <script src="{{ asset('agorachat/video/bundle.js') }}"></script>

</head>

<body>
    <!-- Header-Section -->
    <header>
        @include('User.Navbar.nav')
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>
        <section class="details_sect mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="back-from-chat">
                            <a href="#"><i class="far fa-chevron-left"></i></a>
                        </div>
                        <div class="live-video-inner">
                            <div class="live-video-inner-name"> {{ $influencer->name }} <img src="{{ asset('agorachat/assets/live-video/mic-on-bottom.svg')}}" alt=""></div>
                            <div class="live-video-inner-btns">
                                <button type="button" class="d-none" id="join" data-channel="{{ $data['channel'] }}" data-token="{{ $data['token'] }}" data-uid="{{ $data['uid'] }}"></button>
                                <button type="button" id="leave"><img src="{{ asset('agorachat/assets/live-video/end-call.svg')}}" alt=""></button>
                                <button type="button" id="mute"><img src="{{ asset('agorachat/assets/live-video/mic-on.svg')}}" alt=""></button>
                                <button type="button" id="unmute" style="display: none;"><img src="{{ asset('agorachat/assets/live-video/mic-off.svg')}}" alt=""></button>
                            </div>
                            <div id="streamVideo" class="details_video" style="height: 420px;">
                                <!-- Streaming Video -->
                            </div>
                        </div>
                        <div id="selfVideo" class="private-chat-bottom" style="height: 150px;">
                            <div class="private-chat-bottom-in">
                                <div class="private-chat-bottom-in-content">
                                    <div class="private-chat-bottom-name-status">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </div>
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
            $('#join').click();
        }, 2000);
    })
</script>

</html>

@endsection