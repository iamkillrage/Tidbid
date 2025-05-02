@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Payment Method | TidBid</title>

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



                    <div class="col-lg-9 col-md-8 col-sm-12 ">
                        <div class="pro_right cardouter">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pro_head">Payment Method</div>
                                </div>
                                @forelse($SaveCard as $row)
                                <div class="col-lg-6 col-md-12" style="padding: 14px;">
                                    <div class="cardbg">

                                        <div class="tagimg">
                                            <div class="tagimg">
                                                @if($row['card_default'] == 'YES')
                                                <img src="{{asset('Influencer/images/primery_tab.png')}}">
                                                @endif
                                            </div>
                                            <div class="card_dropdown">
                                                <div class="dropdown">
                                                    <button class=" dropdown-toggle bor_none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{asset('Influencer/images/dropdown_dot.svg')}}" class="white_dot">
                                                    </button>
                                                    <ul class="dropdown-menu card-ul">
                                                        <li><a class="dropdown-item deleteCard" href="javascript:void(0)" data-cardId="{{$row['id']}}">Delete</a></li>

                                                        @if($row['card_default'] != 'YES')
                                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="setPrimary({{$row['id']}})" data-cardId="{{$row['id']}}">Set as Primary</a></li>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>








                                        </div>

                                        <div class="card_num">
                                            <div class="card_no">**** **** **** {{$row['last4']}}</div>
                                            <div class="valid">
                                                <span>VALID THRU</span>
                                                <p>{{$row['exp_month']}}/{{$row['exp_year']}}</p>
                                            </div>
                                        </div>

                                        <div class="card_num">
                                            <div class="card_name">{{$row['cardholdername']}}</div>
                                            <div class="master_img">
                                                <img src="{{asset('Influencer/images/master_card.png')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty

                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="pro_right">

                                        <div class="no-cardbox">
                                            <img src="{{asset('Influencer/images/add-card.svg')}}">
                                            <h3>You have no saved cards</h3>
                                            <p>Please add a payment method to
                                                enter TidBid Auction</p>

                                        </div>
                                    </div>
                                </div>
                                @endforelse
                                <a href="" data-bs-toggle="modal" class="singup-btn_2 mb-3 mt-3" data-bs-target="#exampleModal_1">Add Card</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>
    <!-- Main-Section -->

    <!-- Add Card  -->
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                @csrf
                <div class="modal-body pt-0 pb-5 ">
                    <h1 class="modal-title text-center report-h5">Add Card </h1>

                    <div class="modal-body">
                        <div class="add-to-card">
                            @foreach (['danger'] as $status)
                            @if(Session::has($status))
                            <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                            @endif
                            @endforeach
                            <div class="text-danger errorMessage"></div>
                            <form role="form" id="paymentForm_1" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Card Holder Name</label>
                                    <input type="name" class="form-control" name="fullName" required id="" placeholder="Card Holder Name">
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Card Number</label>
                                    <div class="master_cardimg">
                                    <img src="{{asset('Influencer/images/master_card.png')}}">
                                    <input type="text" name="cardNumber" class="form-control card-img" required id="cardNumber" placeholder="****    ****    ****    ****" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
                                    </div>
                                </div>
                                <div class="grid-add-card">
                                    <div class="exp-date">
                                        <label for="">Expiry Date</label>
                                        {{-- <input type="text" class="form-control" id="" placeholder="Month / Year"> --}}
                                        <div class="input-group">
                                            <select class="form-control" required name="month">
                                                <option value="">MM</option>
                                                @foreach(range(1, 12) as $month)
                                                <option value="{{$month}}">{{$month}}</option>
                                                @endforeach
                                            </select>
                                            <select class="form-control" required name="year">
                                                <option value="">YYYY</option>
                                                @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                <option value="{{$year}}">{{$year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="exp-pass">
                                        <label for="">CVV</label>
                                        <input type="password" class="form-control" minlength="3" maxlength="3" name="cvv" required id="cvv" placeholder="***">
                                    </div>
                                </div>
                                {{-- <a class="btn submit-add-card mt-3 mb-2"> ADD CARD </a> --}}
                                <button class="singup-btn_2 mb-3 mt-3" type="submit"> Add Card </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Add Card  -->

    <!-- successfull Popup -->
    <div class="modal fade" id="exampleModal_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0 pb-5 ">
                    <div class="succes_box">
                        <img src="{{asset('Influencer/images/sucess_img.svg')}}">
                        <h3>Your card has been
                            authorized successfully.</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p>
                        <div class="cardbtn"><a href="#" class="Ok_btn">Ok</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--successfull Popup-->
    <!-- Delete Bank-->
    <div class="modal fade" id="delete-bank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog deletpopup">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body p-0 ">
                    <img src="{{asset('Influencer/images/delete_icon.png') }}">
                    <input type="hidden" class="cardId">
                    <h1 class="modal-title text-center report-h5">Delete!</h1>
                    <p>Please confirm you want to
                        delete this card?</p>
                    <div class="delete_out">
                        <input type="hidden" name="bank-id" class="bank-id">
                        <a href="javascript:void(0)" class="yestbtn" onclick="delete_card()">Yes</a>
                        <a href="javascript:void(0)" class="nobtn" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Bank-->
</body>

</html>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
    function reset() {
        location.reload(true)
    }
    $(document).on('click', '.deleteCard', function() {
        var id = $(this).attr('data-cardId');
        $('.cardId').val(id)
        $('#delete-bank').modal('show');
    });

   let toastrShown = false; // Flag to track toastr message

function setPrimary(id) {
    $.ajax({
        url: "{{url('set_primary_card')}}",
        type: "GET",
        data: {
            id: id
        },
        success: function(data) {
            if (data.status == 1 && !toastrShown) {
                toastr.success('You have successfully set the card as Primary');
                toastrShown = true; // Set flag to true
                setTimeout(() => { toastrShown = false; }, 3000); // Reset after 3 seconds (optional)
                location.reload();
            }
        }
    });
}






    // $("#paymentForm").validate({

    //     errorPlacement: function(error, element) {
    //         error.insertAfter(element);
    //     },

    //     rules: {
    //         fullName: {
    //             required: true,
    //             maxlength: 50
    //         },
    //         cardNumber: {
    //             required: true,
    //             creditcard: true
    //         },
    //         month: "required",
    //         year: "required",
    //         cvv: {
    //             required: true,
    //             minlength: 3,
    //             maxlength: 3
    //         }
    //     },
    //     messages: {
    //         cardNumber: {
    //             required: "Credit card number is required.",
    //             creditcard: "Please enter a valid 16-digit credit card number."
    //         }
    //     },
    //     submitHandler: function(form) {

    //         // Submit the form programmatically
    //         form.submit();
    //     }
    // });







    function delete_card() {
        var cardId = $('.cardId').val(); // Corrected usage of val()
        if (cardId != '') {
            $.ajax({
                url: "{{url('delete_user_card')}}",
                method: "GET",
                data: {
                    cardId: cardId
                }, // Pass the value of cardId, not the jQuery object
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 1) {
                        toastr.success(resp.message);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error(resp.message);
                    }
                }
            })
        } else {
            toastr.error('Card id is required');
        }
    }
