@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>No Save Card | TidBid</title>

</head>

<body>

    <!-- Header-Section -->
    <header>
        @include('User.Navbar.nav')
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>

        <div class="prof_lefsect">
            <div class="container">
                <div class="row">

                    @include('Sidebar.sidebar')

                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="pro_right">

                            <div class="no-cardbox">
                                <img src="{{asset('Influencer/images/add-card.svg')}}">
                                <h3>You have no saved cards</h3>
                                <p>Please add a payment method to
                                    enter TidBid Auction</p>
                                <a href="javascript::">Saved Card</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- Main-Section -->

</body>

</html>
@endsection