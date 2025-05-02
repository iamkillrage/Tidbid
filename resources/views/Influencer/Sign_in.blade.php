@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>influencers Sign In | TidBid</title>

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
                                            <a class="nav-link text-white" href="{{route('Influencer_Explore')}}">Explore</a>
                                        </li>
                                        @if (!session()->has('login_is'))   
                                        <li class="nav-item bg-white text-dark rounded-pill pl-2 pr-2">
                                            <a class="nav-link" href="{{route('SignIn')}}">
                                                Login
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item bg-lightpink text-dark rounded-pill">
                                            <a class="nav-link" href="{{route('User_SignIn')}}">For Users</a>
                                        </li>
                                        @endif
                                        
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
                    <div class="col-lg-6 col-md-6">

                        <div class="sign-in-inner sign_right">
                            <h1>Influencer Login</h1>
                            <p>Enter your credential to access your account.</p>
                            <div class="loginmessages text-danger"></div>
                            <form action="">
                                @csrf
                                <!-- <button><img src="images/user-signin/google-icon.svg" alt=""> Login with Google</button> -->
                                <!-- <div class="or-line"><span>Or</span></div> -->
                                <label for="">
                                    Enter registered email
                                    <input type="text" name="email" class="email" required placeholder="Enter registered email">
                                     <span class="messageData"></span> 
                                    <!-- <span id="emailError" class="text-danger"></span>                          -->
                                </label>
                                <label for="">
                                    Password
                                    <div class="password-inner">
                                        <input type="Password" name="password" required placeholder="Password" class="password">
                                        <div class="password-eye">
                                            <div class="eye eye-close"></div>
                                        </div>
                                    </div>
                                    <span id="passwordError" class="text-danger"></span>

                                </label>
                                <h2 class="justify-content-end"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forgot-password">Forgot Password?</a></h2>
                                <button type="button" value="Sign In" onclick="loginInfu()" class="singup-btn_2   loginInfu">Sign In</button>

                                <h2>Don't have an account? <a href="{{route('SignUp')}}"><b>Sign Up</b></a>as an
                                    influencer</h2>
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

    <!-- Forgot-Password-Popup -->
    <div class="modal fade forgot-password" id="forgot-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="cancel-btn">
                    <button type="button" class="btn-close btn-close2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="forgot-password-in mb-3">
                        <h1>Forgot Password</h1>
                        <p>Forgot your password? We are here to help!</p>
                        <form action="" id="forgotform" class="mt-2">
                            <div class="forgot-password-input mb-3">
                                <input type="text" name="email" id="email" placeholder="Enter registered Email" style="color: #000; background-color: #fff;">
                            </div>
                            <span class="messageData"></span>
                            
                            <input type="submit" value="Submit" class="singup-btn_2  otp-button" data-bs-target="#otp-verification">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot-Password-Popup -->

    <!-- OTP-Popup -->
    <div class="modal fade forgot-password" id="otp-verification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <h1>Verification Code</h1>
                        <p class="pb-3">Enter OTP code sent to your registered email id</p>
                        <!--<h6>OTP - <span class="userOtp"></span></h6>-->
                        <form action="" id="otpverify">
                            @csrf
                            <div class="otp-verification-input">
                                <input type="hidden" name="email" id="email">
                                <input type="hidden" name="userId" id="userId" class="userId">

                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">

                            </div>
                            <span class="text-danger otpMessage" style="text-align: center"></span>
                            <input type="submit" value="Submit" class="singup-btn_2 mb-3 mt-3 " data-bs-target="#reset-password">
                        </form>
                        <span class="d-flex justify-content-center">Didn't receive the verification code? <span class="resendOtp"><a href="javascript:void(0)" onclick="resendOtp()">RESEND</a></span> <span id="timer"></span></p>
                            <!-- <span>Didn't receive the verification code? -->
                            <!--  <button type="button" class="resendOtp" id="resend-otp">RESEND</button> -->
                            <!--  <span id="timer"></span>-->
                            <!--</span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- OTP-Popup -->

    <!-- Reset-Password-Popup -->
    <div class="modal fade forgot-password" id="reset-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in sign-in-inner">
                        <h1 class="mb-0">Reset Password</h1>
                        <p class="pb-3">Set up new password for your account</p>
                        <small class="text-danger reset-password-message"></small>
                        <form action="" id="resetpassword">
                            @csrf
                            <label for="">
                                <input type="hidden" name="userId" class="userId">
                                <div class="password-inner">

                                    <input type="Password" name="password" required placeholder="New Password" class="password">
                                    <span class="text-danger" id="passwordError"></span>
                                    <div class="password-eye">
                                        <div class="eye eye-close"></div>
                                    </div>
                                </div>
                            </label>
                            <label for="">
                                <div class="password-inner">
                                    <input type="Password" placeholder="Confirm New Password" required name="confirm_password" class="password">

                                    <div class="password-eye">
                                        <div class="eye eye-close"></div>
                                    </div>
                                </div>
                                <span class="text-danger" id="confirm_passwordError"></span>

                            </label>
                            <input type="submit" value="Submit" data-bs-target="#password-changed" class="mt-3 mb-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reset-Password-Popup -->

    <!-- Password-Changed-Popup -->
    <div class="modal fade forgot-password" id="password-changed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <img src="{{asset('Influencer/images/user-signin/password-changed-icon.svg')}}" alt="">
                        <h1 class="mb-0">Password Changed!</h1>
                        <p class="mb-3">Your password has been changed successfully.</p>
                        <form action="" class="mb-3">
                            <a href="{{route('SignIn')}}" class="ok_btn"> ok</a>
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


