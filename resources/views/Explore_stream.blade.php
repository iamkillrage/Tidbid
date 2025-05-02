@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
   <link rel="icon" type="image/png" href="https://tidbid.com/Influencer/images/image_2025_02_05T09_48_41_117Z.png">
  <title> Explore Stream | TidBid</title>


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
              <h1>Explore Streams</h1>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="main_influncer">
      <div class="container">
        <div class="row">
          <div class="outer-section">
            <div class="dropdown">Filter by :
              <button class="btn pink_button dropdown-toggle change_text" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="toggelDrop()">
                <img src="{{asset('Influencer/images/camera.png')}}">
                Live Streams <i class='fas fa-chevron-down'></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item stream-type" data-type="Live_Streams" href="javascript:void(0)">Live Streams</a></li>
                <li><a class="dropdown-item stream-type" data-type="Upcoming_Streams" href="javascript:void(0)">Upcoming Streams</a></li>
              </ul>
            </div>

            <div class="search">
              <input type="text" name="search" class="search-streem" placeholder="Search by Influencer name" value="{{Request::get('search')??''}}">
              <button type="button" onclick="stream_search()"><i class="fa fa-search"></i></button>
            </div>

            <div class="broker-date">
              <input type="text" name="datefilter" id="datefilter" placeholder="Date Range" readonly>
              <button type="button" onclick="data_filter_click()"></button>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="row">

            <div class="col-md-12">

              <div class="nav nav-tabs1 mb-5 ">
                <a href="{{route('user_Explore')}}" class="nav-link1 ">Explore Influencers</a>
                <a href="{{route('explore_stream')}}" class="nav-link1 active">Explore Streams</a>
              </div>
            </div>

            <!--itme-->
            <div class="explore_stream row">
                @include('Partial.explore_stream_partial')
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Main-Section -->

  <!-- Footer-Section -->
  @include('Influencer.layout.footer')
  <!-- Footer-Section -->
</body>

</html>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>


  function scrollToTop() {
            $(window).scrollTop(0);
        }

  function toggelDrop() {
    $('.dropdown-menu').toggle().toggleClass('show');
  }
  $(document).on('click', '.stream-type', function() {
    var type = $(this).attr('data-type');
    console.log('type', type);
    $('.dropdown-menu').removeClass('show');
    $('.dropdown-menu').removeClass('show');
    $('.dropdown-menu').toggleClass('hide');
    var page = '';
    var search = '';
    var eventdate = '';
    searchStreem(search, page, type, eventdate)
  })

  $(document).on('click', '.influ-pagi a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var search = '';
  
    var eventdate = '';
    var type = '';
    searchStreem(search, page, type, eventdate);
    scrollToTop();
  });

  $(document).on('keyup', '.search-streem', function() {
    var search = $('.search-streem').val();
    var page = '';
  
    var eventdate = '';
    var type = '';
    searchStreem(search, page, type, eventdate);
  })

  
  $(document).on('click', '.applyBtn', function() {
    var eventdate = $('.drp-selected').text();

    var page = '';
    var search = '';
    var type = '';
    searchStreem(search, page, type, eventdate)
  })


  $(document).on('click', '.cancelBtn ', function() {
    // $('.drp-selected').text('');
    location.reload(true)
    // var eventdate ='';

    // var page = '';
    // var search = '';
    // var type = '';
    // searchStreem(search, page, type, eventdate)
  })


  function searchStreem(search, page, type, eventdate) {
    $.ajax({
      url: "{{url('Explore-Stream')}}",
      type: 'GET',
      data: {
        search: search,
        page: page,
        type:type,
        eventdate:eventdate
      },
      success: function(data) {
        console.log('data',data);
        $('.explore_stream').html(data.html);
      }
    })
  }


  
  function notifyMee(id, events) {
    // event.preventDefault(); // Commenting out this line since there's no event parameter in this function

    $.ajax({
        url: "{{ url('notifyMee') }}",
        method: 'GET',
        data: { stream_id: id, events: events },
        dataType: 'json',
        success: function (resp) {
            if (resp.status == 1) {
                $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMee(' + resp.id + ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
                toastr.success(resp.message);
            } else if (resp.status == 2) {
                $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMee(' + resp.id + ', \'Subscribe\')" class="notify_btn notifyMe" >Notify Me</a>');
                toastr.success(resp.message);
            }
            // location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown); // Log any errors for debugging purposes
        }
    });
}


</script>