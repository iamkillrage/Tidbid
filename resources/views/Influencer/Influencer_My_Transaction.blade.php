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
                    <div class="col-lg-3 col-md-12 ">
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


                    <div class="col-lg-9 col-md-12">
                        <div class="pro_right p-0">

                            <div class="broker-wrap transactions-wrap">

                                <div class="trans_h">
                                    <h3>My Transactions</h3>

                                </div>



                                <div class="broker-filters pr-0">
                                    <form method="get" class="filterData">
                                        <div class="broker-date whit-range" @if(request()->datefilter) style="width:
                                            250px;" @endif>

                                            <input type="text" name="datefilter" class="datefilter"
                                                placeholder="Date Range" value="{{  request()->datefilter}}" readonly>


                                        </div>
                                    </form>
                                    <form method="post" class="export-transection"
                                        action="{{url('exportTransection')}}">
                                        @csrf
                                        <input type="hidden" name="filter_date" value="{{ request()->datefilter}}" />
                                    </form>

                                    <div class="broker-download download_1 pr-0">
                                        <a href="javascript:void(0)" class="download-transection"
                                            download="download"><img src="{{asset('Influencer/images/download_1.png')}}"
                                                alt="">Download</a>
                                    </div>
                                </div>
                                <div class="transactions-table table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>S. No.</th>
                                            <th>User Name</th>
                                            <th> Date & Time </th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>

                                        @forelse($transection as $index=>$row)
                                        <tr>
                                            <td>{{ $transection->firstItem() + $index}}.</td>
                                            <td>{{ $row->getUser->name }}</td>
                                            <td>{{ date("D,M d, Y H:i:s", strtotime($row->date_time)) }}</td>
                                            <td>
                                                <div class="description-in">
                                                    <div class="description-in-image">
                                                        <img src="{{asset('Influencer/images/noimage.jpg')}}" alt="">
                                                    </div>
                                                    <div class="description-in-text">
                                                        <p><b>{{ $row->what_to_expect ?? 'No Description' }}</b></p>
                                                        <!--<p>Withdraw to Bank Account</p>-->
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Online</td>
                                            <td><b class="pink-color">+${{$row->amount}}</b></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5">No data found</td>
                                        </tr>
                                        @endforelse
                                    </table>
                                </div>
                            </div>

                            {{ $transection->onEachSide(1)->withQueryString()->links('Influencer.layout.pagination') }}


                        </div>
                    </div>



                </div>
            </div>
        </div>



    </main>
    <!-- Main-Section -->
     <!-- logout Popup -->
     <div class="modal fade" id="exampleModal_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body pt-0 pb-5 ">
                    <div class="succes_box">
                        <img src="{{asset('Influencer/images/logout2.png')}}">
                        <h3>Do you want to logout?</h3>
                        <div class="cardbtn"><a href="{{route('Logout')}}" class="">Ok</div>
                        {{-- <button type="button" class="cardbtn">Ok</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--logout Popup-->

    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$('.download-transection').click(function() {
    $('.export-transection').submit();
})
$(document).on('click', '.applyBtn', function() {
    $('.filterData').submit();
})

$(document).on('click', '.cancelBtn', function() {
    window.location.href = "influencer-my-transactions";
})
</script>
@endsection