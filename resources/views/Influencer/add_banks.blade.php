@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers My Profile | TidBid</title>

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
                              
                                <li {{Request::is('influencer_bookmark') ? 'class=pro_active':''}}>
                                    <img src="{{asset('Influencer/images/bookmark.png')}}"><a
                                        href="{{route('Influencer_Bookmark')}}">Bookmarks</a>
                                </li>
                                <li>
                                    <img src="{{asset('Influencer/images/logout.svg')}}" alt="">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_3"
                                        style=" padding-left: 6px;">Logout</a>
                                    {{-- <img src="{{asset('Influencer/images/logout.svg')}}"><a href="#"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal_3">Logout</a> --}}
                                </li>
                            </ul>
                        </div>
                        <div class="left_pinkbg">
                            <div class="people_img"><img src="{{asset('Influencer/images/People-img.png') }}"></div>
                            <p>View People you follow</p>
                            <a href="{{route('Influencer_My_Follower')}}">My Followers</a>
                        </div>
                    </div>
                  

                    <div class="col-lg-9 col-md-8 col-sm-12">
             
        
         <div class="modal-body">
            <div class="add-to-card">
            <div class="col-lg-12">
                  <div class="pro_head">Add Bank Accounts</div>
                </div>
               <form role="form" id="addbank" action="{{ url('/bank-account/add')}}" method="post">
                  @csrf
                  <div class="row">
                  <div class="form-group col-sm-6">
                     <label for="">First Name</label>
                     <input type="name" class="form-control" required name="first_name" id="" placeholder="First Name">
                  </div>
                  <div class="form-group col-sm-6">
                     <label for="">Last Name</label>
                     <input type="name" class="form-control" required name="last_name" id="" placeholder="Last Name">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group  col-sm-6">
                     <label for="">Email</label>
                     <input type="email" class="form-control" required name="email" id="" placeholder="Email">
                  </div>
                  <div class="form-group  col-sm-6">
                     <label for="">Phone Number</label>
                     <input type="phone" class="form-control" required name="phone_no" id="" placeholder="Phone Number">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group  col-sm-6">
                     <label for="">D.O.B</label>
                     <input type="date" class="form-control" required name="dob" id="" placeholder="DOB">
                  </div>
                  <div class="form-group  col-sm-6">
                     <label for="id_type">ID Type</label>
                     <select type="id_type" class="form-control" required name="id_type" id="id_type">
                        <option value="">Select ID Type</option>
                        <option value="passport">Passport</option>
                        <option value="driver_license">Driver's License</option>
                     </select>
                  </div>
                  </div>

                  <div class="row">
                  <div class="form-group col-sm-6">
                     <label for="">Personal Identification Number</label>
                     <input type="text" class="form-control" required name="personal_identification_no" id="" placeholder="Personal Identification Number">
                  </div>
                  <div class="form-group  col-sm-6">
                     <label for="">SSN (Last 4 Number)</label>
                     <input type="text" class="form-control" required name="ssn" id="" placeholder="SSN">
                  </div>
                  </div>

                  <div class="row">
                  <div class="form-group  col-sm-6">
                     <label for="">Address</label>
                     <input type="address" class="form-control" required name="address" id="" placeholder="Address">
                  </div>
               

                  <div class="form-group  col-sm-6">
                  <label for="">Country</label>
                  <select class="form-control" required name="country" id="country">
                     <option value="">Select Country</option>
                    
                     <option value="India">
                     Jaipur
                     </option>
                                   
                  </select>
                  </div>
                  </div>

                  <div class="row">
                  <div class="form-group col-sm-6">
                  <label for="">State</label>
                  <select class="form-control" required name="state" id="state">
                  </select>
                </div>
                  <div class="form-group col-sm-6">
                  <label for="">City</label>
                  <select class="form-control" required  name="city" id="city">
                  </select>
                  </div>
                  </div>

                  <div class="row">
                  <div class="form-group col-sm-6">
                     <label for="">Postal Code</label>
                     <input type="text" class="form-control" required name="postal_code" id="" placeholder="Postal Code">
                  </div>
                  <div class="form-group col-sm-6">
                     <label for="">Bank Name</label>
                     <input type="text" class="form-control" required name="bank_name" id="" placeholder="Bank">
                  </div>
                  </div>

                  <div class="row">
                  <div class="form-group col-sm-6">
                     <label for="">Account Holder Name</label>
                     <input type="name" class="form-control" required name="account_holder_name" id="" placeholder="Account Holder Name">
                  </div>
                  <div class="form-group col-sm-6">
                     <label for="">Bank Account Number</label>
                     <input type="text" class="form-control" required name="account_number" id="" placeholder="xxxx xxxx xxxx 1234">
                  </div>
                  </div>

                  <div class="row">
                  <div class="form-group col-sm-6">
                     <label for="">Confirm Account Number</label>
                     <input type="text" class="form-control" required name="confirm_account_number" id="" placeholder="xxxx xxxx xxxx 1234">
                  </div>
                  <div class="form-group col-sm-6">
                     <label for="">Routing No.</label>
                     <input type="text" class="form-control" required name="routing_no" id="" placeholder="081090">
                  </div>
                  </div>

                  <div class="row">
                  <div class="form-group col-sm-6">
                     <label for="">Front Side Document</label>
                     <input type="file" class="form-control" required name="front_id" id="" placeholder="file upload">
                  </div>
                  <div class="form-group col-sm-6">
                     <label for="">Back Side Document</label>
                     <input type="file" class="form-control" required name="back_id" id="" placeholder="file upload">
                  </div>
                  </div>

                  <div id="error-message" style="color: red; display: none;">Account numbers do not match.</div>
                
                  <button class="btn submit-add-card mt-3 mb-2" onclick="submitForm1()" type="submit" id="submit_button"> ADD BANK </button>
               </form>
            </div>
         </div>

</body>

</html>


@endsection