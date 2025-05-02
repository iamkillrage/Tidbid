@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title> TidBid | Home </title>
    
</head>

<body>
    <!-- Header-Section -->
    <header>
        <!-- NAV-STRIP -->

        <!-- NAV-STRIP -->
        <!-- BANNER-SECTION -->
        <div class="banner-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="container">
                                <a class="navbar-brand_2" href="/"><img src="{{asset('Influencer/images/logo.svg')}}" alt=""></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link " href="/">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{route('about_us')}}">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{route('Influencer_Explore')}}">Explore</a>
                                        </li>
                                        <li class="nav-item bg-white text-dark rounded-pill pl-2 pr-2">
                                            <a class="nav-link" href="{{route('User_SignIn')}}">
                                                Login
                                            </a>
                                        </li>
                                        <li class="nav-item bg-lightpink text-dark rounded-pill">
                                            <a class="nav-link" href="{{route('SignIn')}}">For Influencers</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="banner-inner">
                            <h1>Explore your favourite influencers and grab a Ball of a time!</h1>
                            <p>Welcome to our vibrant live streaming portal - TidBid, where the world comes alive with
                                captivating moments and thrilling experiences. Step into a virtual universe that
                                seamlessly blends entertainment, connection, and boundless creativity. </p>
                            <a href="{{route('Influencer_Explore')}}">View More</a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="header_right">
                            <img src="{{asset('Influencer/images/banner-right.png')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-Section -->
    <!-- Main-Section -->
    <main>
        <!-- Influencers -->
        <div class="upcoming-events-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 crousel_box">
                        <div class="heading-wrap">
                            <h1>Influencers</h1>
                            <p>Explore the vibrant community for a better experience</p>
                        </div>
                        <div class="heading-wrap1">
                            <a href="{{route('Influencer_Explore')}}">View All</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="upcoming-events-slider" class="owl-carousel">
                            <!-- ITEM -->
                            @foreach($influencerData as $value)
                            <div class="upcoming-events-in">
                                <div class="upcoming-events-img">
                                    <?php
                                    // Assuming $value->profile_img contains the path to the upoaded image or is empty
                                    $profile_img = $value->profile_img ? $value->profile_img : 'noimages.jpg'
                                    ?>

                                    <img src="{{asset('Influencer/images/profile_img/'.$profile_img)}}" alt="" style="width: 100px; height: 250px;">
                                </div>
                                <div class="influ-text">
                                    <div class="inner_text">
                                        <h3>{{$value->userName}}</h3>
                                        <p>{{ count($value->getFollowing) }} Follower</p>
                                    </div>
                                    <a href="{{url('detail-stream-page?id='.$value->id)}}">View Details</a>
                                </div>
                            </div>
                            @endforeach
                            <!-- ITEM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Influencers -->


        <!-- Start About Us -->
        <section class="about_sect">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="aboutimg">
                            <img src="{{('Influencer/images/about_img1.png')}}">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="about_text">
                            <span>About Us</span>
                            <h3>What TidBid Offers?</h3>
                            <p>We are growing with a large community of users and influencers who can</p>
                            <ul>
                                <li>Explore influencers</li>
                                <li>Follow them for notifications</li>
                                <li>Catch up their live stream</li>
                                <li>Can Like and Comment on posts</li>
                                <li>Share the posts and streams</li>
                                <li>Can bid for personal video call and auctions</li>
                            </ul>

                            <a href="{{route('about_us')}}">Read More</a>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- End About Us -->

        <!-- Streaming Now -->
        <div class="upcoming-events-wrap pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12  crousel_box">
                        <div class="heading-wrap">
                            <h1>Streaming Now</h1>
                            <p>Catch up the influencers now</p>
                        </div>

                        <div class="heading-wrap1">
                            <a href="{{route('Influencer_Explore_Stream')}}">View All</a>
                        </div>

                    </div>
                    <div class="col-lg-12 mt-3">
                        <div id="upcoming-events-slider" class="owl-carousel">
                            <!-- ITEM -->
                            @if ($allstreamdata->isEmpty())
                            <strong>No Data Found !</strong>
                            @else

                            @foreach($allstreamdata as $value)
                            <div class="upcoming-events-in">
                                <div class="upcoming-events-img">
                                    <img src="{{asset('Influencer/images/profile_img/'.$value->getinfluencer->profile_img)}}" alt="">
                                </div>
                                <a href="#" class="online_tag"><img src="{{asset('Influencer/images/online_tag.png')}}"></a>
                                <div class="influ-text">

                                    <div class="inner_text">
                                        <h3>{{ $value->getInfluencer->name ? $value->getInfluencer->name :''}}</h3>
                                        <p>5K Following</p>
                                    </div>

                                    @if(Auth::check())
                                    <a href="{{ url('user-live-stream/'.$value->id) }}" class="join_btn">Join Now</a>
                                    @else
                                    <a href="{{ route('User_SignIn') }}" class="join_btn">Join Now</a>
                                    @endif
                                </div>

                            </div>
                            <!-- ITEM -->
                            @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Streaming Now -->

        <!-- Start Upcoming Live Streams-->
        <section class="upcoming">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="upcoming_left">
                            <h2>Upcoming Live Streams</h2>
                            @foreach($upComingstream as $value)
                            <div class="upcoming_video mb-3">
                                <iframe src="https://www.youtube.com/embed/G1MbKD1DRwM?si=7puSdp0bJbSTeoVn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>

                            <div class="upcoming_lefttext">
                                <span>
                                    <h6>
                                        <?php echo date('m-d-Y', strtotime($value->streamDate)); ?>
                                        [ {{ $value->streamTime }} ]
                                    </h6>
                                </span>
                                <h4>{{ $value->streamTitle }}</h4>
                                <p>{{ $value->description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="recent_right">
                            <div class="upcoming_left">
                                <h2>Recent Streams</h2>
                            </div>

                            <div class="recent_box">
                                <div class="recent_video">
                                    <iframe src="https://www.youtube.com/embed/G1MbKD1DRwM?si=7puSdp0bJbSTeoVn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                                <div class="recent_r_text">
                                    <span>Jan 12, 2023 [09.00 am - 04.00 pm EST]</span>
                                    <h4>Lorem Ipsum is simply dummy text of the printing.</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>

                            <div class="recent_box">
                                <div class="recent_video">
                                    <iframe src="https://www.youtube.com/embed/G1MbKD1DRwM?si=7puSdp0bJbSTeoVn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                                <div class="recent_r_text">
                                    <span>Jan 12, 2023 [09.00 am - 04.00 pm EST]</span>
                                    <h4>Lorem Ipsum is simply dummy text of the printing.</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>

                            <div class="recent_box">
                                <div class="recent_video">
                                    <iframe src="https://www.youtube.com/embed/G1MbKD1DRwM?si=7puSdp0bJbSTeoVn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                                <div class="recent_r_text">
                                    <span>Jan 12, 2023 [09.00 am - 04.00 pm EST]</span>
                                    <h4>Lorem Ipsum is simply dummy text of the printing.</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>

                            <div class="recent_box">
                                <div class="recent_video">
                                    <iframe src="https://www.youtube.com/embed/G1MbKD1DRwM?si=7puSdp0bJbSTeoVn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                                <div class="recent_r_text">
                                    <span>Jan 12, 2023 [09.00 am - 04.00 pm EST]</span>
                                    <h4>Lorem Ipsum is simply dummy text of the printing.</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>

                            <div class="video_btn"><a href="{{route('Influencer_Explore_Stream')}}">View More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Upcoming Live Streams-->

        <!-- Explore More Streams -->
        <section class="explore">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="explor_h">
                            <h3 class="pb-4">Explore More Streams</h3>
                            <a href="{{route('Influencer_Explore_Stream')}}">View All</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($morestream as $data)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="explor_box">
                            <div class="explor_img">
                                <img src="{{asset('Influencer/images/thumbnail/'. $data->thumbnail_img)}}">
                            </div>
                            <div class="explor_text">
                                <h6> {{$data->streamDate}} {{$data->streamTime}}</h6>
                                <h3>{{$data->streamTitle}}</h3>
                                <span>{{ implode(' ', array_slice(str_word_count($data->description, 1), 0, 15)) }}...</span>
                            </div>
                            <div class="explor_text">
                                <a href="{{route('Influencer_My_Stream_Detail',['stream_id' => $data->id])}}">View More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Explore More Streams-->
    </main>
    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->

    <!-- Unfollow PopUp -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog page_width">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body">
                    <div class="tidbid_logo"><img src="{{asset('Influencer/images/tidbid_logoimg.png') }}" class="tidbid-pop-img" style="background: #460d48; padding: 14px; border-radius: 14px;"></div>
                    <h5 class="text-center fs-4 text-dark"><b>How Tidbid Works</b></h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere efficitur Mauris nisi
                        nulla,
                        suscipit quis tincidunt id, placerat non magna. Quisque placerat, risus in pretium molestie,
                        diam arcu suscipit velit, eu placerat diam leo sit amet massa.</p>
                    <ul class="logo_list">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Etiam in est sollicitudin, rhoncus ante nec, porttitor nisi.</li>
                        <li>Aenean ac erat et metus tempor rutrum.</li>
                        <li>Quisque tincidunt massa vel interdum eleifend.</li>
                        <li>Proin finibus lorem a justo sollicitudin, eu sagittis ipsum tempus.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Unfollow PopUp -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script>
    //     $(document).ready(function() {
    //         $("#myModal").modal('show');
    //     });
     </script>
</body>

</html>
@endsection