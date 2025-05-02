@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers Explore Streams | TidBid</title>
</head>

<style>
    .stream_btn22 {
        width: 100%;
    }

    .stream_btn22 button {
        font-size: 14px;
        font-weight: 500;
        color: #D31E90;
        margin-bottom: 8px;
        margin-top: 3px;
        border: 2px solid rgb(211, 30, 144);
        padding: 6px 20px;
        border-radius: 0px 15px;
        width: 100%;
        background: none;
    }
</style>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
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
                            <input type="text" name="search" class="search-streem" id="search" placeholder="Search by stream name" value="{{Request::get('search')??''}}">
                            <button type="button" onclick="stream_search()"><i class="fa fa-search"></i></button>
                        </div>

                        <div class="broker-date">
                            <input type="text" name="datefilter" id="datefilter" placeholder="Date Range" readonly>
                            <button type="button" onclick="data_filter_click()"></button>
                        </div>
                    </div>
                </div>

                <div class="">

                    <div class="col-md-12">

                        <div class="nav nav-tabs1 mb-5 ">
                            <a href="{{route('Influencer_Explore')}}" class="nav-link1 ">Explore Influencers</a>
                            <a href="{{route('Influencer_Explore_Stream')}}" class="nav-link1 active">Explore
                                Streams</a>
                        </div>
                    </div>

                    <!--item-->
                    <div class="explore_stream row">
                        @include('Influencer.partial-page.Influencer_Explore_Stream_partial')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // function notifyMe(id){
    //     if(id){
    //       $.ajax({
    //            url:"{{url('notifyMe')}}",
    //            method:'GET',
    //            data:{stream_id:id},
    //            dataType:'json',
    //            success:function(resp){
    //               if(resp.status == 1){
    //                 $('#changeButton_'+id).html('<a href="javascript:void(0)" data-id="' + id + '" onclick="notifyMe(' + id + ')" class="notify_btn notifyMe">Subscribed</a>');
    //                 toastr.success(resp.message);
    //               } else {
    //                 toastr.error(resp.message);
    //               }

    //            }
    //       })
    //     } else {
    //       toastr.error('input field are required');
    //     }
    //    }


    // $(document).ready(function() {
    //   $(".notifyMe").click(function() {
    //     var button = $(this);
    //     var streamId = button.data("id");

    //     if (!localStorage.getItem("subscribed_" + streamId)) {
    //       localStorage.setItem("subscribed_" + streamId, "true");
    //       button.text("Subscribed");
    //       showNotification("You are now subscribed to notifications for Stream ");
    //     } else {
    //       localStorage.removeItem("subscribed_" + streamId);
    //       button.text("Notify ");
    //       showNotification("You have Notify from notifications for Stream ");
    //     }

    //   });

    //   $(".notifyMe").each(function() {

    //     var button = $(this);
    //     var streamId = button.data("id");

    //     if (localStorage.getItem("subscribed_" + streamId)) {
    //       button.text("Subscribed");
    //     }
    //     else {
    //       localStorage.removeItem("subscribed_" + streamId);
    //       button.text("Notify Me");
    //     }
    //   });

    //   function showNotification(message) {
    //     toastr.success(message);
    //   }

    //   function showNotification(message) {
    //     toastr.success(message);
    //   }
    // });


    function notifyMe(id, events) {
        event.preventDefault(); // Commenting out this line since there's no event parameter in this function

        $.ajax({
            url: "{{ url('notifyMe') }}",
            method: 'GET',
            data: {
                stream_id: id,
                events: events
            },
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 1) {
                    $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMe(' + resp.id +
                        ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
                    toastr.success(resp.message);
                } else if (resp.status == 2) {
                    $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMe(' + resp.id +
                        ', \'Subscribe\')" class="notify_btn notifyMe" >Notify Me</a>');
                    toastr.success(resp.message);
                } else {
                    toastr.error(resp.message);
                }
                // location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); // Log any errors for debugging purposes
            }
        });
    }




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

    function searchStreem(search, page, type, eventdate) {
        $.ajax({
            url: "{{url('influencer-explore-stream-ajax')}}",
            type: 'GET',
            data: {
                search: search,
                page: page,
                type: type,
                eventdate: eventdate
            },
            success: function(data) {
                $('.explore_stream').html(data);
            }
        })
    }
</script>
@endsection