@extends('User.LayoutWebsite.masterwebsite')
@section('content')

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>User Sign Up | TidBid</title>
    
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
        @include('Navbar1.nav1')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </header>
    <!-- Header-Section -->
    @else
        @include('Influencer.layout.header1')
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
                        <div class="sign-in-inner mt-4">
                            <h1>Sign Up</h1>
                            <p>Create an account to explore more!</p>
                            <form id="signupform">

                                <label for="">
                                    Enter your Email
                                    <input type="text" name="email" required id="email" placeholder="enter your email">
                                    <span class="text-danger" id="emailError"></span>
                                </label>
                                <label for="">
                                    Create Password
                                    <div class="password-inner">
                                        <input type="Password" name="password" required placeholder="Password" class="password">
                                        <div class="password-eye">
                                            <div class="eye eye-close"></div>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="passwordError"></span>
                                    <small class="text-success">One alphanumeric one special symbol minimum 8 characters</small>
                                </label>
                                <button type="button" onclick="RegisterInfu()" class="singup-btn_2 mb-3 mt-3">Sign Up</button>
                                <h2>

                                    <input type="checkbox" name="term_condition" class="agree">
                                    You agree to our <a href="{{route('terms_condition')}}">Terms & Conditions</a> and <a href="{{route('Privacy_Policy')}}">Privacy Policy.</a>
                                </h2>
                                <span class="text-danger agree_message" style="font-size: small;"></span>
                                <h2>Already have an account?<a href="{{route('User_SignIn')}}"><b>Sign In</b></a> as a
                                    user</h2>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign-In -->
    </main>
    <!-- Main-Section -->


    <!-- OTP-Popup -->
    <div class="modal fade forgot-password" id="otp-verification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close3 resetotp" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <!--<h5>Otp-<span class="otp"></span></h5>-->
                        <h1>Verification Code</h1>
                        <p class="pb-3">Enter OTP code sent to your email ID</p>
                        <form action="" id="inputs">

                            <input type="hidden" value="" class="userId">
                            <div class="otp-verification-input">
                                <input type="number" class="inputs otp1" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp2" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp3" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp4" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" class="inputs otp5" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                            </div>
                            <span class="text-danger otpMessage" style="text-align: center"></span>
                            <input type="button" value="Submit" onclick="getUserOtp()"></form>
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
                <button type="button" class="btn-close btn-close3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="forgot-password-in">
                        <img src="{{asset('Influencer/images/sucessfull.png')}}" class="profile_size">
                        <h1>Successful</h1>
                        <p class="pb-3">Your Account has been created successfully.</p>
                        <a href="{{route('User_Profile')}}" class="singup-btn okbtn">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sucessfull-Popup -->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
// <script>
//     let otpTimeout;

//   function startTimer(display) {
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



//     function resendOtp() {
//         var user_id = $('.userId').val();
//         if (user_id) {
//             $.ajax({
//                 url: "{{url('resend-Otp')}}",
//                 method: "GET",
//                 data: {
//                     user_id: user_id
//                 },
//                 dataType: 'json',
//                 success: function(resp) {
//                     if (resp.status == 1) {
//                         $('.otp').text(resp.otp);
//                         $('.resendOtp').hide();
//                         $('#timer').show();
//                         clearInterval(otpTimeout); // Clear any existing timer
//                         startTimer(10, $('#timer')); // Start a new timer for 2 minutes
//                     } else {
//                         alert(resp.message);
//                     }

//                 }
//             })
//         } else {
//             alert('user id is required');
//         }
//     }
// </script>
<script>
        $(document).ready(function() {
        $('.resetotp').click(function() {
            $('.inputs').val('');
        
    
        });
    });
    function getUserOtp() {
            // alert("dlgjdfgj");
        var userId = $('.userId').val();
        var otp1 = $('.otp1').val();
        var otp2 = $('.otp2').val();
        var otp3 = $('.otp3').val();
        var otp4 = $('.otp4').val();
        var otp5 = $('.otp5').val();
        if (otp != '' && otp2 != '' && otp3 != '' && otp4 != '' && otp5 != '') {
            var otp = otp1 + otp2 + otp3 + otp4 + otp5;
            $.ajax({
                url: "{{route('UserOtpVerify')}}",
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
                    if (resp.status == 1) {

                        $('.otpMessage').text('OTP is Successfully Match');
                        $('#otp-verification').modal('hide');
                        $('#Sucessfull').modal('show');
                        // setTimeout(function() {
                        //     window.location.href = "{{ route('User_Profile') }}";
                        // }, 3000);

                        //   window.location.href = "{{route('User_Profile')}}";
                    } else {
                        $('.otpMessage').text('Please Enter Valid OTP');
                    }
                }
            })
        } else {
            $('.otpMessage').text('OTP is Required');
        }
    }
//     $('#inputs1').on('show.bs.modal', function (e) {
//     $('.otp1').val('');
//     $('.otp2').val('');
//     $('.otp3').val('');
//     $('.otp4').val('');
//     $('.otp5').val('');
// });

    </script>
    <script>
    function RegisterInfu() {
        
        var email = $('#email').val();
        var password = $('.password').val();


        $('.text-danger').text('');

        var inputErrors = false;
               
                if (email.trim() === '') {
                $('#emailError').text('Please enter your email.');
                inputErrors = true;
                }

                if (password.trim() === '') {
                $('#passwordError').text('Please enter your password.');
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
            url: "{{route('user-registration2')}}",
            method: 'POST',
            data: {

                email: email,
                password: password,
                agree: 1

            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                    
                if (response.status == 1) {
                    $('.otp').text(response.otp);
                    $('.userId').val(response.user_id);
                    $('.text-danger').text('');
                    $('#otp-verification').modal('show');
                } else {
                    alert(response.error);
                }

                // Reset form after successful submission
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
        })

    }

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

@endsection