<script>
//     let otpTimeout;

// function startTimer(display) {
//     let duration = 120, // 2 minutes (120 seconds)
//         timer = duration,
//         minutes, seconds;

//     $('.resendOtp').hide(); // OTP resend button ko initially hide karna
//     display.show(); // Timer show karna

//     if (otpTimeout) {
//         clearInterval(otpTimeout); // Pehle se koi timer chal raha ho to usko stop karo
//     }

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
//     startTimer(display); // Initial timer start karna

//     // Resend OTP button click hone par timer restart karna
//     $('.resendOtp').click(function() {
//         startTimer(display); // Dobara timer start karna
//     });
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
    //                     $('.userOtp').text(resp.otp);
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
    $(document).ready(function () {
    
        $('.password').on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                loginInfu();
            }
        });
    });

    function loginInfu() {
        var email = $('.email').val();
        var password = $('.password').val();
        $('.text-danger').text('');
    
        $.ajax({
            url: "{{ route('login') }}",
            method: 'post',
            data: {
                email: email,
                password: password,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 1) {
                    window.location.href = "{{ route('Influencer_index') }}";
                } else if (response.status == 2) {
                    window.location.href = "{{ url('influencer-verification') }}";
                } else if (response.status == 3) {
                   // alert(response.error);
                    $('.loginmessages').text(response.error);
                    //window.location.href = "{{ url('influencer-signIn') }}";
                } else {
                    $('.messageData').text('');
                    $('#passwordError').text('');
                    $('.loginmessages').text(response.error);
                }
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    $('.messageData').html('<span class="text-danger">Please enter email or mobile number</span>');
                    $('#passwordError').text('');
                    $('.loginmessages').text('');
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
        $('#forgot-password').on('hidden.bs.modal', function() {
            $('#forgotform')[0].reset();
            $('.text-danger').text('');
        });

        // $('#forgotform').submit(function(event) {
        //     event.preventDefault();
        //     $('.otp-button').val('Please wait...');
        //     // $('.otp-button').prop('disabled', true);
        //     var email = $('#email').val();

        //     console.log('Email:', email);
        //     if (email != '') {
        //         $.ajax({
        //             url: "{{url('forgot-password')}}",
        //             method: 'POST',
        //             data: {

        //                 email: email
        //             },
        //             dataType: 'json',
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(resp) {
        //                 if (resp.status == 1) {
        //                     $('.otp-button').val('Submit');
        //                     $('.otp-button').prop('disabled', false);
        //                     $('#forgot-password').modal('hide');

        //                     $('#otp-verification').modal('show');
        //                     $('#userId').val(resp.user_id);
        //                     $('.userOtp').text(resp.otp);



        //                 } else {
        //                     $('.otp-button').val('Submit');
        //                     $('.otp-button').prop('disabled', false);
        //                     $('.messageData').html('<span class="text-danger">' + resp.message + '!</span>')

        //                     //alert(resp.message);
        //                 }
        //             }
        //         })
        //     } else {
        //         $('.messageData').html('<span class="text-danger">Please enter email or mobile number</span>')
        //     }

        // });
        
         $('#forgotform').submit(function(event) {
    event.preventDefault();
    
    var email = $('#email').val();
    
    $('.messageData').html(''); // Pehle error hata do
    if (email == '') {
        $('.messageData').html('<span class="text-danger">Please enter email or mobile number</span>').fadeIn().delay(3000).fadeOut();
        return false; // Stop form submission
    }

    $('.otp-button').val('Please wait...');
    $('.otp-button').prop('disabled', true);

    $.ajax({
        url: "{{url('forgot-password')}}",
        method: 'POST',
        data: { email: email },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp) {
            $('.otp-button').val('Submit');
            $('.otp-button').prop('disabled', false);

            if (resp.status == 1) {
                $('#forgot-password').modal('hide');
                $('#otp-verification').modal('show');
                $('#userId').val(resp.user_id);
                $('.userOtp').text(resp.otp);
            } else {
                $('.messageData').html('<span class="text-danger">' + resp.message + '!</span>').fadeIn().delay(3000).fadeOut();
            }
        }
    });
});

        
        $('#forgot-password').on('hidden.bs.modal', function() {
            $('#otpverify')[0].reset();
        });
        $('#otpverify').submit(function(e) {
            e.preventDefault();
            //   alert('hi');
            $('.otp-button').val('Please wait...');
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('verifyotp') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 1) {
                        $('.otp-button').val('Submit');
                        $('.userId').val(response.user_id);
                        $('#otp-verification').modal('hide');
                        $('#reset-password').modal('show');
                    } else {
                        $('.otp-button').val('Submit');
                        $('.otpMessage').text(response.error);
                    }
                },

                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                }
            });

        });
        $('#forgot-password').on('hidden.bs.modal', function() {
            $('#resetpassword')[0].reset();
        });
        $('#resetpassword').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('resetpasswordconfirm') }}",
                type: 'POST',
                data: formData,
                success: function(success) {
                    if (success.status != 'error') {
                        $('.password').val(success.password);
                        $('#reset-password').modal('hide');
                        $('#password-changed').modal('show');
                    } else {
                        $('.reset-password-message').text(success.message);
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
        });

    });


    $(document).ready(function() {
        $('.inputs').on('input', function() {

            var inputValue = $(this).val();


            var numericValue = inputValue.replace(/\D/g, '');


            $(this).val(numericValue.slice(0, 1));
        });
    });
