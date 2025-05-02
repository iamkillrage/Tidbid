@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencer Sign Up | TidBid</title>
<style>
    #timer {
    min-width: 50px; /* Timer ka fixed width set karein */
    display: inline-block; /* Inline element ke size ko fix karein */
    text-align: center;
}
</style>


</head>

<body>
    @if (!session()->has('login_is')) 
    <!-- Header-Section -->
    <header>
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
    </header>
    <!-- Header-Section -->
    @else
        <header>
            @include('User.Navbar.nav')
        </header>
        
    @endif
    <!-- Main-Section -->
    <main>
        <!-- Sign-In -->
        <div class="sign-in-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">

                        <div class="sign-in-inner-image">
                            <img src="{{asset('Influencer/images/login_img.svg')}}" alt="">
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6">
                        <div class="sign-in-inner mt-4">
                            <h1>influencer Sign Up</h1>
                            <p style="color: #333;">To become an influencer on Tidbid, you need to have a certain fan
                                base on one of the following social platforms.</p>
                            <form  id="signupform" method="post" >
                                @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}
                </div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-success">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <div class="dropdown full-sect">
                    <div class="elipse-wrap ">
                        <label for="">
                            Select Social Platform
                            <div class="select-box">
                                <p>Social </p>
                                <i class="fas fa-caret-down"></i>
                            </div>
                        </label>


                        <div class="show-elipse-card social_drop " style="display: none;">
                            <div class="sign-dropdown scrollbar" id="style-2">
                                <ul class="dropbox force-overflow">
                                  

                                    <li>
                                        <a href="#" data-bs-target="#insta_popup" data-bs-toggle="modal" data-bs-dismiss="modal">
                                            <div class="check_sec uncheck"></div>
                                            <div class="droptext">
                                                <h5>10,000</h5>
                                                <p>Followers and active engagement</p>
                                            </div>
                                            <div class="soical_img"> <img src="{{asset('Influencer/images/instagram.svg')}}">
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="check_sec uncheck"></div>
                                            <div class="droptext">
                                                <h5>10,000</h5>
                                                <p>Followers and active engagement</p>
                                            </div>
                                            <div class="soical_img"> <img src="{{asset('Influencer/images/tik-tok-1.png')}}">
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="check_sec uncheck"></div>
                                            <div class="droptext">
                                                <h5>10,000</h5>
                                                <p>Followers and active engagement</p>
                                            </div>
                                            <div class="soical_img"> <img src="{{asset('Influencer/images/Snapchat1.png')}}">
                                            </div>
                                        </a>
                                    </li>


                                    <li>
                                        <a href="#">
                                            <div class="check_sec uncheck"></div>
                                            <div class="droptext">
                                                <h5>10,000</h5>
                                                <p>Followers and active engagement</p>
                                            </div>
                                            <div class="soical_img"> <img src="{{asset('Influencer/images/x-twitter.svg')}}">
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="check_sec uncheck"></div>
                                            <div class="droptext">
                                                <h5>10,000</h5>
                                                <p>Followers and active engagement</p>
                                            </div>
                                            <div class="soical_img"> <img src="{{asset('Influencer/images/Snapchat-dd.png')}}">
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="check_sec uncheck"></div>
                                            <div class="droptext">
                                                <h5>10,000</h5>
                                                <p>Followers and active engagement</p>
                                            </div>
                                            <div class="soical_img"> <img src="{{asset('Influencer/images/logos_twitch.png')}}">
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="">
                    Enter Username
                    <input type="text" name="userName" required id="userName" placeholder="Username">
                </label>

                <label for="">
                    Enter Your Email
                    <input type="text" name="email" required id="email" placeholder="Enter registered email">
                </label>
                <label for="">
                    Create Password
                    <div class="password-inner">
                        <input type="Password" name="password" id="password" required placeholder="Password" class="password">
                        <div class="password-eye">
                            <div class="eye eye-close"></div>
                        </div>
                    </div>
                </label>
                {{-- <input type="hidden" name="action" value="0">  

                                <button type="button" onclick="RegisterInfu()" class="singup-btn_2 mb-3 mt-3 RegisterInfu">Sign Up</button>
                                <div id="error-message1" style="display: flex; color: red;"></div>

                                <h2>
                                    <input type="checkbox">
                                    You agree to our <a href="terms-and-conditions.html">Terms & Conditions</a> and <a
                                        href="privacy-policy.html">Privacy Policy.</a>
                                </h2>
                                <h2>Are you an influencer?<a href="influencers-sign-up.html"><b>Sign Up</b></a> as an
                                    influencer</h2>
                            </form>
                        </div>
                    </div> --}}
                <div class="col-lg-6 col-md-6">
                    <div class="sign-in-inner mt-4">
                        <h1>influencer Sign Up</h1>
                        <p style="color: #333;">To become an influencer on Tidbid, you need to have a certain fan
                            base on one of the following social platforms.</p>
                        <form id="signupform" method="post">
                            @csrf
                            <div class="dropdown full-sect">
                            <span class="text-danger" id="checkboxError"></span>
                                <div class="elipse-wrap ">
                                    <label for="">
                                        Select Social Platform
                                        <div class="select-box">
                                            <p class="selectedItem">Social </p>
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </label>
                                    <div class="show-elipse-card social_drop " style="display: none;">

                                        <div class="sign-dropdown scrollbar" id="style-2">
                                            <ul class="dropbox force-overflow">
                                         

                                                <li>

                                                    <!-- <a href="#" data-bs-target="#insta_popup" data-bs-toggle="modal" data-bs-dismiss="modal"> -->


                                                    <div class="checkbox-row">
                                                        <input type="checkbox" class="social" value="instagram" name="checkbox">
                                                        <div class="droptext">
                                                            <h5>10,000</h5>
                                                            <p>Followers and active engagement</p>
                                                        </div>
                                                        <div class="soical_img"> <img src="{{asset('Influencer/images/instagram.svg')}}"></div>
                                                    </div>

                                                    </a>
                                                </li>

                                                <li>
                                                    <div class="checkbox-row">
                                                        <input type="checkbox" class="social" value="tik-tok" name="checkbox">
                                                        <div class="droptext">
                                                            <h5>10,000</h5>
                                                            <p>Followers and active engagement</p>
                                                        </div>
                                                        <div class="soical_img"> <img src="{{asset('Influencer/images/tik-tok-1.png')}}"></div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="checkbox-row">
                                                        <input type="checkbox" class="social" value="snapchat" name="checkbox">
                                                        <div class="droptext">
                                                            <h5>10,000</h5>
                                                            <p>Followers and active engagement</p>
                                                        </div>
                                                        <div class="soical_img"> <img src="{{asset('Influencer/images/Snapchat1.png')}}"></div>
                                                    </div>
                                                </li>


                                                <li>
                                                    <div class="checkbox-row">
                                                        <input type="checkbox" class="social" value="x-twitter" name="checkbox">
                                                        <div class="droptext">
                                                            <h5>10,000</h5>
                                                            <p>Followers and active engagement</p>
                                                        </div>
                                                        <div class="soical_img"> <img src="{{asset('Influencer/images/x-twitter.svg')}}"></div>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label for="">
                                Enter Username
                                <input type="text" name="userName" required id="userName" autocomplete="off" placeholder="Username">
                                <span class="text-danger" id="userNameError"></span>
                            </label>
                            <label for="">
                                Enter Your Email
                                <input type="text" name="email" required id="email" placeholder="Enter registered email">
                                <span class="text-danger" id="emailError"></span>
                            </label>
                            <label for="">
                                Create Password
                                <div class="password-inner">
                                    <input type="password" name="password" id="password" required placeholder="password" class="password">
                                    <div class="password-eye">
                                        <div class="eye eye-close"></div>
                                    </div>

                                </div>
                                <span class="text-danger" id="passwordError"></span>
                                <small class="text-success">One alphanumeric one special symbol minimum 8 characters</small>
                            </label>



                            <!--<label for="">-->
                            <!--    Refer Code-->
                            <!--    <div class="password-inner">-->
                            <!--        <input type="text" name="refer_code" id="refer_code" required placeholder="Refer Code (optional)" class="refer_code">-->

                            <!--    </div>-->
                            <!--</label>-->

                            {{-- <a href="#" value="Sign Up" type="submit" class="singup-btn mb-3 mt-3">Sign Up</a> --}}
                            <button type="button" onclick="RegisterInfu()" class="singup-btn_2 mb-3 mt-3">Sign Up</button>
                            <h2>
                                <input type="checkbox" name="term_condition" class="agree">

                                You agree to our <a href="{{route('terms_condition')}}">Terms & Conditions</a> and <a href="{{route('Privacy_Policy')}}">Privacy Policy.</a>
                            </h2>
                            <span class="text-danger agree_message" style="font-size: small;"></span>
                            <h2>Have an account Influencer ?<a href="{{route('SignIn')}}"><b>Sign In</b></a> as an influencer</h2>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Sign-In -->
    </main>
    <!-- Main-Section -->
    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->

    <!-- OTP-Popup -->
    <div class="modal fade forgot-password" id="otp-verification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3 resetotp" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <!--<h5>Otp-<span class="otp"></span></h5>-->
                        <h1>Verification Code</h1>
                        <p class="pb-3">Enter OTP code sent to your email id</p>
                        <form action="">
                            <input type="hidden" value="" class="userId">
                            <div class="otp-verification-input">
                                <input type="number" class="inputs otp1" maxlength="1" minlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp2" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp3" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp4" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp5" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                            </div>
                            <span class="text-danger otpMessage" style="text-align: center"></span>
                            <!-- <input type="button" value="Submit" data-bs-target="#Sucessfull" data-bs-toggle="modal" data-bs-dismiss="modal"> -->
                            <input type="button" value="Submit" onclick="getOtp()"></ </form>
                            <span class="d-flex justify-content-center">Didn't receive the verification code? <span class="resendOtp"><a href="javascript:void(0)" onclick="resendOtp()">RESEND</a></span> <span id="timer"></span></p>
                                 <!--<span>Didn't receive the verification code? -->
                                 <!-- <button type="button" class="resendOtp" id="resend-otp">RESEND</button> -->
                                 <!-- <span id="timer"></span>-->
                                 <!--</span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- OTP-Popup -->



    <!-- Sucessfull-Popup -->
    <div class="modal fade forgot-password" id="Sucessfull" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close" onclick="profile_create()"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <img src="{{asset('Influencer/images/sucessfull.png')}}" class="profile_size">
                        <h1>Successful</h1>
                        <p class="pb-3">Your Account has been created successfully.</p>

                        <a href="javascript:void(0)" class="singup-btn okbtn" onclick="profile_create()">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sucessfull-Popup -->











    <!-- youtube-Popup -->
    <div class="modal fade forgot-password" id="youtube_popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <h1>Influencer Verification</h1>
                        <p class="pb-3">Please submit your YouTube Channel's analytics
                            screenshot in today's date to our support team. </p>

                        <div class="upload_box">
                            <a href="#"><i class="fas fa-cloud-upload-alt"></i>
                                <p>Upload</p>
                            </a>

                        </div>

                        <a href="#" class="singup-btn okbtn" data-bs-target="#Profile_verifi" data-bs-toggle="modal" data-bs-dismiss="modal">Ok</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- youtube-Popup -->

    <!-- Profile Verification Popup -->
    <div class="modal fade forgot-password" id="Profile_verifi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <img src="images/profile.png" class="profile_size">
                        <h1>Profile Verification</h1>
                        <p class="pb-3">Your profile will be approved & verified by the TidBid team.
                            We will notify you as soon as possible.</p>

                        <p>In the meantime, you can learn more about TidBid and
                            your upcoming journey as an Influencer.</p>


                        <a href="#" data-bs-toggle="modal" data-bs-target="#profile-verify" class="singup-btn okbtn">Resources</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Verification Popup -->


    <!-- Instagrame-Popup -->
    <div class="modal fade forgot-password" id="insta_popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <h1>Influencer Verification</h1>
                        <p class="pb-3">Please DM below verification code from your
                            Influencer Profile on TidBid's < Instagram>
                                to help us verify your account. </p>

                        <p class="code-text">Verification Code:<a href="#">54323</a></p>

                        <a href="#" class="inst-btn"><img src="images/instagram.png">@TidBid</a>

                        <a href="#" class="singup-btn okbtn">Ok</a>

                        <p>Didn't receive the verification code? <a href="javascript:void(0)"><b>RESEND</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Instagrame-Popup -->


    <!-- Password-Changed-Popup -->
    <div class="modal fade forgot-password" id="profile-verify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <img src="images/profile.png" alt="">
                        <h1 class="mb-0">Congratulations!</h1>
                        <p class="mb-3">Your Influencer Profile is verified and approved.</p>
                        <form action="" class="mb-3">
                            <a href="influencers-home-post-option-2.html" class="ok_btn"> ok</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Password-Changed-Popup -->





