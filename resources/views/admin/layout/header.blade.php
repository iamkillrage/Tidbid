<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Admin</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link href="{{asset('admins/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="{{asset('Influencer/images/image_2025_02_05T09_48_41_117Z.png')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="{{asset('admins/css/animation.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admins/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <link href="{{asset('admins/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admins/css/datepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admins/css/responsive.css')}}" rel="stylesheet" type="text/css" />


    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">



    <!-- CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <!-- <i class='bx bxs-smile'></i> -->
            <img src="{{asset('admins/images/Tidbid-images/all-icons/logo.png')}}" alt="">
            <!-- <span class="text">INaholic</span> -->
        </a>
        <ul class="side-menu">
            <li {{Request::is('admin/user-management') ? 'class=active':''}}>
                <a href="{{ url('admin/user-management') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/1.png')}}" alt="">
                    <span class="text">User Management</span>
                </a>
            </li>
            <li {{Request::is('admin/influencer-management') ? 'class=active':''}}>
                <a href="{{ url('admin/influencer-management') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/2.png')}}" alt="">
                    <span class="text">Influencer Management </span>
                </a>
            </li>
            <li {{Request::is('admin/varification-management') ? 'class=active':''}}>
                <a href="{{ url('admin/varification-management') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/3.png')}}" alt="">
                    <span class="text">Verification Management </span>
                </a>
            </li>
            <li {{Request::is('admin/stream-management') ? 'class=active':''}}>
                <a href="{{ url('admin/stream-management') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/4.png')}}" alt="">
                    <span class="text">Stream Management</span>
                </a>
            </li>
            <li {{Request::is('admin/bid-management') ? 'class=active':''}}>
                <a href="{{ url('admin/bid-management') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/5.png')}}" alt="">
                    <span class="text">Bid Management</span>
                </a>
            </li>
            <li {{Request::is('admin/post-management') ? 'class=active':''}}>
                <a href="{{ url('admin/post-management') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/6.png')}}" alt="">
                    <span class="text">Post Management</span>
                </a>
            </li>
            <li {{Request::is('admin/refer-a-friend') ? 'class=active':''}}>
                <a href="{{ url('admin/refer-a-friend') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/7.png')}}" alt="">
                    <span class="text">Refer A Friend</span>
                </a>
            </li>
            <li {{Request::is('admin/terms-condition') ? 'class=active':''}}>
                <a href="{{ url('admin/terms-condition') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/8.png')}}" alt="">
                    <span class="text">Terms & Conditions </span>
                </a>
            </li>
            <li {{Request::is('admin/privacy-policy') ? 'class=active':''}}>
                <a href="{{ url('admin/privacy-policy') }}">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/9.png')}}" alt="">
                    <span class="text">Privacy Policy</span>
                </a>
            </li>

            <li>
                <a href="{{url('admin/admin-login')}}" data-toggle="modal" data-dismiss="modal" data-target="#logout-popup" id="modal">
                    <img src="{{asset('admins/images/Tidbid-images/all-icons/sidebar-icons/10.png')}}" alt="">
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->


    <!-- NAVBAR -->
    <div id="content">
        <nav>
            <i class='bx bx-menu'><i class="fal fa-bars"></i></i>

            <div class="admin-icon">
                <img src="{{asset('admins/images/Tidbid-images/all-icons/admin.png')}}" alt="">
                ADMIN
            </div>
        </nav>
    </div>
    <!-- NAVBAR -->



    <div class="modal fade" id="logout-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpayment-card-form">
                        <form action="{{url('admin/admin-logout')}}" method="GET">
                            @csrf
                            <div class="payment-card-wrap">
                                <img src="{{asset('admins/images/Tidbid-images/all-icons/logout.png')}}" alt="">
                                <p class="pt-2">Are you sure you want to logout?</p>
                                <div class="bottom-action-wrap">
                                    <button type="submit">Logout</button>
                                    <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            $('#logout-popup').modal('hide');
        }
    </script>