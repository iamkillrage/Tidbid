@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Payment Method | TidBid</title>

</head>

<body>
    <!-- Header-Section -->
    @include('Influencer.layout.header1')
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>
        <div class="prof_lefsect">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="profile_left">
                            <ul>
                                <li {{Request::is('influencer-my-profile') ? 'class=pro_active':''}}>
                                    <img src="{{asset('Influencer/images/my-profile.svg') }}"><a
                                        href="{{route('Influencer_My_Profile')}}">My Profile</a>
                                </li>
                                <li {{Request::is('influencer-saved-bank') ? 'class=pro_active':''}}>
                                    <img src="{{asset('Influencer/images/Payment.svg') }}"><a
                                        href="{{route('Influencer_Saved_Bank')}}">Payment Method</a>
                                </li>
                                <li {{Request::is('influencer-my-transactions') ? 'class=pro_active':''}}>
                                    <img src="{{asset('Influencer/images/Payment.svg') }}"><a
                                        href="{{route('Influencer_My_Transaction')}}">My Transactions</a>
                                </li>
                                <li {{Request::is('influencer-refer-a-friend') ? 'class=pro_active':''}}>
                                    <img src="{{asset('Influencer/images/Refer.svg') }}"><a
                                        href="{{route('Refer_A_Friend')}}">Refer a Friend</a>
                                </li>
                                <li {{Request::is('influencer-saved-bank') ? 'class=pro_active':''}}>
                                    <img src="{{asset('Influencer/images/chat.svg') }}"><a
                                        href="{{url('influencer-chat/{id}')}}">Chats</a>
                                </li>
                                <li {{Request::is('influencer_bookmark') ? 'class=pro_active':''}}>
                                    <img src="{{asset('Influencer/images/bookmark.png')}}" class=""><a
                                        href="{{route('Influencer_Bookmark')}}" class="p-0">Bookmarks</a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_3">
                                        <img src="{{asset('Influencer/images/logout.svg')}}" alt="">
                                        <span class="text">Logout</span>
                                    </a>
                                    {{-- <img src="{{asset('Influencer/images/logout.svg')}}"><a href="#"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal_3">Logout</a> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="pro_right">
                            <div class="no-cardbox">
                                <img src="{{asset('Influencer/images/bank-line.png')}}">
                                <h3>You have no saved Bank.</h3>
                                <p>Please add a payment method to
                                    enter TidBid Auction</p>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_1">Add Bank</a>
                            </div>
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

    <!-- Add Bank Popup -->
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>
                <form id="savebank" method="get">
                    @csrf
                    <div class="modal-body pt-0 pb-5 ">
                        <h1 class="modal-title text-center report-h5">Add Bank</h1>
                        <div class="card_filde">
                            <label>Bank Name</label>
                            <input type="text" name="bank_name" id="bank" required placeholder="Bank of America">
                        </div>
                        <div class="card_filde card-clas">
                            <label>Bank Account Number</label>
                            <input type="text" name="account_no" id="account_no" required
                                placeholder="xxxx xxxx xxxx 1234">
                        </div>
                        <div class="card_filde cvv">
                            <label>Routing No. </label>
                            <input type="text" name="routing_no" id="routing_no" placeholder="081090">
                        </div>
                        {{-- <div class="cardbtn"><a href="#">Submit</a></div> --}}
                        <button type="submit">Submit
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Add Bank Popup -->

    <!-- logout Popup -->
    <div class="modal fade" id="exampleModal_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
                        class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0 pb-5 ">
                    <div class="succes_box">
                        <img src="{{asset('Influencer/images/logout2.png')}}">
                        <h3>Do you want to logout?</h3>
                        <div class="cardbtn"><a href="{{route('SignIn')}}" class="Ok_btn">Ok</div>
                        {{-- <button type="button" class="cardbtn">Ok</button> --}}
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!--logout Popup-->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#savebank').submit(function(e) {
        e.preventDefault();

        var bank_name = $("input[name='bank_name']").val();
        var account_no = $("input[name='account_no']").val();
        var routing_no = $("input[name='routing_no']").val();

        $.ajax({
            url: "{{ route('Influencer_Add_Bank') }}",
            type: 'GET',
            data: $(this).serialize(),
            success: function(response) {
                //     $('#exampleModal_1').modal('hide'); // Hide the modal
                // $('.pro_right').html(response);
                window.location.href = "{{route('Influencer_Saved_Bank')}}";

                // $('.no-cardbox').hide();
                // // Show all account tabs
                // $('.cardouter').show();`
            },
            error: function(xhr, status, error) {

                console.error(xhr.responseText);
            }
        });
    });
});
</script>