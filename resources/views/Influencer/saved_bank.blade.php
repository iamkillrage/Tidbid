@extends('LayoutWebsite.masterwebsite')
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
                <a href="{{ route('Influencer_My_Profile') }}" class="text-white">
                  <li class="{{ Request::is('influencer-my-profile') ? 'pro_active' : '' }}">
                    <img src="{{ asset('Influencer/images/my-profile.svg') }}" alt=""> My Profile
                  </li>
                </a>
                <a href="{{ route('Influencer_Saved_Bank') }}" class="text-white">
                  <li class="{{ Request::is('influencer-saved-bank') ? 'pro_active' : '' }}">
                    <img src="{{ asset('Influencer/images/Payment.svg') }}" alt=""> Payment Method
                  </li>
                </a>
                <a href="{{ route('Influencer_My_Transaction') }}" class="text-white">
                  <li class="{{ Request::is('influencer-my-transactions') ? 'pro_active' : '' }}">
                    <img src="{{ asset('Influencer/images/Payment.svg') }}" alt=""> My Transactions
                  </li>
                </a>
                <a href="{{ route('Refer_A_Friend') }}" class="text-white">
                  <li class="{{ Request::is('influencer-refer-a-friend') ? 'pro_active' : '' }}">
                    <img src="{{ asset('Influencer/images/Refer.svg') }}" alt=""> Refer a Friend
                  </li>
                </a>
                <a href="{{ url('influencer-chat/{id}') }}" class="text-white">
                  <li class="{{ Request::is('influencer-chat') ? 'pro_active' : '' }}">
                    <img src="{{ asset('Influencer/images/chat.svg') }}" alt=""> Chats
                  </li>
                </a>
                <a href="{{ route('Influencer_Bookmark') }}" class="text-white">
                  <li class="{{ Request::is('influencer_bookmark') ? 'pro_active' : '' }}">
                    <img src="{{ asset('Influencer/images/bookmark.png') }}" alt=""> Bookmarks
                  </li>
                </a>
                <a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#exampleModal_3">
                  <li>
                    <img src="{{ asset('Influencer/images/logout.svg') }}" alt=""> Logout
                  </li>
                </a>
              </ul>
            </div>
          </div>
          <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="pro_right cardouter">
              <div class="row">
                @if(count($bank) !=0)
                <div class="col-lg-12">
                  <div class="pro_head">Bank Accounts</div>
                </div>
                @endif

                @forelse($bank as $value)
                @php
                $stripeData = json_decode($value->all_stripe_data);
                // $bankAccount = $stripeData->bank_account ?? null;
                // dd($stripeData->bank_account);
                @endphp
                <div class="col-lg-6 col-md-12 remove-bank_{{ $value->id }}">
                  <div class="cardbg cart-black">
                    <div class="cart_close">
                      <a href="javascript:void(0)" class="deleteAccount" data-id="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#delete-bank">
                        <i class="fas fa-times-circle"></i>
                      </a>
                    </div>
                    <div class="card_num Black_num">
                      <div class="Bank_cart"><i class="far fa-credit-card"></i></div>
                      <div class="black_card">
                        <p>Bank Name</p>
                        <p>{{ $stripeData->bank_account->bank_name ?? 'N/A' }}</p>
                      </div>
                    </div>
                    <div class="card_num Black_num">
                      <div class="Bank_cart"><i class="fas fa-university"></i></div>
                      <div class="black_card">
                        <p>Account Number</p>
                       <p>{{ str_repeat('*', 12) . ($stripeData->bank_account->last4 ?? 'N/A') }}</p>
                      </div>
                    </div>
                    <div class="card_num Black_num">
                      <div class="Bank_cart"><img src="{{ asset('Influencer/images/calculator_icon.svg') }}"></div>
                      <div class="black_card">
                        <p>Routing Number</p>
                        <p>
                          {{
                              isset($stripeData->bank_account->routing_number)
                                ? str_repeat('*', 7) . substr($stripeData->bank_account->routing_number, -4)
                                : 'N/A'
                            }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="pro_right">
                    <div class="no-cardbox">
                      <img src="{{ asset('Influencer/images/bank-line.png') }}">
                      <h3>You have no Saved Bank.</h3>
                      <p>Please add a payment method to enter TidBid Auction</p>
                    </div>
                  </div>
                </div>
                @endforelse

                <div class="col-lg-12">
                  <div class="no-cardbox pb-0 mt-5 ">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_1">Add Bank</a>
                    <!-- <a href="{{route('New-Add-Bank')}}" >Add Bank</a> -->
                  </div>

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
        <button type="button" class="btn-close" onclick="reset()" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

        <form id="savebank" method="get">
          @csrf
          <!--<div class="modal-body pt-0 pb-5 ">-->
          <!--  <h1 class="modal-title text-center report-h5">Add Bank</h1>-->
          <!--  <div class="text-danger errorMessage"></div>-->
          <!--  <div class="card_filde">-->
          <!--    <label>Bank Name</label>-->
          <!--    <input type="text" name="bank_name" id="bank" required placeholder="Bank of America">-->
          <!--  </div>-->
          <!--  <div class="card_filde card-clas">-->
          <!--    <label>Bank Account Number</label>-->
          <!--    <input type="text" name="account_no" id="account_no" required placeholder="xxxx xxxx xxxx 1234">-->
          <!--  </div>-->
          <!--  <div class="card_filde cvv">-->
          <!--    <label>Routing No. </label>-->
          <!--    <input type="text" name="routing_no" id="routing_no" required placeholder="081090">-->
          <!--  </div>-->
          <!--  {{-- <div class="cardbtn"><a href="#">Submit</a></div> --}}-->
          <!--  <button type="submit" class="singup-btn_2 mb-3 mt-3">Submit-->
          <!--</div>-->
          
          <div class="modal-body pt-0 pb-5">
    <h1 class="modal-title text-center report-h5">Add Bank</h1>
    
    <!-- Error Message Div -->
    <div id="modal-error" class="text-center text-danger"></div>
    <div class="text-danger errorMessage"></div>

    <div class="card_filde">
        <label>Bank Name</label>
        <input type="text" name="bank_name" id="bank" required placeholder="Bank of America">
    </div>
    <div class="card_filde card-clas">
        <label>Bank Account Number</label>
        <input type="text" name="account_no" id="account_no" required placeholder="xxxx xxxx xxxx 1234">
    </div>
    <div class="card_filde cvv">
        <label>Routing No. </label>
        <input type="text" name="routing_no" id="routing_no" placeholder="081090">
    </div>

    <button type="submit" class="singup-btn_2 mb-3 mt-3">Submit
</div>

      </div>
      </form>
    </div>
  </div>
  </div>

  <!-- Add Bank Popup -->

  <!-- Delete Bank-->
  <div class="modal fade" id="delete-bank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog deletpopup">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
        <div class="modal-body p-0 ">
          <img src="{{asset('Influencer/images/delete_icon.png') }}">
          <h1 class="modal-title text-center report-h5">Delete!</h1>
          <p>Please confirm you want to
            delete this Bank?</p>
          <div class="delete_out">
            <input type="hidden" name="bank-id" class="bank-id">
            <a href="javascript:void(0)" class="yestbtn" onclick="deleteAccount()">Yes</a>
            <a href="javascript:void(0)" class="nobtn" data-bs-dismiss="modal">No</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Bank-->

  <!-- logout Popup -->
  <div class="modal fade" id="exampleModal_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

        <div class="modal-body pt-0 pb-5 ">
          <div class="succes_box">
            <img src="{{asset('Influencer/images/logout2.png')}}">
            <h3>Do you want to logout?</h3>
            <div class="cardbtn"><a href="{{route('SignIn')}}" class="Ok_btn">Ok</a></div>
          </div>


        </div>
      </div>
    </div>
  </div>
  <!--logout Popup-->

</body>
<html>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  function reset() {
    location.reload(true)
  }
  $(document).on('click', '.deleteAccount', function() {
    var id = $(this).attr('data-id');
    $('.bank-id').val(id);
  });

  function deleteAccount() {
    var id = $('.bank-id').val();
    $.ajax({
      url: "{{ route('Influencer_Delete_Bank') }}",
      type: 'GET',
      data: {
        id: id
      },
      success: function(response) {
        if (response.status == 1) {
          console.log('hi');
          $('.remove-bank_' + id).remove();
          $('#delete-bank').modal('hide');
          toastr.success(response.message);
          location.reload();
        } else {
          console.log('hi');
          toastr.error(response.message);
        }
      }


    });
  }




//   $(document).ready(function() {
//     $('#savebank').submit(function(e) {
//       e.preventDefault();

//       var bank_name = $("input[name='bank_name']").val();
//       var account_no = $("input[name='account_no']").val();
//       var routing_no = $("input[name='routing_no']").val();

//       $.ajax({
//         url: "{{ route('Influencer_Add_Bank') }}",
//         type: 'GET',
//         data: $(this).serialize(),
//         success: function(response) {
          
//           if (response.status === 1) {
            
//             $('.exampleModal_1').modal('hide');
//             toastr.success('You have successfully Bank Saved');
//             location.reload();
//           } else {
//             $('.errorMessage').text(response.Error);

//           }
//         },
//         error: function(xhr, status, error) {

//           console.error(xhr.responseText);
//         }
//       });
//     });
//   });
  
// $(document).ready(function() {
//     $('#savebank').submit(function(e) {
//       e.preventDefault();

//       var bank_name = $("input[name='bank_name']").val();
//       var account_no = $("input[name='account_no']").val();
//       var routing_no = $("input[name='routing_no']").val();

//       $.ajax({
//         url: "{{ route('Influencer_Add_Bank') }}",
//         type: 'GET',
//         data: $(this).serialize(),
//         success: function(response) {

//           if (response.status === 1) {

//             $('.exampleModal_1').modal('hide');
//             toastr.success('You have successfully Bank Saved');
//             location.reload();
//           } else {
//             $('.errorMessage').text(response.Error);

//           }
//         },
//         error: function(xhr, status, error) {

//           console.error(xhr.responseText);
//         }
//       });
//     });
//   });

$(document).ready(function() {
    $('#savebank').submit(function(e) {
        e.preventDefault();
        
        // Clear previous error messages with fade-out effect
        $('#modal-error').fadeOut(2000, function() {
            $(this).text(""); // Clear error text after fading out
        });
        
        // Basic client-side validation
        var bankName = $('#bank').val();
        var accountNo = $('#account_no').val();
        var routingNo = $('#routing_no').val();
        
        if (bankName == "" || accountNo == "" || routingNo == "") {
            $('#modal-error').text("Please fill out all the details.").fadeIn(2000); // Fade-in error message
            return false; // Prevent the form from being submitted
        }
        
        $.ajax({
            url: "{{ route('Influencer_Add_Bank') }}",
            type: 'GET',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 1) {
                    $('#exampleModal_1').modal('hide'); // Correct modal ID
                    toastr.success('You have successfully saved bank details');
                    location.reload();
                } else {
                    $('#modal-error').fadeOut(200, function() {
                        $(this).text(response.error).fadeIn(200); // Fade-out previous message, then fade-in new error message
                    });
                }
            },
            error: function(xhr, status, error) {
                let response = xhr.responseJSON;
                if (response && response.error) {
                    $('#modal-error').fadeOut(200, function() {
                        $(this).text(response.error).fadeIn(200); // Show error from the backend and fade it in
                    });
                } else {
                    $('#modal-error').fadeOut(2000, function() {
                        $(this).text('Something went wrong, please try again.').fadeIn(2000); // General error message
                    });
                }
            }
        });
    });
});



</script>