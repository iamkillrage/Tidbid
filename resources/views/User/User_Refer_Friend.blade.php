@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Refer A Friend | TidBid</title>

</head>

<body>

  <!-- Header-Section -->
  <header>
  @include('User.Navbar.nav')
  </header>
  <!-- End Header-Section -->

  <!-- Main-Section -->
  <main>

    <div class="prof_lefsect">
      <div class="container">
        <div class="row">
        @include('Sidebar.sidebar')
          <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="pro_right p-space">
              <div class="row">
                <div class="col-lg-12">
                  <div class="pro_head p-3 pb-5 mb-3">Refer a Friend</div>
                </div>

                <div class="col-lg-6 col-md-12">
                  <div class="howit">
                    <h5>How it works</h5>
                    <ul>
                      <li>Invite your friends, just share your link to download the App.</li>
                      <li>Earn Voopons.</li>
                      <li>Congratulations! Voopon is on its way.</li>
                      <li>Lorem Ipsum is simply dummy text.</li>
                      <li>Lorem Ipsum is simply dummy text.</li>
                      <li>Lorem Ipsum is simply dummy text.</li>
                    </ul>
                  </div>
                </div>

                <div class="col-lg-6 col-md-12">
                  <div class="earnimg">
                    <img src="{{asset('Influencer/images/earn-img.png')}}">
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="howit">
                    <h5>Refer & Earn $10 auction free</h5>
                    <p class="earntext">Points expire 12 months after your most recent<br>
                      transaction on 04/08/2024. </p>
                  </div>
                  <div class="cardbtn mr-auto">
                    <a href="javascript:void(0)" class="copy_btn"  data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/file-upload.png')}}"> Refer a friend</a>
                    <!--<a href="javascript:void(0)" data-url="{{url('')}}" data-referCode="{{auth()->user()->referral_code}}" class="bgtrans"><img src="{{asset('Influencer/images/copy_img.png')}}"></a>-->
                    <a href="javascript:void(0)" 
   data-url="{{url('')}}" 
   data-referCode="{{auth()->user()->referral_code}}" 
   class="bgtrans copy-btn"
   onclick="copyReferCode(this)">
   <img src="{{asset('Influencer/images/copy_img.png')}}">
</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  <!-- Main-Section -->

  <!--  <!-- Popup share -->
   <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

        <div class="modal-body pt-0 pb-5 ">
          <h1 class="modal-title text-center report-h5">Share </h1>

          <ul class="social_icon">
            <li><a href="https://www.facebook.com/" target="_blank"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
            <li><a href="https://twitter.com/" target="_blank"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
            <li><a href="https://in.linkedin.com/" target="_blank"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
          </ul>

        </div>



      </div>
    </div>
  </div>

  <!-- Popup share -->
  @endsection

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Select the link element
    const copyLink = document.querySelector('a[data-url][data-referCode]');

    // Add click event listener to the link
    copyLink.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default link behavior
      // Get the data-url and data-referCode attributes
      const dataUrl = copyLink.getAttribute('data-url');
      const referCode = copyLink.getAttribute('data-referCode');

      // Combine the attribute values into a single string
      const combinedValue = `URL: ${dataUrl}, Refer Code: ${referCode}`;

      // Create a temporary input element
      const tempInput = document.createElement('input');
      tempInput.value = combinedValue;
      document.body.appendChild(tempInput);

      // Select the text in the input element
      tempInput.select();
      tempInput.setSelectionRange(0, 999999); // For mobile devices

      // Copy the selected text to the clipboard
      document.execCommand('copy');

      // Remove the temporary input element
      document.body.removeChild(tempInput);

   
    });
  });
</script>

<script>
    function copyReferCode(element) {
        var referCode = element.getAttribute("data-referCode");

        // Clipboard me copy karein
        var tempInput = document.createElement("input");
        document.body.appendChild(tempInput);
        tempInput.value = referCode;
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);

        // Toastr notification dikhana
        toastr.success("Refer Code Copied!");
    }
</script>