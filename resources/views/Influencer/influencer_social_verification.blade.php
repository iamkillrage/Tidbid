@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>My Post and Post Stream | TidBid</title>

</head>


<body>
    <!-- Header-Section -->
    <!-- NAV-STRIP -->
    <div class="second_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container">
                            <a class="navbar-brand_2" href="/"><img src="{{asset('Influencer/images/logo.svg')}}" alt=""></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse mt-0" id="navbarNav">

                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link " href="/">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{route('about_us')}}">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{route('Explore')}}">Explore</a>
                                    </li>

                                    <li class="nav-item bg-white text-dark rounded-pill pl-2 pr-2">
                                        <a class="nav-link" href="{{route('SignIn')}}">
                                            Login
                                        </a>
                                    </li>
                                    <li class="nav-item bg-lightpink text-dark rounded-pill">
                                        <a class="nav-link" href="/">For Users</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- NAV-STRIP -->
    <!-- Header-Section -->
    <!-- Main-Section -->
    <main>
        <section class="influ_profile">
           
            <div class="container " style="max-width: 600px;">
                <div class="modal-body mb-5">
                    <div class="forgot-password-in">
                        <img src="{{asset('Influencer/images/profile.png')}}" class="profile_size">
                        <h1>Profile Verification</h1>
                        <p class="pb-3">Your profile will be approved & verified by the TidBid team. We will notify you as soon as possible.</p>
                        <p>In the meantime, you can learn more about TidBid and your upcoming journey as an Influencer.</p>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#profile-verify" class="singup-btn okbtn" onclick="verification()">Resources</a>
                    </div>
                </div>
            </div>
        </section>


    </main>
    <!-- End Main-->


  <!-- Instagrame-Popup -->
  <!--<div class="modal fade forgot-password" id="insta_popup" data-bs-backdrop="static" data-bs-keyboard="false"-->
  <!--  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">-->
  <!--  <div class="modal-dialog">-->
  <!--    <div class="modal-content">-->
  <!--      <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>-->
  <!--      <div class="modal-body">-->
  <!--        <div class="forgot-password-in">-->
  <!--          <h1>Influencer Verification</h1>-->
  <!--          <p class="pb-3">Please DM below verification code from your-->
  <!--            Influencer Profile on TidBid's-->
  <!--            to help us verify your account. </p>-->

  <!--            <p class="code-text">Verification Code:<a href="#">54323</a></p>-->

  <!--            <a href="#" class="inst-btn"><img src="{{asset('Influencer/images/instagram.png')}}">@TidBid</a>-->

  <!--            <a href="#" class="singup-btn okbtn">Ok</a>-->
      
  <!--          <p>Didn't receive the verification code? <a href="javascript:void(0)"><b>RESEND</b></a></p>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->
  <!-- Instagrame-Popup -->


  <!-- snapchat-Popup -->
  <div class="modal fade forgot-password" id="snapchat" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
          <div class="forgot-password-in">
            <h1>Influencer Verification</h1>
            <p class="pb-3">Please DM below verification code from your
              Influencer Profile on TidBid's < Snapchat >
              to help us verify your account. </p>

              <p class="code-text">Verification Code:<a href="#">54323</a></p>

              <a href="#" class="inst-btn"><img src="{{asset('Influencer/images/instagram.png')}}">@TidBid</a>

              <a href="#" class="singup-btn okbtn">Ok</a>
      
            <p>Didn't receive the verification code? <a href="javascript:void(0)"><b>RESEND</b></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- snapchat-Popup -->


  <!-- x-twitter-Popup -->
  <div class="modal fade forgot-password" id="x-twitter" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
          <div class="forgot-password-in">
            <h1>Influencer Verification</h1>
            <p class="pb-3">Please DM below verification code from your
              Influencer Profile on TidBid's < Twitter >
              to help us verify your account. </p>

              <p class="code-text">Verification Code:<a href="#">54323</a></p>

              <a href="#" class="inst-btn"><img src="{{asset('Influencer/images/instagram.png')}}">@TidBid</a>

              <a href="#" class="singup-btn okbtn">Ok</a>
      
            <p>Didn't receive the verification code? <a href="javascript:void(0)"><b>RESEND</b></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- x-twitter-Popup -->

    <!-- tik-tok-Popup -->
    <div class="modal fade forgot-password" id="tik-tok" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
          <div class="forgot-password-in">
            <h1>Influencer Verification</h1>
            <p class="pb-3">Please DM below verification code from your
              Influencer Profile on TidBid's < tik-tok>
              to help us verify your account. </p>

              <p class="code-text">Verification Code:<a href="#">54323</a></p>

              <a href="#" class="inst-btn"><img src="{{asset('Influencer/images/instagram.png')}}">@TidBid</a>

              <a href="#" class="singup-btn okbtn">Ok</a>
      
            <p>Didn't receive the verification code? <a href="javascript:void(0)"><b>RESEND</b></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- x-twitter-Popup -->


  <div class="modal fade" id="profile-verify-social" data-bs-backdrop="static" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-body">
      <div class="forgot-password-in">
        <h1 class="mb-0">Congratulations!</h1>
        <img src="{{('accept-green.png')}}" style="width: 138px;height: 138px;">
        <p class="mb-3">Your Influencer Profile is verified and approved.</p>
        <form action="" class="mb-3">
          <a href="{{url('influencer-my-profile')}}" class="ok_btn" > ok</a>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->
</body>

</html>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  function verification() {
    $.ajax({
        url: "{{url('check-social-verification')}}",
        method: "GET",
        dataType: 'json',
        success: function(resp) {
            if (resp.type) {
                let modalId = '';
                switch (resp.type) {
                    case 'youtube':
                        modalId = '#youtube_popup';
                        break;
                    case 'instagram':
                        modalId = '#insta_popup';
                        break;
                    case 'tik-tok':
                        modalId = '#tik-tok';
                        break;
                    case 'snapchat':
                        modalId = '#snapchat';
                        break;
                    case 'x-twitter':
                        modalId = '#x-twitter';
                        break;
                }
                if (modalId) {
                    $(modalId).modal('show');
                }
            }
            if (resp.type === 'verified' && resp.status === 0) {
                $('#profile-verify-social').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
}

</script>