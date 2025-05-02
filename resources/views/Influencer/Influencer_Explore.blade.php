@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Influencers Explore Influencers | TidBid</title>
</head>

<body>
  <!-- Header-Section -->
  @if(session('user_id') || auth()->check())
  @if(session('user_id'))
  @include('Influencer.layout.header1')
  @elseif(auth()->check())
  @include('User.Navbar.nav')
  @endif
  @else
  @include('Influencer.layout.header')
  {{-- @include('Navbar1.nav1') --}}
  @endif
  <!-- Header-Section -->
  <!-- Main-Section -->
  <main>

    <div class="explore_banner">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 ">
            <div class="influ_text">
              <h1>Explore Influencers</h1>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="main_influncer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="search">
              <input type="text" name="search" class="userSearch" id="search" placeholder="Search by Influencer name">
              <button type="button" onclick="influencer_search()"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-md-12">

            <div class="nav nav-tabs1 mb-5 ">
              <a href="{{route('Influencer_Explore')}}" class="nav-link1 active">Explore Influencers</a>
              <a href="{{route('Influencer_Explore_Stream')}}" class="nav-link1">Explore Streams</a>
            </div>
          </div>

          <!--itme-->
          <div class="influencerdata row">
            @include('Influencer.partial-page.influencer-page')
          </div>
          <!--itme-->
        </div>
      </div>
  </main>
  <!-- Main-Section -->
  <!-- Footer-Section -->
  @include('Influencer.layout.footer')
  <!-- Footer-Section -->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  function scrollToTop() {
    $(window).scrollTop(0);
  }

  $(document).on('click', '.influ-pagi a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var value = '';
    searchInfu(value, page)
    scrollToTop();
  });


  $(document).on('keyup', '.userSearch', function() {

    var value = $('.userSearch').val();
    var page = '';
    searchInfu(value, page)
  });

  function searchInfu(value = '', page = '') {
    $.ajax({
      url: "{{url('Influencer-Explore-ajax')}}", // URL to send the request
      type: "GET", // HTTP method to use
      data: {
        page: page,
        search: value // Data to send with the request
      },
      success: function(data) {
        $('.influencerdata').html(data);
      }
    });
  }
</script>
@endsection