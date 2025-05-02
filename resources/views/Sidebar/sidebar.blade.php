<!-- Siderbar -->

<div class="col-lg-3 col-md-4 col-sm-12">
  <div class="profile_left">
    <ul>

      <li class="{{ request()->is('user-my-profile') ? 'pro_active' : '' }}">
        <img src="{{ asset('Influencer/images/my-profile.svg') }}">
        <a href="{{ route('User_Profile') }}">My Profile</a>
      </li>

      <li class="{{ request()->is('user-no-save-card') ? 'pro_active' : '' }}">
        <img src="{{asset('Influencer/images/Payment.svg')}}">
        <a href="{{route('UserNoSaveCard')}}">Payment Method</a>
      </li>

      <li class="{{ request()->is('user-my-transactions') ? 'pro_active' : '' }}">
        <img src="{{asset('Influencer/images/Payment.svg')}}">
        <a href="{{route('UserMyTransactions')}}">My Transactions</a>
      </li>

      <li class="{{ request()->is('user-refer-friends') ? 'pro_active' : '' }}">
        <img src="{{asset('Influencer/images/Refer.svg')}}">
        <a href="{{route('UserReferFriends')}}">Refer A Friend</a>
      </li>



      <li class="{{ request()->is('user-chat') ? 'pro_active' : '' }}">
        <img src="{{asset('Influencer/images/chat.svg') }}">
        <a href="{{url('user-chat/{id}')}}">Chats</a>
      </li>

      <li class="{{ request()->is('user-bookmark') ? 'pro_active' : '' }}">
        <img src="{{asset('Influencer/images/bookmark.png')}}">
        <a href="{{route('UserBookmark')}}">Bookmarks</a>
      </li>


      <li>
        <img src="{{asset('Influencer/images/logout.svg')}}">
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_3">Logout</a>
      </li>

    </ul>



  </div>
</div>

<!-- logout Popup -->
<div class="modal fade" id="exampleModal_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

      <div class="modal-body pt-0 pb-5  ">
        <div class="succes_box">
          <img src="{{asset('Influencer/images/logout2.png')}}">
          <h3>Do you want to logout?</h3>
          <div class="cardbtn"><a href="{{route('Userlogout')}}" class="Ok_btn">Ok</a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--logout Popup-->