</body>

</html>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


//     let otpTimeout;

//     function startTimer(display) {
//     let duration = 120, // 2 minutes (120 seconds)
//         timer = duration,
//         minutes, seconds;

//     $('.resendOtp').hide(); // OTP resend button ko initially hide karna

//     otpTimeout = setInterval(function() {
//         minutes = parseInt(timer / 60, 10);
//         seconds = parseInt(timer % 60, 10);

//         minutes = minutes < 10 ? "0" + minutes : minutes;
//         seconds = seconds < 10 ? "0" + seconds : seconds;

//         display.text(minutes + ":" + seconds); // Timer update karna

//         if (--timer < 0) {
//             clearInterval(otpTimeout);
//             $('.resendOtp').show(); // Jab timer 0 ho jaye, resend button dikhana
//             display.hide(); // Timer hide karna
//         }
//     }, 1000);
// }

// // Function ko call karne ka tarika
// $(document).ready(function() {
//     let display = $('#timer');
//     display.show(); // Ensure karo ki timer show ho raha hai
//     startTimer(display);
// });


  


    // function resendOtp() {
    //     var user_id = $('.userId').val();
    //     if (user_id) {
    //         $.ajax({
    //             url: "{{url('resend-Otp')}}",
    //             method: "GET",
    //             data: {
    //                 user_id: user_id
    //             },
    //             dataType: 'json',
    //             success: function(resp) {
    //                 if (resp.status == 1) {
    //                     $('.otp').text(resp.otp);
    //                     $('.resendOtp').hide();
    //                     $('#timer').show();
    //                     clearInterval(otpTimeout); // Clear any existing timer
    //                     startTimer(10, $('#timer')); // Start a new timer for 2 minutes
    //                 } else {
    //                     alert(resp.message);
    //                 }

    //             }
    //         })
    //     } else {
    //         alert('user id is required');
    //     }
    // }






    $(document).ready(function() {
        // Attach change event listener to checkboxes with class "social"
        $('.social').change(function() {
            // Initialize an empty array to store checked values
            var checkedValues = [];
           

            // Loop through each checked checkbox
            $('.social:checked').each(function() {
                // Push the value of checked checkbox into the array
                checkedValues.push($(this).val());
            });

            // Log the array of checked values (you can do any other operation here)

            if (checkedValues != '') {
                $('.selectedItem').text(checkedValues)
            } else {
                if (socialPlateFrom !== '') {
                    $('.selectedItem').text(socialPlateFrom);
                }
            }

        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.inputs').on('input', function() {

            var inputValue = $(this).val();


            var numericValue = inputValue.replace(/\D/g, '');


            $(this).val(numericValue.slice(0, 1));
        });
    });


    $(document).ready(function() {
        $('.resetotp').click(function() {
            $('.inputs').val('');
        
    
        });
    });
    function getOtp() {
        var userId = $('.userId').val();
        var otp1 = $('.otp1').val();
        var otp2 = $('.otp2').val();
        var otp3 = $('.otp3').val();
        var otp4 = $('.otp4').val();
        var otp5 = $('.otp5').val();
        var otp = otp1 + otp2 + otp3 + otp4 + otp5;
        if (otp != '' && otp2 != '' && otp3 != '' && otp4 != '' && otp5 != '') {

            $.ajax({
                url: "{{'matcheOtp'}}",
                method: 'POST',
                data: {
                    otp: otp,
                    userId: userId
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {

                    console.log(resp);


                    if (resp.status == 1) {
                        $('.otpMessage').text('OTP is Successfully Match').fadeIn().delay(3000).fadeOut();
                        $('#otp-verification').modal('hide');
                        $('#Sucessfull').modal('show');

                    } else if (resp.status == 2) {
                        window.location.href = "{{url('influencer-verification')}}";

                    } else {
                        $('.otpMessage').text('Please Enter Valid OTP').fadeIn().delay(3000).fadeOut();
                    }
                }


            })
        } else {
            $('.otpMessage').text('OTP is Required').fadeIn().delay(3000).fadeOut();
        }

    }

    function profile_create() {
        window.location.href = "{{route('Influencer_My_Profile')}}";
    }

    // function RegisterInfu() {

    //     var userName = $('#userName').val();
    //     var email = $('#email').val();
    //     var password = $('#password').val();
    //     var refer_code = $('#refer_code').val();
    //     var favorite = [];
    //     $.each($("input[class='social']:checked"), function() {
    //         favorite.push($(this).val());
    //     });
    //     $('.selectedItem').text('Social')
    //     var socialPlateFrom = favorite.join(",");


    //     $('.text-danger').text('');


    //     var inputErrors = false;
    //     if (userName.trim() === '') {
    //         $('#userNameError').text('Please enter your username.');
    //         inputErrors = true;
    //     }
    //     if (email.trim() === '') {
    //         $('#emailError').text('Please enter your email and mobile number.');
    //         inputErrors = true;
    //     }

    //     if (password.trim() === '') {
    //         $('#passwordError').text('Please enter your password.');
    //         inputErrors = true;
    //     }

    //     if (socialPlateFrom.trim() === '') {
    //         $('#checkboxError').text('Please Select Social Platform .');
    //         inputErrors = true;
    //     }

    //     if (inputErrors) {
    //         return;
    //     }

    //     if (!$('.agree').prop('checked')) {
    //         $('.agree_message').text('Please agree to our Terms & Conditions and Privacy Policy.');
    //         return;
    //     }

    //     $.ajax({
    //         url: "{{'influencer-Sign-Up'}}",
    //         method: 'post',
    //         data: {
    //             userName: userName,
    //             email: email,
    //             password: password,
    //             socialPlateFrom: socialPlateFrom,
    //             refer_code: refer_code,
    //             agree: 1,
              
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
                 
    //             if (response.status == 1) {
                   
    //                 $('#signupform')[0].reset();
    //                 $('.selectedItem').text('Social');
    //                 $('.otp').text(response.otp);
    //                 $('.userId').val(response.user_id)
    //                 $('.text-danger').text('');
    //                 $('#otp-verification').modal('show');
    //             } else {
    //                 alert(response.error);
    //             }
    //         },
    //         error: function(xhr) {
    //             if (xhr.status == 422) {
    //                 $.each(xhr.responseJSON.errors, function(key, value) {
    //                     $('#' + key + 'Error').text(value[0]);
    //                 });
    //             } else {
    //                 alert('Something went wrong. Please try again.');
    //             }
    //         }
    //     });
    // }
    
    
    function RegisterInfu() {
    var userName = $('#userName').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var refer_code = $('#refer_code').val();
    var favorite = [];

    $.each($("input[class='social']:checked"), function() {
        favorite.push($(this).val());
    });

    var socialPlateFrom = favorite.join(",");

    $('.text-danger').text('');
    var inputErrors = false;

    if (userName.trim() === '') {
        $('#userNameError').text('Please enter your username.');
        inputErrors = true;
    }
    if (email.trim() === '') {
        $('#emailError').text('Please enter your email and mobile number.');
        inputErrors = true;
    }
    if (password.trim() === '') {
        $('#passwordError').text('Please enter your password.');
        inputErrors = true;
    }
    if (socialPlateFrom.trim() === '') {
        $('#checkboxError').text('Please Select Social Platform.');
        inputErrors = true;
    }

    if (inputErrors) {
        return;
    }

    if (!$('.agree').prop('checked')) {
        $('.agree_message').text('Please agree to our Terms & Conditions and Privacy Policy.');
        return;
    }

    $.ajax({
        url: "{{'influencer-Sign-Up'}}",
        method: 'post',
        data: {
            userName: userName,
            email: email,
            password: password,
            socialPlateFrom: socialPlateFrom,
            refer_code: refer_code,
            agree: 1,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status == 1) {
                $('.otp').text(response.otp);
                $('.userId').val(response.user_id);
                $('.text-danger').text('');
                $('#otp-verification').modal('show');

                // Form reset mat karna
            } else {
                alert(response.error);
            }
        },
        error: function(xhr) {
            if (xhr.status == 422) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $('#' + key + 'Error').text(value[0]);
                });
            } else {
                alert('Something went wrong. Please try again.');
            }
        }
    });
}



    $(document).ready(function() {
        $('.inputs').on('input', function() {

            var inputValue = $(this).val();


            var numericValue = inputValue.replace(/\D/g, '');

            $(this).val(numericValue.slice(0, 1));
        });
        $('.elipse-wrap').click(function() {
            console.log('hello');
            $('.show-elipse-card').toggle();
        });
    });



</script>

<script>


let otpTimeout;

    function startTimer(duration, display) {
        let timer = duration,
            minutes, seconds;
        otpTimeout = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (--timer < 0) {
                clearInterval(otpTimeout);
                $('.resendOtp').show();
                $('#timer').hide();
            }
        }, 1000);
    }



    function resendOtp() {
        var user_id = $('.userId').val();
        if (user_id) {
            $.ajax({
                url: "{{url('resend-Otp')}}",
                method: "GET",
                data: {
                    user_id: user_id
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 1) {
                        $('.userOtp').text(resp.otp);
                        $('.resendOtp').hide();
                        $('#timer').show();
                        clearInterval(otpTimeout); // Clear any existing timer
                       startTimer(120, $('#timer'));// Start a new timer for 2 minutes
                    } else {
                        alert(resp.message);
                    }

                }
            })
        } else {
            alert('user id is required');
        }
    } 
</script>