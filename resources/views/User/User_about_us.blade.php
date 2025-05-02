@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>About Us | TidBid</title>
</head>

<body>

    <!-- Header-Section -->
    <header>
        @include('User.Navbar.nav')
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>

        <div class="explore_banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="influ_text about_banner">
                            <h1>About Us</h1>

                            <ul class="banner_list">
                                <li><a href="{{route('User_Home')}}">Home</a><i class="far fa-angle-right"></i></li>
                                <!-- <li><a href="{{route('UserAboutUs')}}" id="myModal"  class="active" >About us</a></li> -->
                                <li><a href="{{route('UserAboutUs')}}" id="myModalTrigger" class="active"
                                        data-bs-toggle="modal" data-bs-target="#myModal">About us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="about_insect">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner_about">
                            <h6>About Us</h6>
                            <h2>Who We Are</h2>
                            <p class="pt-2 pb-2 text-dark"><b>We are growing with a large community of users and
                                    influencers <br> who can.</b></p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable. If you are going to use a passage of Lorem Ipsum, you
                                need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container about_bottom">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 ">
                    <div class="inner_about_l">
                        <h6>Offers & Fetuses</h6>
                        <h2>What TidBid Offers?</h2>
                        <p>We are growing with a large community of users and influencers who can</p>
                        <ul>
                            <li>Explore influencers</li>
                            <li>Follow them for notifications</li>
                            <li>Catch up their live stream</li>
                            <li>Can Like and Comment on posts</li>
                            <li>Share the posts and streams</li>
                            <li>Can bid for personal video call and auctions</li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="inner_aboutimg">
                        <img src="{{asset('Influencer/images/about_inner_r.png')}}">
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- Main-Section -->


    <!-- Unfollow PopUp -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog page_width">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>
                <div class="modal-body">
                    <div class="tidbid_logo"><img src="{{asset('Influencer/images/tidbid_logoimg.png') }}"
                            class="tidbid-pop-img" style="background: #460d48; padding: 14px; border-radius: 14px;">
                    </div>
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


</body>

</html>
@endsection
<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $("#myModal").modal('show');
    // });
</script>