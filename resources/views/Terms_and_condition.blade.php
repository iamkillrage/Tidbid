@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Term And Condition | TidBid</title>

</head>

<body>
  <!-- Header-Section -->
  <header>
    <div class="second_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- <nav class="navbar navbar-expand-lg navbar-light">
              <div class="container">
                <a class="navbar-brand_2" href="/"><img src="{{('Influencer/images/logo.svg')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button> -->
            <!-- <div class="collapse navbar-collapse mt-0" id="navbarNav"> -->

            <!-- <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link text-dark" href="">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="">Explore</a>
                  </li>
                  <li class="nav-item bg-white text-dark rounded-pill pl-2 pr-2">
                    <a class="nav-link" href="{{route('SignIn')}}">
                        Login
                    </a>
                </li>
                <li class="nav-item bg-lightpink text-dark rounded-pill">
                    <a class="nav-link" href="{{route('SignIn')}}">For Influencers</a>
                </li>
  
                </ul> -->
            @if(session('user_id'))
            @include('Influencer.layout.header1')
            @else
            @include('Influencer.layout.header')
            @endif
            <!-- </div> -->
            <!-- </div>
          </nav> -->
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header-Section -->

  <!-- Main-Section -->
  <main>

    <div class="terms_box">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="term_head">Terms and Conditions</h1>
            <div class="termstext">
              {{-- <h4>1. Lorem Ipsum is simply dummy.</h4> --}}
              <p>{!! $data->discription !!}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- End Main-Section -->


  <!-- Footer-Section -->
  <!-- <footer>
      <div class="footer-wrap">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="footer-in">
                          <img src="{{asset('Influencer/images/footer_logo.png') }}" alt="">

                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="footer-in footer-in-mid">
                      <h1>Quick Links</h1>
                      <p><a href="/">Home</a></p>
                      <p><a href="{{route('about_us')}}">About</a></p>
                      <p><a href="{{route('Explore')}}">Explore Now</a></p>
                      <p><a href="{{route('terms_condition')}}">Terms and Conditions</a></p>
                      <p><a href="{{route('Privacy_Policy')}}">Privacy Policy</a></p>
                  </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                      <div class="footer-in">
                          <h1>Connect with us</h1>
                          <ul class="social_link">
                              <li><a href="#"><img src="{{asset('Influencer/images/tik-tok.png')}}"> TikTok</a></li>
                              <li><a href="#"><img src="{{asset('Influencer/images/twiter.png')}}"> Twitter</a></li>
                              <li><a href="#"><img src="{{asset('Influencer/images/youtube.png')}}"> YouTube</a></li>
                              <li><a href="#"><img src="{{asset('Influencer/images/instagram.png')}}"> Instagram</a></li>
                          </ul>
                      </div>
                  </div>
              </div>

              <div class="row footer_bottom">
                  <div class="col-lg-12">
                      <div class="footer-bottom-in">
                          <p>Copyright©2023. All Rights Reserved.</p>
                          <p>Developed with <i class="fas fa-heart"></i> by <a href="http://www.yesitlabs.com/"
                                  target="_blank"> YES
                                  IT LABS LLC</a></p>
                      </div>
                  </div>
              </div>

          </div>
      </div>

  </footer> -->
  @include('Influencer.layout.footer')
  <!-- Footer-Section -->
</body>

</html>
@endsection