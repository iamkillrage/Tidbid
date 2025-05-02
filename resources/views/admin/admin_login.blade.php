@extends('Layout.master')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{asset('Influencer/images/image_2025_02_05T09_48_41_117Z.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
        <link href="{{asset('admins/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
        <link href="{{asset('admins/css/animation.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admins/css/custom.css')}}" rel="stylesheet" type="text/css" />
       

        <link href="{{asset('admins/css/style.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
</head>

<body>
    <div class="tidbid-wrap">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <!-- Inner-wrap -->
                    <div class="tidbid-inner-wrap">
                        <div class="tidbid-logo">
                            <div class="tidbid-wrap-logo">
                                <img src="{{asset('admins/images/Tidbid-images/all-icons/tidbid-logo.svg')}}">
                                <!-- <h1>INaholic</h1> -->
                            </div>
                        </div>
                        <div class="tidbid-form">
                            <form method="POST">
                                @csrf
                                <h1>Admin Login</h1>

                                 <div class="errorMessage"></div>

                                <div>
                                    <label for="">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/login-user.svg')}}" alt="" class="src">
                                        <input type="text" name="email" class="email" value="@if(isset($_COOKIE["email"])){{$_COOKIE["email"]}}@endif" placeholder="Enter Email">
                                    </label>
                                </div>

                                <div>
                                    <label for="">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/login-pass-icon.svg')}}" alt="" class="src">
                                        <input type="password" name="password" class="password" placeholder="Enter Password"  value="@if(isset($_COOKIE["password"])){{ $_COOKIE["password"] }}@endif" id="password">
                                        <i class="fas fa-eye-slash" id="eye"></i>
                                    </label>
                                </div>


                                <label for="remember" class="tidbid-login-labl">
                                    <input type="checkbox" 
                                    
                                    @if(isset($_COOKIE["email"]))  checked  @endif
                                    class="login-rmb" id="remember" name="remember">Remember
                                    me</label>
                                <!-- <input type="submit" class="login-btn" value="Sign In"> -->
                                <button type="button" onclick="checkAuth()" value="Sign In" class="singup-btn_2 mb-3 mt-3 checkauth">Login</button>
                            </form>
                        </div>
                    </div>
                    <!-- Inner-wrap -->



                </div>
            </div>
        </div>
    </div>


    <!-- Login succesfull -->
    <div class="modal fade" id="login-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content-front clearfix">
                <div class="modal-body">

                    <!-- login-sucess-wrap -->
                    <div class="login-suceess-form-wrap">
                        <form>
                            <div class="login-suceess-wrap">
                                <img src="{{asset('admins/images/Tidbid-images/all-icons/logi-success-icon.svg')}}" alt="">
                                <h3>Login successful</h3>
                                <p class="pt-2">Welcome to TidBid admin panel!</p>
                            </div>

                            <div class="centered-btn-wrap text-center w-100">
                                <a href="{{ url('admin/user-management') }}" class="common-btn-front">Ok</a>

                            </div>
                        </form>
                    </div>
                    <!-- login-sucess-wrap -->

                </div>
            </div>
        </div>
    </div>

    <!-- Login succesfull -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('admins/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admins/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('admins/js/animation.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



//     <script type="text/javascript">
//         function checkAuth(e) {
//             var email = $('.email').val();
//             var password = $('.password').val();
//             $('.checkauth').text('....Please wait');
//             if (email && password) {
//                 if ($('#remember').prop("checked") == true) {
//                     var remembereme = 1;
//                 } else if ($('#remember').prop("checked") == false) {
//                     var remembereme = 0;
//                 }
                
//                 ///	alert($('.rememberMe').prop("checked"))
//                 $.ajax({
//                     type: 'post',
//                     url: "{{url('admin/admin-sign-in')}}",
//                     data: {
//                         email:email,
//                         password:password,
//                         remembereme:remembereme
//                     },
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },
//                     beforeSend: function() {
//                         $('.checkauth').text('....Please wait');
//                     },
//                     // success: function(response) {
//                     //     if (response.status == 1) {
//                     //         toastr.success(response.message);
//                     //         $("#login-success").modal('show');
//                     //     } else {
//                     //         $('.errorMessage').html('<div class="alert alert-danger" role="alert">' + response.message + '!</div>');
//                     //         $('.checkauth').text('Sign In');

//                     //     }

//                     // }
//                     success: function(response) {
//     if (response.status == 1) {
//         toastr.success(response.message);
//         $("#login-success").modal('show');
//     } else {
//         var errorMsg = '<div class="alert alert-danger error-alert" role="alert">' + response.message + '!</div>';
//         $('.errorMessage').html(errorMsg);
//         $('.checkauth').text('Sign In');

//         // Error message ko 3 second ke baad fade out karne ka function
//         setTimeout(function() {
//             $('.error-alert').fadeOut();
//         }, 3000);
//     }
// }

//                 });

//             } else {
//                 toastr.error("Email & password field are required!");
//               // $('.errorMessage').html('<div class="alert alert-danger" role="alert">Email & password field are required!</div>');

//                 $('.checkauth').text('Sign In');

//             }

//         }
//     </script>

<script type="text/javascript">
        var errorShown = false; // Toastr show hone ka flag
    
        function checkAuth(e) {
            var email = $('.email').val();
            var password = $('.password').val();
            $('.checkauth').text('....Please wait');
    
            if (email && password) {
                var remembereme = $('#remember').prop("checked") ? 1 : 0;
    
                $.ajax({
                    type: 'post',
                    url: "{{url('admin/admin-sign-in')}}",
                    data: {
                        email: email,
                        password: password,
                        remembereme: remembereme
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        $('.checkauth').text('....Please wait');
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            toastr.success(response.message);
                            $("#login-success").modal('show');
                            errorShown = false; // Success hone ke baad error flag reset kar do
                        } else {
                            if (!errorShown) { // Agar pehle error show nahi hua toh hi show karo
                                toastr.error(response.message);
                                errorShown = true;
                            }
                            $('.errorMessage').html('<div class="alert alert-danger" role="alert">' + response.message + '!</div>').fadeIn().delay(3000).fadeOut(500);
                            $('.checkauth').text('Sign In');
                        }
                    } 
                });
            } else {
                if (!errorShown) { // Agar pehle error show nahi hua toh hi show karo
                    toastr.error("Email & password field are required!");
                    errorShown = true;
                }
                $('.checkauth').text('Sign In');
            }
        }
    
        // Jab user input change kare, error flag reset kar do
        $('.email, .password').on('input', function () {
            errorShown = false;
        });
    </script>


  




</body>

</html>
@endsection