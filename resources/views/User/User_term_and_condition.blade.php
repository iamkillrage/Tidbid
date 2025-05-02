@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Terms and Conditions | TidBid</title>
</head>

<body>

  <!-- Header-Section -->
  <header>
    <!-- NAV-STRIP -->
    @include('User.Navbar.nav')
  </header>
  <!-- Header-Section -->

  <!-- Main-Section -->
  <main>

    <div class="terms_box">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="term_head">Terms and Conditions</h1>
            <div class="termstext">

              <p>{!! $data->discription !!}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Main-Section -->


</html>
@endsection