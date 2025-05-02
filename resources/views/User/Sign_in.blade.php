@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
     <link rel="icon" type="image/png" href="https://tidbid.com/Influencer/images/image_2025_02_05T09_48_41_117Z.png">
    <title>User Sign In | TidBid</title>
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
                        <div class="sign-in-inner sign_right">
                            <h1>Sign In</h1>
                            <p>Enter your credential to access your account.</p>
                            <div class="errorMessage"></div>

                            <form method="POST" action="{{ route('Userlogin') }}">

                                <label for="">
                                    Email address
                                    <input type="text" name="email"  required id="email" placeholder="enter your email">
                                    <span class="text-danger" id="emailError"></span>
                                </label>
                                <label for="">
                                    Password
                                    <div class="password-inner">
                                        <input type="Password" name="password" id="password" required placeholder="Password" class="password">
                                       
                                        <div class="password-eye">
                                            <div class="eye eye-close"></div>
                                        </div>
                                    </div>
                                  
                                    <span class="text-danger" id="passwordError"></span>
                                </label>
                              
                                <h2 class="justify-content-end"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forgot-password">Forgot Password?</a></h2>

                                <button type="button" onclick="checkAuth()" class="singup-btn_2 mb-3 mt-3">Sign In</button>
                                <h2>Don't have an account? <a href="{{ route('User_SignUp') }}"><b>Sign Up</b></a> as a user</h2>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign-In -->
    </main>
    <!-- Main-Section -->


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

                        <form id="forgotform" class="mt-2">
                        <div class="messageData" style="top: 50%; left: 50%; text-align: center;"></div>
                            <div class="forgot-password-input mb-3">
                                <input type="text" name="email" class="usermail" id="email" placeholder="Enter registered Email" style="color: #000; background-color: #fff;">
                            </div>
                           
                            <input type="submit" value="Submit" class="singup-btn_2 mb-3 mt-3" data-bs-target="#otp-verification">
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
                        <h1>One Time Verification</h1>
                        <p class="pb-3">Enter OTP code sent to your registered email id</p>
                        <!--<h6>OTP - <span class="userOtp"></span></h6>-->
                        <form action="" id="otpverify">
                            @csrf
                            <div class="otp-verification-input">
                                <!-- <input type="hidden" name="email" class="reset_email">
                                <input type="hidden" name="userId" id="userId"  class="userId"> -->
                                <input type="hidden" name="email" id="email">
                                <input type="hidden" name="userId" id="userId" class="userId">

                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                                <input type="number" name="otp[]" class="inputs" maxlength="1" onKeyPress="if(this.value.length==1) return false;">
                            </div>
                           <span class="text-danger otpMessage" style="text-align: center; display: block;"></span>
                            <input type="submit" value="Submit" class="singup-btn_2 mb-3 mt-3" data-bs-target="reset-password">
                        </form>
                        <span class="d-flex justify-content-center">Didn't receive the verification code?<span class="resendOtp" id="resend-otp"><a href="javascript:void(0)" onclick="resendOtp()">RESEND</a></span> <span id="timer"></span></p>
