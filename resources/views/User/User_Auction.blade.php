@extends('User.LayoutWebsite.masterwebsite')
@section('content')

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Auction | TidBid</title>
    
    <style>
    .count {
    text-align: center !important; /* Force center alignment */
    font-size: 18px;
    font-weight: bold;
    width: 80px;
    padding: 5px;
    display: block;
    margin: 0 auto; /* Center input field itself if needed */
}


    </style>
</head>

<body>
    <!-- Header-Section -->
    <header>
        @include('User.Navbar.nav')
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>

        <section class="details_sect mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="auction_box">
                            <div class="auction_tag"><img src="{{asset('Influencer/images/active.png')}}"></div>
                            <div class="Auction"><img src="{{asset('Influencer/images/Auctipn-logo.png')}}"></div>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="Action_box">
                            <h3>TidBid Auction</h3>

                            <div class="action_h">
                                <h5>Private 15 mins video call with {{$streamdata->getInfluencer->name ?? ''}}</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>

                            <div class="action_h">
                                <h5>What to expect</h5>
                                <p>{{$streamdata->what_to_expect ? $streamdata->what_to_expect:'' }}.</p>
                            </div>

                            <div class="action_head">
                                <p><b>Base Price :</b><span style="color: green">$</span><span class="base-price" style="color: green">{{$streamdata->baseBidPrice ? $streamdata->baseBidPrice:'' }}</span></p>
                                <p><b>Current Bid :</b><span style="color: green">$</span><span class="bidPrice" style="color: green">{{isset($lastBid->bid_price) ? $lastBid->bid_price:''}}</span>@if(!empty($lastBid->getUser))({{isset($lastBid->getUser->name) ? $lastBid->getUser->name:''}}) @endif</p>
                            </div>


                            <div class="action_head one_row">
                                <p><b>Place Bid :</b></p>
                                <div class="wrap_box">
                                    <button type="button" id="sub" class="sub"><i class="far fa-minus-circle"></i></button>
                                    <input class="count int-only" type="text" value="" min="1" max="100" />
                                    <button type="button" id="add" class="add"><i class="far fa-plus-circle"></i></button>
                                </div>

                            </div>

                            <div class="submit_btn Place2">
                                <a href="javascript:void(0)" data-stramId="" data-infulencer="" class="place-bid" onclick="bidNow('{{$streamdata->influencer_id}}', '{{$streamdata->id}}')">Place Bid</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="container">
            <div class="row">

                <div class="col-lg-12">

                    <div class="bidtext">
                        <h3>{{ $streamdata->streamTitle }}</h3>
                        <p>{{$streamdata->description}} </p>


                    </div>

                    <div class="bidtext pb-5">
                        <h3>Terms and conditions</h3>
                        <p>{{$streamdata->term_and_conditions}}</p>
                        <!-- <ul>
                            <li>Must have added a valid payment option.</li>
                            <li>No offensive words or topics to be used.</li>
                            <li>No Explicit content allowed.</li>
                            <li>Timings of the call will be strictly followed.</li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                        </ul> -->
                    </div>

                </div>
            </div>
        </div>

    </main>
    <!-- Main-Section -->





</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    let toastrShown = false; // Track whether toastr has been shown

    $('.int-only').on('keyup', function() {
        var value = $(this).val();
        
        if (!/^\d*$/.test(value)) { // Check if input contains non-numeric characters
            if (!toastrShown) { // Show toastr only once
                toastr.error('Please enter only numeric values.');
                toastrShown = true; // Prevent multiple toastrs
            }
            $(this).val(value.replace(/\D/g, '')); // Remove non-numeric characters
        } else {
            toastrShown = false; // Reset flag when valid input is entered
        }
    });
});




    //bid now
    function bidNow(infulencer_id, stream_id) {
// Parse bidPrice from input field with class 'count'
var bidPrice = parseFloat($('.count').val());
var basePrice = parseFloat($('.base-price').text());
if ($('.bidPrice').text() != '') {
    basePrice = parseFloat($('.bidPrice').text());
}

// Compare bidPrice with basePrice
if (bidPrice <= basePrice) {
    toastr.error('Please enter a bid price equal to or higher than the base price.');
    return;
}

        if (infulencer_id != '' && stream_id != '' && bidPrice != '') {
            $.ajax({
                url: "{{url('bid-now')}}",
                method: '',
                data: {
                    infulencer_id: infulencer_id,
                    stream_id: stream_id,
                    bid_price: bidPrice,
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 1) {
                        toastr.success(resp.message);
                        window.location.href = "{{url('user-live-stream')}}/" + stream_id;
                    } else {
                        toastr.error(resp.message);
                    }
                }

            })
        } else {
            toastr.error('infulencer data or stream data is missing');
        }

    }





    $(document).ready(function() {
        $('.sub').click(function() {
            try {
                var $input = $(this).siblings('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
            } catch (err) {
                console.error("Unable to decrement:", err);
            }
        });

        $('.add').click(function() {
            try {
                var $input = $(this).siblings('input');
                var count = parseInt($input.val()) + 1;
                $input.val(count);
                $input.change();
            } catch (err) {
                console.error("Unable to increment:", err);
            }
        });
    });
    
//     $(document).ready(function() {
//     function formatBidInput($input) {
//         var value = parseInt($input.val().replace(/\$/g, "")) || 1; // Remove $ and parse as integer
//         $input.val("$" + value); // Add $ sign
//     }

//     $('.sub').click(function() {
//         try {
//             var $input = $(this).siblings('input');
//             var count = parseInt($input.val().replace(/\$/g, "")) - 1;
//             count = count < 1 ? 1 : count;
//             $input.val("$" + count);
//             $input.change();
//         } catch (err) {
//             console.error("Unable to decrement:", err);
//         }
//     });

//     $('.add').click(function() {
//         try {
//             var $input = $(this).siblings('input');
//             var count = parseInt($input.val().replace(/\$/g, "")) + 1;
//             $input.val("$" + count);
//             $input.change();
//         } catch (err) {
//             console.error("Unable to increment:", err);
//         }
//     });

//     $('.count').on("input", function() {
//         formatBidInput($(this));
//     });

//     // Ensure input starts with $
//     $(".count").each(function() {
//         formatBidInput($(this));
//     });
// });

</script>
@endsection