    @include('admin.layout.header')
    <!-- CONTENT -->
    <section id="content-new">

        <!-- MAIN -->
        <main>
            <div class="influ-strip-2">
                <div class="influ-btns">

                    <div class="main-wrap-form">

                        <div class="influ-search">
                            <!-- <form>
								<label for="">
									<input type="search" name="" id=""  placeholder="Search by name">
									
									<button><img src="images/pkit-images/search.png" alt=""></button>
								</label>
								
								
							</form> -->

                            <div class="search-box">
                                <div class="row">
                                    <form method="GET" action="" class="userForm">
                                        <input type="text" id="input-box" name="searchQuery" value="{{ request()->searchQuery }}" placeholder="Search by Name" autocomplete="off">
                                        <button type="submit"><img src="{{asset('admins/images/Tidbid-images/all-icons/search.png')}}" alt=""></button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <form method="GET" action="" class="userForm">
                            <div class="broker-date" @if(isset(request()->datefilter)) style="width: 240px;" @endif>

                                <input type="text" name="datefilter" value="{{ request()->datefilter}}" placeholder="Date Range" readonly>

                            </div>



                            <div class="quotes">
                                <div class="dropdown-btn"><img src="{{asset('admins/images/Tidbid-images/all-icons/following-icon.png')}}" alt="" class="src">&nbsp;Followings <i class="far fa-chevron-down"></i></div>
                                <div class="dropdown">
                                    <div class="quotes-list">
                                        <div id="search-value-1" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="comman" name="followings[]" @if(isset(request()->followings) && in_array("0-50", request()->followings)) checked @endif value="0-50">
                                                0-50</label>
                                        </div>
                                        <div id="search-value-2" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="comman" name="followings[]" @if(isset(request()->followings) && in_array("50-100", request()->followings)) checked @endif value="50-100">
                                                50-100</label>
                                        </div>
                                        <div id="search-value-3" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="comman" name="followings[]" @if(isset(request()->followings) && in_array("100-150", request()->followings)) checked @endif value="100-150">
                                                100-150</label>
                                        </div>
                                        <div id="search-value-4" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="comman" name="followings[]" @if(isset(request()->followings) && in_array("150-200", request()->followings)) checked @endif value="150-200">
                                                150-200</label>
                                        </div>
                                        <div id="search-value-5" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="comman" name="followings[]" @if(isset(request()->followings) && in_array("200-500", request()->followings)) checked @endif value="200-500">
                                                200-500</label>
                                        </div>
                                        <div id="search-value-6" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="comman" name="followings[]" @if(isset(request()->followings) && in_array("500-1000", request()->followings)) checked @endif value="500-1000">
                                                500-1000</label>
                                        </div>
                                        <div id="search-value-7" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="comman" name="followings[]" @if(isset(request()->followings) && in_array(">1000", request()->followings)) checked @endif value=">1000">
                                                >1000</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="quotes">
                                <div class="dropdown-btn"><img src="{{asset('admins/images/Tidbid-images/all-icons/successfull-drop-icon.png')}}" alt="" class="src">&nbsp;Successful Bids <i class="far fa-chevron-down"></i></div>
                                <div class="dropdown">
                                    <div class="quotes-list">
                                        <div id="search-value-1" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="commanbid" name="bid[]" @if(isset(request()->bid) && in_array("0-5", request()->bid)) checked @endif value="0-5"> 0-5</label>
                                        </div>
                                        <div id="search-value-2" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="commanbid" name="bid[]" @if(isset(request()->bid) && in_array("5-10", request()->bid)) checked @endif value="5-10">
                                                5-10</label>
                                        </div>
                                        <div id="search-value-3" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="commanbid" name="bid[]" @if(isset(request()->bid) && in_array("10-15", request()->bid)) checked @endif value="10-15">
                                                10-15</label>
                                        </div>

                                        <div id="search-value-4" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="commanbid" name="bid[]" @if(isset(request()->bid) && in_array("15-20", request()->bid)) checked @endif value="15-20">
                                                15-20</label>
                                        </div>
                                        <div id="search-value-5" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="commanbid" name="bid[]" @if(isset(request()->bid) && in_array("20-50", request()->bid)) checked @endif value="20-50">
                                                20-50</label>
                                        </div>
                                        <div id="search-value-6" class="search-value">
                                            <label class="influ-btns-label"><input type="checkbox" class="commanbid" name="bid[]" @if(isset(request()->bid) && in_array(">50", request()->bid)) checked @endif value=">50"> >
                                                50</label>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </form>




                    </div>

                </div>
            </div>

            <div class="influ-table">
                <div id="table-responsive-1" class="table-responsive">
                    <table>
                        <tr>
                            <th>S.No.</th>
                            <th>Name </th>
                            <th>Profile Image </th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date of Birth</th>
                            <th>Sign up Date</th>
                            <th>Bio</th>
                            <th>Following</th>
                            <th>Successful Bids</th>
                            <th>Last Bid</th>
                            <th>Payment Cards </th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @if(count($getUser) > 0)
                            @foreach($getUser as $index => $row)
                            <tr class="delete{{ $row->id }}">
                                <td>{{ $getUser->firstItem() + $index}}.</td>
                                <td>{{ $row->name}}</td>
                                <td>
                                    @if(!empty($row->profile_img))
                                    <a href="#" class="view-profile-photo show-modal profileImg" data-toggle="modal" data-target="#self-verification" data-profile="{{asset('/profile/'.$row->profile_img)}}"><img src="{{asset('/profile/'.$row->profile_img)}}" alt=""></a>
                                    @else
                                    <a href="#" class="view-profile-photo show-modal profileImg" data-toggle="modal" data-target="#self-verification" data-profile="{{asset('admins/images/noimage.jpg')}}"><img src="{{asset('admins/images/noimage.jpg')}}" alt=""></a>
                                    @endif
                                </td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{date("m/d/Y", strtotime($row->dob)) }}
                                </td>
                                <td>{{date("m/d/Y", strtotime($row->created_at)) }}</td>
                                <td><a href="javascript:void(0)" data-bio="{{ $row->bio }}" class="show-modal GetBio" data-toggle="modal" data-target="#Bio-popup">View</a></td>
                                <td><a href="javascript:void(0)" class="show-modal" data-toggle="modal" data-target="#following-popup">{{$row->followings}}</a></td>
                                <td>{{$row->bid}}</td>
                                <td>04/04/2023</td>
                                @if ($row->id == 2 || $row->id == 4 || $row->id == 6 || $row->id == 8 || $row->id == 10 || $row->id == 12 || $row->id == 14 || $row->id == 16 || $row->id == 18)
                                <td><a href="#" class="show-modal getUserId" data-userId="{{ $row->id }}" data-toggle="modal" data-target="#payment-card-popup">No saved cards</a></td>
                                @else
                                <td><a href="#" class="show-modal" data-toggle="modal" data-target="#payment-cards-popup">3</a></td>
                                @endif

                                <td>
                                    <a href="#" class="show-modal" data-toggle="modal" data-target="#edit-popup_{{$row->id}}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/edit.png')}}" alt=""></a>

                                    <!-- Edit popup -- -->

                                    <div class="modal fade" id="edit-popup_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-dialog-edit" role="document">
                                            <div class="modal-content clearfix">
                                                <div class="modal-heading">
                                                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="addpayment-card-form">
                                                        <form method="post" action="{{url('admin/editUser')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $row->id }}">
                                                            <div class="edit-card-wrap">
                                                                <h4 class="suspendedText">Edit</h4>
                                                                <div class="profile-right-img">
                                                                    <div class="profile-right-img-prev" style="background-image: url({{asset('/profile/'.$row->profile_img)}});" id="imagePreview"></div>
                                                                    <label class="upload-icon">
                                                                        <img src="{{asset('admins/images/upload-icon.png')}}" alt="">
                                                                        <input type="file" class="imageUpload" accept=".png, .jpg, .jpeg" name="userProfile">
                                                                    </label>
                                                                </div>

                                                                <div class="edit-common-form">
                                                                    <div>
                                                                        <label for="">
                                                                            <input type="text" placeholder="Enter Name" name="userName" value="{{$row->name}}">
                                                                        </label>
                                                                    </div>
                                                                    <div>
                                                                        <label for="">
                                                                            <input type="text" placeholder="Enter Phone" value="{{$row->phone}}" readonly>
                                                                        </label>
                                                                    </div>
                                                                    <div>
                                                                        <label for="">
                                                                            <input type="text" class="datepicker" placeholder="Enter Date of Birth" name="dob" value="{{$row->dob}}">
                                                                            <div class="date-img">
                                                                                <img src="{{asset('admins/images/calender-icon.png')}}" alt="">
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <div>
                                                                        <label for="" style="height: 83px;">
                                                                            <textarea placeholder="Enter Bio" name="bio"> {{$row->bio}}</textarea>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="edit-action-wrap">
                                                                    <button type="submit">Submit</button>
                                                                    <!-- <input type="submit" name="submit" value="submit"> -->
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit popup -- -->



                                    @if($row->status == 'Activate')
                                    <a href="javascript:void(0);" data-status="{{$row->status}}" class="show-modal changeStatus" data-target="#suspend-popup" data-toggle="modal" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/checked.png')}}" alt=""></a>
                                    @else
                                    <a href="javascript:void(0);" data-status="{{$row->status}}" class="show-modal changeStatus" data-toggle="modal" data-target="#suspend-popup" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/disabled.png')}}" alt=""></a>
                                    @endif

                                    <!-- <a href="javascript:void(0);" class="deleteUser" data-status="{{$row->status}}" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/trash.png')}}" alt=""></a> -->
                                    <a href="javascript:void(0);" class="show-modal deleteUser" data-toggle="modal" data-target="#delete-popup" data-status="{{$row->status}}" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/trash.png')}}" alt=""></a>

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="13"> no data found</td>
                            </tr>
                            @endif
                        </tbody>


                    </table>
                </div>
                <div class="d-felx justify-content-center">
                    {{ $getUser->onEachSide(1)->withQueryString()->links('admin.layout.pegination') }}

                </div>



            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->




    <!-- Self verification popup -- -->

    <div class="modal fade" id="self-verification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="share-social-form">
                        <form>

                            <div class="all-selected-services">
                                <span class="actionimg"> <img src="{{asset('admins/images/Tidbid-images/all-icons/view-image.png')}}" alt="" class="profileImgs"></span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Self verification popup -- -->

    <!-- Bio popup -- -->

    <div class="modal fade" id="Bio-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="biopopup-form">
                        <form>
                            <h2>Bio</h2>
                            <div class="biopopup-wrap">
                                <p id="myParagraphBio"></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bio popup -- -->

    <!-- Payment Cards popup -- -->

    <div class="modal fade" id="payment-card-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpayment-card-form">
                        <form>
                            <h2>No saved cards</h2>
                            <div class="payment-card-wrap">
                                <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/card.png')}}" alt="">
                                <!-- <h4>No saved cards</h4> -->
                                <p>User have no cards saved in on TidBid</p>
                                <button type="button" value="Submit" class="show-modal" data-toggle="modal" data-target="#payment-cardform-popup" data-dismiss="modal">Add Card</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Cards popup -- -->


    <!-- Add Card Form popup -- -->

    <div class="modal fade" id="payment-cardform-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpayment-card-form">
                        <form method="post" action="#">
                            @csrf
                            <input type="hidden" name="user_id" value="" class="user_id">
                            <h2>Add Cards</h2>
                            <div class="payment-card-wrap">

                                <div class="add-card-wrap-form">
                                    <div>
                                        <label for="">
                                            <h3>Card Holder</h3>
                                            <input type="text" placeholder="Card Holder Name" name="userName">
                                        </label>
                                    </div>
                                    <div>
                                        <label for="">
                                            <h3>Card Number</h3>
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/master2.png')}}" alt="" class="src">
                                            <input type="number" placeholder="**** **** **** ****" name="cardName">
                                        </label>
                                    </div>

                                    <div class="cvv-mnth-wrap">
                                        <label for="">
                                            <h3>Expiry Date</h3>
                                            <input type="text" placeholder="Month / Year">
                                        </label>
                                        <label for="">
                                            <h3>CVV</h3>
                                            <input type="text" placeholder="***">
                                        </label>
                                    </div>
                                    <br>
                                    <!-- <div class="detailss">
                                        <input type="checkbox" value="">
                                        <p>Save my card and auto-renew my membership every month.</p>
                                    </div> -->

                                </div>




                                <button type="button">Authorize</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Card Form popup -- -->

    <!-- Following popup -- -->

    <div class="modal fade" id="following-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="biopopup-form">
                        <form>
                            <h2>Following</h2>
                            <div class="following-wrap">

                                <!-- followers -->
                                <div class="follow-inner-wrap">
                                    <div class="image-name">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                        <p>Kathryn Murphy</p>
                                    </div>
                                    <span>10k+</span>
                                </div>
                                <!-- followers -->

                                <!-- followers -->
                                <div class="follow-inner-wrap">
                                    <div class="image-name">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                        <p>Kathryn Murphy</p>
                                    </div>
                                    <span>10k+</span>
                                </div>
                                <!-- followers -->

                                <!-- followers -->
                                <div class="follow-inner-wrap">
                                    <div class="image-name">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon3.png')}}" alt="" class="src">
                                        <p>Kathryn Murphy</p>
                                    </div>
                                    <span>10k+</span>
                                </div>
                                <!-- followers -->

                                <!-- followers -->
                                <div class="follow-inner-wrap">
                                    <div class="image-name">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                        <p>Kathryn Murphy</p>
                                    </div>
                                    <span>10k+</span>
                                </div>
                                <!-- followers -->

                                <!-- followers -->
                                <div class="follow-inner-wrap">
                                    <div class="image-name">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                        <p>Kathryn Murphy</p>
                                    </div>
                                    <span>10k+</span>
                                </div>
                                <!-- followers -->

                            </div>

                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Following popup -- -->

    <!-- Payment cards popup -- -->

    <div class="modal fade" id="payment-cards-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="biopopup-form">
                        <form>
                            <h2>Payment Cards</h2>

                            <div class="showpayment-cards-popup">

                                <!-- card 1 -->
                                <div class="payment-card">
                                    <div class="top-image-card">
                                        <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/top-imge.png')}}">
                                        <p>Primary</p>
                                    </div>
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/card1.jpg')}}" alt="" class="src">
                                    <div class="card-details-pay">
                                        <p>**** **** **** 0329</p>
                                        <span>
                                            <tag style="font-size: 8px;">VALID<br />THRU</tag>
                                            03/24
                                        </span>
                                        <h4>Cameron Williamson</h4>
                                    </div>
                                </div>
                                <!-- card 1 -->

                                <!-- card 2 -->
                                <div class="payment-card">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/card2.jpg')}}" alt="" class="src">
                                    <div class="card-details-pay">
                                        <p>**** **** **** 0329</p>
                                        <span>
                                            <tag style="font-size: 8px;">VALID<br />THRU</tag>
                                            03/24
                                        </span>
                                        <h4>Cameron Williamson</h4>
                                    </div>
                                </div>
                                <!-- card 2 -->

                                <!-- card 3 -->
                                <div class="payment-card">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/card1.jpg')}}" alt="" class="src">
                                    <div class="card-details-pay">
                                        <p>**** **** **** 0329</p>
                                        <span>
                                            <tag style="font-size: 8px;">VALID<br />THRU</tag>
                                            03/24
                                        </span>
                                        <h4>Cameron Williamson</h4>
                                    </div>
                                </div>
                                <!-- card 3 -->


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Payment cards popup -- -->

    <!-- Suspend popup -- -->

    <div class="modal fade suspendedUser" id="suspend-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpayment-card-form">
                        <form>
                            <div class="payment-card-wrap">
                                <span class="actionimg"><img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png')}}" alt=""></span>
                                <h4 class="suspendedText">Suspend!</h4>
                                <p class="messageMsg">Please confirm you want to<br />
                                    suspend this User?</p>
                                <div class="bottom-action-wrap">
                                    <button type="button" onclick="changeStatus()">Confirm</button>
                                    <button type="submit">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Suspend popup -- -->

    <!-- Active popup -- -->

    <div class="modal fade suspendedUser" id="suspend-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpayment-card-form">
                        <form>
                            <div class="payment-card-wrap">
                                <img src="{{asset('admins/images/active-check.png')}}" alt="">
                                <h4 class="suspendedText">Activate</h4>
                                <p class="messageMsg"></p>
                                <div class="bottom-action-wrap">
                                    <button type="button" onclick="changeStatus()">Confirm</button>
                                    <button type="submit">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active popup -- -->


    <!-- Delete popup -- -->

    <div class="modal fade" id="delete-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpayment-card-form">
                        <form>
                            <input type="hidden" value="" class="userIds">
                            <div class="payment-card-wrap">
                                <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/delete.png')}}" alt="">
                                <h4 class="deleteText">Delete!</h4>
                                <p>Please confirm you want to<br />
                                    delete this User?</p>
                                <div class="bottom-action-wrap">
                                    <button type="button" onclick="deleteUser()">Confirm</button>
                                    <button type="submit">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
    <script>
        $('.profileImg').click(function() {
            var photo = $(this).attr('data-profile');
            $('.profileImgs').attr('src', photo);
        })



        $(document).on('click', '.getUserId', function() {
            var userId = $(this).attr('data-userId');
            $('.user_id').val(userId);
        });







        $(document).on('click', '.applyBtn', function() {
            setTimeout(function() {

                $('.userForm').submit();
            }, 1000);

        })
        $(document).on('click', '.cancelBtn', function() {
            setTimeout(function() {

                $('.userForm').submit();
            }, 1000);

        })




        $(document).on('click', '.GetBio', function() {
            var bio = $(this).attr('data-bio');
            $('#myParagraphBio').text(bio);

        })
        //  function getBio(){
        //       var bio = $(this).attr('data-bio');
        //       alert(bio);
        //  }


         $(document).on('click', '.changeStatus', function() {
            var userId = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var baseUrl = "{{url('/')}}";

            if (userId) {
                if (status == 'Inactive') {
                    $('.messageMsg').html();
                    $('.actionimg').html('<img src="' + baseUrl + '/public/admins/images/accept-green.png" alt="">');
                    $('.suspendedText').text('Activate');
                    $('.messageMsg').html('Please confirm you want to activate this User?')

                } else {
                    // alert("xcxc");
                    $('.messageMsg').html();
                    $('.actionimg').html('<img src="' + baseUrl + '/public/admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png" alt="">')
                    $('.suspendedText').text('Suspend');
                    $('.messageMsg').text('Please confirm you want to suspend this User?')
                }
                // $('.suspendedUser').addClass('show')
                $('.userIds').val(userId)
                $('#suspend-popup').modal('show');
            } else {
                toastr.error("user id not found..");
            }
        })


        function changeStatus() {
            var userIds = $('.userIds').val();

            if (userIds) {
                $.ajax({
                    type: 'post',
                    url: "{{url('admin/change-user-status')}}",
                    data: {
                        id: userIds
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // beforeSend: function() {
                    //     $('.suspendedText').text('....Please wait');
                    // },
                    success: function(response) {
                        if (response.status == 1) {

                            // $('.deleteText').text(response.message);
                             toastr.success("User " + response.message);
                            $('#suspend-popup').modal('hide');
                            setInterval(function() {
                                location.reload(true);
                            }, 1000);
                        } else {
                            $('.deleteText').text(response.message);;
                        }
                    }
                });
            } else {
                toastr.error("user id not found..");
            }
        }


        $('.deleteUser').click(function() {
            var userId = $(this).attr('data-id');
            if (userId) {
                // $('.deleteUsers').addClass('show')
                $('.userIds').val(userId)
                // $('#delete-popup').modal('show');
            } else {
                toastr.error("user id not found..");
            }
        })

        function deleteUser() {
            var userIds = $('.userIds').val();
            //alert()
            if (userIds) {
                $.ajax({
                    type: 'post',
                    url: "{{url('admin/user-delete')}}",
                    data: {
                        id: userIds
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // beforeSend: function() {
                    //     $('.deleteText').text('....Please wait');
                    // },
                    success: function(response) {
                        if (response.status == 1) {

                            toastr.success(response.message);
                            $('#delete-popup').modal('hide');
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        } else {
                            $('.deleteText').text(response.message);;
                        }
                    }
                });
            } else {
                toastr.error("user id not found..");
            }
        }
    </script>

    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd", // Change the date format here
                maxDate: 0
            });
        });


        $(document).ready(function() {
            $('.comman').click(function() {
                if ($(this).is(":checked")) {

                    setTimeout(function() {

                        $('.userForm').submit();
                    }, 1000);

                }
            });
        });
        $(document).ready(function() {
            $('.comman').click(function() {
                $('.comman').not(this).prop('checked', false);
                // console.log("clicked");
                // Delay form submission
                setTimeout(function() {
                    $('.userForm').submit();
                }, 1000);
            });

        });


        $(document).ready(function() {
            $('.commanbid').click(function() {
                if ($(this).is(":checked")) {

                    setTimeout(function() {

                        $('.userForm').submit();
                    }, 1000);

                }
            });
        });
        $(document).ready(function() {
            $('.commanbid').click(function() {
                $('.commanbid').not(this).prop('checked', false);
                // Delay form submission
                setTimeout(function() {
                    $('.userForm').submit();
                }, 1000);
            });
        });
    </script>