<!--                 <span>Didn't receive the verification code? -->
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
                        <form action="" id="resetpassword">
                            @csrf
                            <label for="">
                                <!-- <input type="hidden" name="email" class="reset_email"> -->
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
                            <a href="{{route('User_Home')}}" class="ok_btn"> OK</a>
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
    $(document).ready(function () {
    
        $('.password').on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                checkAuth();
            }
        });
    });
    function checkAuth() {
        var email = $('#email').val();
        var password = $('#password').val();
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


        //  if (email && password) {
        $.ajax({
            type: 'POST',
            url: "{{ route('Userlogin') }}",
            data: {
                email: email,
                password: password,
                _token: "{{ csrf_token() }}"
            },

            success: function(response) {
                if (response.status == 1) {
                    window.location.href = "{{ route('User_Home') }}";
                } else {
                    if (!$('.toast-error').length) {  // Check if an error toast is already present
                        toastr.error(response.message);
                    }
                    $('.checkauth').text('Sign In');
                }

            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#' + key + 'Error').text('');
                        $('#' + key + 'Error').text(value[0]);
                    });
                } else {
                    // alert('Something went wrong. Please try again.');
                }
            }
        });
       
    }

    $(document).ready(function() {
        $('#forgot-password').on('hidden.bs.modal', function() {
            $('#forgotform')[0].reset();
            $('.text-danger').text('');
    
        });
        $('#forgotform').submit(function(event) {
            event.preventDefault();

            var email = $('.usermail').val();
            $('.text-danger').text('');

            console.log('Email:', email);
            if (email != '') {
                $.ajax({
                    url: "{{route('Userforgotpassword')}}",
                    method: 'POST',
                    data: {

                        email: email
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        if (resp.status == 1) {
                            $('#forgot-password').modal('hide');
                            $('#otp-verification').modal('show');
                            $('#userId').val(resp.user_id);
                            $('.userOtp').text(resp.otp);


                        } else {
                            $('.messageData').html('<span class="text-danger">' + resp.message + '!</span>')
                            //alert(resp.message);
                        }
                    }
                })
            } 
            else {
                $('.messageData').html('<span class="text-danger">Please enter email id</span>')
            }

        });

  
        $('#forgot-password').on('hidden.bs.modal', function() {
            $('#otpverify')[0].reset();
        });
        $('#otpverify').submit(function(e) {
            e.preventDefault();

            
            //   alert('hi');
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('Userresetpassword') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 1) {
                        $('.userId').val(response.user_id);
                        $('#otp-verification').modal('hide');
                        $('#reset-password').modal('show');
                    }
                    else {
                        
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
                url: "{{route('Userresetpasswordconfirm') }}",
                type: 'POST',
                data: formData,
                success: function(success) {
                    if (success.status != 'error') {
                    // Corrected to response.user_id
                    // $('.reset_email').val(response.email);
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
// let otpTimeout;

// function startTimer() {
//     let duration = 120; // 2 minutes (120 seconds)
//     let timer = duration;
//     let minutes, seconds;
//     let display = $('#timer');

//     clearInterval(otpTimeout); // Pehle se chalta timer clear karo

//     $('.resendOtp').hide(); // Resend OTP button hide karo
//     display.show(); // Timer dikhana ensure karo

//     otpTimeout = setInterval(function () {
//         minutes = Math.floor(timer / 60);
//         seconds = timer % 60;

//         minutes = minutes < 10 ? "0" + minutes : minutes;
//         seconds = seconds < 10 ? "0" + seconds;

//         display.text(minutes + ":" + seconds); // Timer update karo

//         if (--timer < 0) {
//             clearInterval(otpTimeout);
//             $('.resendOtp').show(); // Jab timer 0 ho jaye toh Resend button dikhaye
//             display.hide(); // Timer ko hide karna
//         }
//     }, 1000);
// }

// $(document).ready(function () {
//     // Jab modal open ho tabhi timer start karein
//     $('#otpModal').on('shown.bs.modal', function () {
//         $('#timer').text("02:00").show(); // Timer ko initialize karo
//         startTimer(); // Timer start karo
//     });

//     $('.resendOtp').click(function () {
//         clearInterval(otpTimeout); // Pichla timer clear karo
//         $('#timer').text("02:00").show(); // Timer ko reset karke turant update karo
//         startTimer(); // Naya timer turant start karo
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
    </script>
    
<script>
//   let otpInterval; // Timer ko track karne ke liye global variable

// //   function startTimer(duration, display, resendButton) {
// //     let timer = duration;
    
// //     clearInterval(otpInterval); // Purana timer clear karo

// //     resendButton.setAttribute("disabled", "true"); // ✅ Button disable karo
// //     resendButton.classList.add("disabled-link");

// //     otpInterval = setInterval(function () {
// //       let minutes = Math.floor(timer / 60);
// //       let seconds = timer % 60;

// //       display.textContent = `${minutes < 10 ? "0" : ""}${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
// //       display.style.color = "black";

// //       if (--timer < 0) {
// //         clearInterval(otpInterval);
// //         display.textContent = ''; // ✅ Timer hide ho jaye
// //         resendButton.removeAttribute("disabled"); // ✅ Button enable ho jaye
// //         resendButton.classList.remove("disabled-link");
// //       }
// //     }, 1000);
// //   }

// function startTimer(duration, display, resendButton) {
//     let timer = duration;

//     clearInterval(otpInterval); // ✅ Purana timer clear karein

//     resendButton.setAttribute("disabled", "true"); // ✅ Button disable karein
//     resendButton.classList.add("disabled-link");

//     otpInterval = setInterval(function () {
//         let minutes = Math.floor(timer / 60);
//         let seconds = timer % 60;

//         display.textContent = `${minutes < 10 ? "0" : ""}${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
//         display.style.color = "black";

//         if (--timer < 0) {
//             clearInterval(otpInterval);
//             display.textContent = ''; // ✅ Timer hide ho jaye
//             resendButton.removeAttribute("disabled"); // ✅ Button enable ho jaye
//             resendButton.classList.remove("disabled-link");
//         }
//     }, 1000);
// }


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

// //   document.addEventListener("DOMContentLoaded", function () {
// //     const modal = document.getElementById('otp-verification');

// //     if (modal) {
// //       modal.addEventListener('shown.bs.modal', function () {
// //         initializeOtpTimer();
// //       });
// //     } else {
// //       console.error("Modal ID 'otp-verification' nahi mila!");
// //     }

// //     const resendButton = document.getElementById('resend-otp');
// //     if (resendButton) {
// //       resendButton.addEventListener('click', function () {
// //         resendOtp();
// //       });
// //     } else {
// //       console.error("Resend button ID 'resend-otp' nahi mila!");
// //     }
// //   });

// document.addEventListener("DOMContentLoaded", function () {
//     const modal = document.getElementById('otp-verification');

//     if (modal) {
//         modal.addEventListener('shown.bs.modal', function () {
//             initializeOtpTimer();
//         });
//     } else {
//         console.error("Modal ID 'otp-verification' nahi mila!");
//     }

//     const resendButton = document.getElementById('resend-otp');
//     if (resendButton) {
//         resendButton.addEventListener('click', function () {
//             resendOtp();
//         });
//     } else {
//         console.error("Resend button ID 'resend-otp' nahi mila!");
//     }
// });


// //   function resendOtp() {
// //     var user_id = document.querySelector('.userId') ? document.querySelector('.userId').value : null;
// //     const resendButton = document.getElementById('resend-otp');
// //     const timerDisplay = document.getElementById('timer');

// //     if (user_id) {
// //       fetch("{{url('resend-Otp')}}?user_id=" + user_id)
// //         .then(response => response.json())
// //         .then(resp => {
// //           if (resp.status == 1) {
// //             document.querySelector('.userOtp').textContent = resp.otp;
// //             timerDisplay.style.display = "inline";

// //             clearInterval(otpInterval);

// //             resendButton.setAttribute("disabled", "true"); // ✅ Button disable kare
// //             resendButton.classList.add("disabled-link");

// //             startTimer(120, timerDisplay, resendButton); // ✅ 2 min ka naya timer start kare
// //           } else {
// //             alert(resp.message);
// //           }
// //         })
// //         .catch(error => console.error("Error:", error));
// //     } else {
// //       alert('User ID is required');
// //     }
// //   }

// function resendOtp() {
//     var user_id = document.querySelector('.userId') ? document.querySelector('.userId').value : null;
//     const resendButton = document.getElementById('resend-otp');
//     const timerDisplay = document.getElementById('timer');

//     if (user_id) {
//         fetch("{{url('resend-Otp')}}?user_id=" + user_id)
//             .then(response => response.json())
//             .then(resp => {
//                 if (resp.status == 1) {
//                     document.querySelector('.userOtp').textContent = resp.otp;

//                     // ✅ Confirmation message show karein
//                     document.querySelector('.otpMessage').textContent = "OTP sent successfully!";
//                     document.querySelector('.otpMessage').style.color = "green";

//                     // ✅ Timer show karein
//                     timerDisplay.style.display = "inline";

//                     // ✅ Pehle se chalta timer stop karein
//                     clearInterval(otpInterval);

//                     // ✅ Button disable karein
//                     resendButton.setAttribute("disabled", "true");
//                     resendButton.classList.add("disabled-link");

//                     // ✅ 2 min ka naya timer start karein
//                     startTimer(120, timerDisplay, resendButton);
//                 } else {
//                     alert(resp.message);
//                 }
//             })
//             .catch(error => console.error("Error:", error));
//     } else {
//         alert('User ID is required');
//     }
// }

// let otpInterval; // Timer track karne ke liye global variable

// function startTimer(duration, display, resendButton) {
//     let timer = duration;

//     // ✅ Purana timer clear karo
//     clearInterval(otpInterval);

//     // ✅ Button disable karo
//     resendButton.setAttribute("disabled", "true");
//     resendButton.classList.add("disabled-link");

//     otpInterval = setInterval(function () {
//         let minutes = Math.floor(timer / 60);
//         let seconds = timer % 60;

//         display.textContent = `${minutes < 10 ? "0" : ""}${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
//         display.style.color = "black";

//         if (--timer < 0) {
//             clearInterval(otpInterval);
//             display.textContent = ''; // ✅ Timer hide ho jaye
//             resendButton.removeAttribute("disabled"); // ✅ Button enable ho jaye
//             resendButton.classList.remove("disabled-link");
//         }
//     }, 1000);
// }

// function resendOtp() {
//     var user_id = document.getElementById('userId') ? document.getElementById('userId').value : null;
//     const resendButton = document.getElementById('resend-otp');
//     const timerDisplay = document.getElementById('timer');
//     const otpMessage = document.querySelector('.otpMessage');

//     if (!user_id) {
//         alert('User ID is required');
//         return;
//     }

//     fetch("{{url('resend-Otp')}}?user_id=" + user_id)
//         .then(response => response.json())
//         .then(resp => {
//             if (resp.status == 1) {
//                 document.querySelector('.userOtp').textContent = resp.otp;

//                 // ✅ Confirmation message show karo
//                 otpMessage.textContent = "OTP sent successfully!";
//                 otpMessage.style.color = "green";

//                 // ✅ Button disable karo
//                 resendButton.setAttribute("disabled", "true");
//                 resendButton.classList.add("disabled-link");

//                 // ✅ Timer display karo
//                 timerDisplay.style.display = "inline";

//                 // ✅ Purana timer stop karo
//                 clearInterval(otpInterval);

//                 // ✅ 2 min ka naya timer start karo
//                 startTimer(120, timerDisplay, resendButton);
//             } else {
//                 otpMessage.textContent = resp.message;
//                 otpMessage.style.color = "red";
//             }
//         })
//         .catch(error => console.error("Error:", error));
// }

// // ✅ Ensure Modal Initialization is Correct
// document.addEventListener("DOMContentLoaded", function () {
//     const modal = document.getElementById('otp-verification');

//     if (modal) {
//         modal.addEventListener('shown.bs.modal', function () {
//             initializeOtpTimer();
//         });
//     }

//     const resendButton = document.getElementById('resend-otp');
//     if (resendButton) {
//         resendButton.addEventListener('click', function () {
//             resendOtp();
//         });
//     }
// });

// function initializeOtpTimer() {
//     const resendButton = document.getElementById('resend-otp');
//     const timerDisplay = document.getElementById('timer');

//     if (resendButton && timerDisplay) {
//         resendButton.setAttribute("disabled", "true");
//         resendButton.classList.add("disabled-link");

//         startTimer(120, timerDisplay, resendButton);
//     }
// }


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


   