</script>
<script>
    // $(document).ready(function() {
    //     $('#paymentForm_1').submit(function(e) {
    //         e.preventDefault(); // Prevent the default form submission

    //         var formData = $(this).serialize(); // Serialize the form data

    //         $.ajax({
    //             url: "{{ url('add_card') }}",
    //             type: 'POST',
    //             data: formData,
    //             dataType: 'json',
    //             success: function(response) {

    //                 console.log('response', response);
    //                 toastr.success('You have successfully Card Saved');
    //                 window.location.href = '/user-no-save-card';

    //                 // If you need to handle specific success scenarios, uncomment the lines below
    //                 // if (response.Error != '') {
    //                 //     $('.errorMessage').text(response.Error);
    //                 // } else {
    //                 //     $('#exampleModal_1').modal('hide'); 
    //                 //     window.location.href = '/user-payment-method';
    //                 // }
    //             },
    //             error: function(xhr, status, error) {

    //                 var errorMessage = xhr.responseJSON ? xhr.responseJSON.errormessage : 'An error occurred';
    //                 console.log("error", xhr.responseJSON.errormessage)
    //                 $('.errorMessage').text(errorMessage);
    //                 console.error("errorm", xhr.responseText);
    //             }
    //         });
    //     });
    // });
  $(document).ready(function() {
    $('#paymentForm_1').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Serialize form data
        var submitButton = $('.singup-btn_2'); // Target the submit button

        // Disable the button to prevent multiple clicks
        submitButton.prop('disabled', true);

        $.ajax({
            url: "{{ url('add_card') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('response', response);

                // Show success message only once
                // toastr.remove(); // Clear any existing toastr messages
                // toastr.success('You have successfully saved the card');

                // // Close Add Card modal
                // $('#exampleModal_1').modal('hide');

                // // Reset the form
                // // $('#paymentForm_1')[0].reset();

                // // Enable the button again after some time (optional)
                // setTimeout(function() {
                //     submitButton.prop('disabled', false);
                // }, 2000);

                // // Show success modal after a slight delay
                // setTimeout(function() {
                //     $('#exampleModal_2').modal('show');
                // }, 500);
                     $('#exampleModal_1').modal('hide'); // Hide add card modal
                $('#exampleModal_2').modal('show'); // Show success modal
                toastr.success('You have successfully Card Saved');
                // Add click event on "OK" button
                $('.Ok_btn').on('click', function () {
                    location.reload(); // Reload the page when OK button is clicked
                });
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.errormessage : 'An error occurred';
                console.log("error", errorMessage);
                $('.errorMessage').text(errorMessage);

                // Re-enable the button if there was an error
                submitButton.prop('disabled', false);
            }
        });
    });
});



</script>

<script>
    $(document).ready(function() {
        $('.card_dropdown .dropdown button').click(function() {
            $(this).parent().find('.dropdown-menu').toggle();
        });

    });
</script>