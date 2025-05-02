@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title> Explore Influencers | TidBid</title>
     <link rel="icon" type="image/png" href="https://tidbid.com/Influencer/images/image_2025_02_05T09_48_41_117Z.png">

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
                            <input type="text" name="search" id="search" placeholder="Search by Influencer name" value="{{Request::get('search')??''}}">
                            <button type="button" onclick="stream_search()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">

                        <div class="nav nav-tabs1 mb-5 ">
                            <a href="{{route('user_Explore')}}" class="nav-link1 active">Explore Influencers</a>
                            <a href="{{route('explore_stream')}}" class="nav-link1">Explore Streams</a>
                        </div>
                    </div>

                    <!--itme-->
                    <div class="serchedInfu row">
                        @include('Partial.explore_partial')
                    </div>

                    <!--itme-->



                </div>
            </div>
    </main>
    <!-- Main-Section -->
    <!-- Footer-Section -->
    <!-- @include('Influencer.layout.footer') -->
    <!-- Footer-Section -->

</body>

</html>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // function stream_search($keyword) {
    //     let search = $('#search').val();
    //     window.location.href = '?search=' + search;
    // }
    function scrollToTop() {
            $(window).scrollTop(0);
        }

    $(document).on('click', '.influ-pagi a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var query = '';

        searchData(query, page)
        scrollToTop();
    });

    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            var page = '';
            searchData(query, page)


        });
    });

    function searchData(query, page) {
        $.ajax({
            url: "{{ route('user_Explore') }}",
            type: "GET",
            data: {
                'search': query,
                page: page
            },
            success: function(data) {
                $('.serchedInfu').empty();
                $('.serchedInfu').html(data.html)

            }
        });
    }
</script>