</script>

<script>
//   let otpInterval; // Timer ko track karne ke liye global variable

//   function startTimer(duration, display, resendButton) {
//     let timer = duration;
    
//     clearInterval(otpInterval); // Purana timer clear karo

//     resendButton.setAttribute("disabled", "true"); // ✅ Button disable karo
//     resendButton.classList.add("disabled-link");

//     otpInterval = setInterval(function () {
//       let minutes = Math.floor(timer / 60);
//       let seconds = timer % 60;

//       display.textContent = `${minutes < 10 ? "0" : ""}${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
//       display.style.color = "black";

//       if (--timer < 0) {
//         clearInterval(otpInterval);
//         display.textContent = ''; // ✅ Timer hide ho jaye
//         resendButton.removeAttribute("disabled"); // ✅ Button enable ho jaye
//         resendButton.classList.remove("disabled-link");
//       }
//     }, 1000);
//   }

//   function initializeOtpTimer() {
//     const resendButton = document.getElementById('resend-otp');
//     const timerDisplay = document.getElementById('timer');

//     if (resendButton && timerDisplay) {
//       resendButton.setAttribute("disabled", "true"); // ✅ Button disable kare
//       resendButton.classList.add("disabled-link");

//       startTimer(120, timerDisplay, resendButton); // 2 min ka timer start kare
//     } else {
//       console.error("Resend button ya timer display nahi mila!");
//     }
//   }

//   document.addEventListener("DOMContentLoaded", function () {
//     const modal = document.getElementById('otp-verification');

//     if (modal) {
//       modal.addEventListener('shown.bs.modal', function () {
//         initializeOtpTimer();
//       });
//     } else {
//       console.error("Modal ID 'otp-verification' nahi mila!");
//     }

//     const resendButton = document.getElementById('resend-otp');
//     if (resendButton) {
//       resendButton.addEventListener('click', function () {
//         resendOtp();
//       });
//     } else {
//       console.error("Resend button ID 'resend-otp' nahi mila!");
//     }
//   });

//   function resendOtp() {
//     var user_id = document.querySelector('.userId') ? document.querySelector('.userId').value : null;
//     const resendButton = document.getElementById('resend-otp');
//     const timerDisplay = document.getElementById('timer');

//     if (user_id) {
//       fetch("{{url('resend-Otp')}}?user_id=" + user_id)
//         .then(response => response.json())
//         .then(resp => {
//           if (resp.status == 1) {
//             document.querySelector('.userOtp').textContent = resp.otp;
//             timerDisplay.style.display = "inline";

//             clearInterval(otpInterval);

//             resendButton.setAttribute("disabled", "true"); // ✅ Button disable kare
//             resendButton.classList.add("disabled-link");

//             startTimer(120, timerDisplay, resendButton); // ✅ 2 min ka naya timer start kare
//           } else {
//             alert(resp.message);
//           }
//         })
//         .catch(error => console.error("Error:", error));
//     } else {
//       alert('User ID is required');
//     }
//   }

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
                        startTimer(120, $('#timer')); // Start a new timer for 2 minutes
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