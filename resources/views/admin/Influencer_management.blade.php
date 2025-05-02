@include('admin.layout.header')
<!-- CONTENT -->
<section id="content-new">

    <!-- MAIN -->
    <main>
        <div class="influ-strip-2">
            <div class="influ-btns">

                <div class="main-wrap-form">
                    <div class="influ-search">


                        <div class="search-box">
                            <div class="row">
                                <form method="GET" action="" class="influencerSearch">
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
                            <div class="dropdown-btn"><img src="{{asset('admins/images/Tidbid-images/all-icons/follow-icon.png')}}" alt="" class="src">&nbsp;Followers <i class="far fa-chevron-down"></i></div>
                            <div class="dropdown">
                                <div class="quotes-list">
                                    <div id="search-value-1" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" class="comman1" name="followers[]" @if(isset(request()->followers) && in_array("0-5k", request()->followers)) checked @endif value="0-5k">
                                            0-5k</label>
                                    </div>
                                    <div id="search-value-2" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" class="comman1" name="followers[]" @if(isset(request()->followers) && in_array("5k-10k", request()->followers)) checked @endif value="5k-10k">
                                            5k-10k</label>
                                    </div>
                                    <div id="search-value-2" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" class="comman1" name="followers[]" @if(isset(request()->followers) && in_array("10k-15k", request()->followers)) checked @endif value="10k-15k">
                                            10k-15k</label>
                                    </div>
                                    <div id="search-value-3" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" class="comman1" name="followers[]" @if(isset(request()->followers) && in_array("15k-20k", request()->followers)) checked @endif value="15k-20k">
                                            15k-20k</label>
                                    </div>
                                    <div id="search-value-4" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" class="comman1" name="followers[]" @if(isset(request()->followers) && in_array("20k-50k", request()->followers)) checked @endif value="20k-50k">
                                            20k-50k</label>
                                    </div>
                                    <div id="search-value-5" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" class="comman1" name="followers[]" @if(isset(request()->followers) && in_array(">50k", request()->followers)) checked @endif value=">50k"> >
                                            50k</label>
                                    </div>

                                </div>
                            </div>
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




                    </form>




                </div>

            </div>
        </div>

        <div class="influ-table">
            <div id="table-responsive-1" class="table-responsive">
                <table>
                    <tr>
                        <th>S.No.</th>
                        <th>Influencer Name </th>
                        <th>Socials</th>
                        <th>Profile Pic</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Sign up Date</th>
                        <th>Bio</th>
                        <th>Following</th>
                        <th>Followers</th>
                        <th>Upcoming Stream</th>
                        <th>Total Streams</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @foreach($Influencers as $index => $Influencer)
                        <tr>
                            <td>{{ $Influencers->firstItem() + $index}}.</td>
                            <td>{{ $Influencer->name }}</td>
                            <td><a href="#" class="show-modal" data-toggle="modal" data-target="#socialmedia-popup">View</a></td>
                            <td>
                                @if(!empty($Influencer->profile_img))
                                <a href="#" class="view-profile-photo show-modal profileImg" data-toggle="modal" data-target="#self-verification" data-profile="{{asset('/Influencer/images/profile_img/'.$Influencer->profile_img)}}"><img src="{{asset('/Influencer/images/profile_img/'.$Influencer->profile_img)}}" alt=""></a>
                                @else
                                <a href="#" class="view-profile-photo show-modal profileImg" data-toggle="modal" data-target="#self-verification" data-profile="{{asset('admins/images/noimage.jpg')}}"><img src="{{asset('admins/images/noimage.jpg')}}" alt=""></a>
                                @endif
                            </td>
                            <td>{{ $Influencer->email }}</td>
                            <td>{{ $Influencer->phone }}
                            </td>
                            <td>{{ $Influencer->dob }}</td>

                            <td>{{date("m/d/Y", strtotime( $Influencer->created_at)) }}</td>
                            <td><a href="javascript:void(0)" class="show-modal getbio" data-bio="{{$Influencer->bio }}" data-toggle="modal" data-target="#Bio-popup">View</a>
                            </td>
                            <td><a href="javascript:void(0)" class="show-modal" data-toggle="modal" data-target="#following-popup">{{$Influencer->followings}}</a></td>
                            <td><a href="javascript:void(0)" class="show-modal" data-toggle="modal" data-target="#followers-popup">{{$Influencer->followers}}</a></td>
                            <td>
                                @if($Influencer->upcoming_stream)
                                    {{ \Carbon\Carbon::parse($Influencer->upcoming_stream->streamDate)->format('d M Y') }}
                                @else
                                    No Upcoming Stream
                                @endif
                            </td>
                            <td>{{ $Influencer->streams_count }}</td>
                            <td>
                                <a href="javascript:void(0)" class="show-modal" data-toggle="modal" data-target="#edit-popup_{{ $Influencer->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/edit.png')}}" alt=""></a>


                                <!-- Edit popup -- -->

                                <div class="modal fade" id="edit-popup_{{ $Influencer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                        <input type="hidden" name="user_id" value="{{ $Influencer->id }}">
                                                        <div class="edit-card-wrap">
                                                            <h4 class="suspendedText">Edit</h4>
                                                            <div class="profile-right-img">
                                                                <div class="profile-right-img-prev" style="background-image: url({{asset('/profile/'.$Influencer->profile_img)}});" id="imagePreview"></div>
                                                                <label class="upload-icon">
                                                                    <img src="{{asset('admins/images/upload-icon.png')}}" alt="">
                                                                    <input type="file" class="imageUpload" accept=".png, .jpg, .jpeg" name="userProfile">
                                                                </label>
                                                            </div>

                                                            <div class="edit-common-form">
                                                                <div>
                                                                    <label for="">
                                                                        <input type="text" placeholder="Enter Name" name="userName" value="{{$Influencer->name}}">
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <label for="">
                                                                        <input type="text" placeholder="Enter Phone" value="{{$Influencer->phone}}" readonly>
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <label for="">
                                                                        <input type="text" class="dobDate" placeholder="Enter Date of Birth" name="dob" value="{{$Influencer->dob}}">
                                                                        <div class="date-img">
                                                                            <img src="{{asset('admins/images/calender-icon.png')}}" alt="">
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <label for="" style="height: 83px;">
                                                                        <textarea placeholder="Enter Bio" name="bio"> {{$Influencer->bio}}</textarea>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="edit-action-wrap">
                                                                <button type="submit">Submit</button>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit popup -- -->





                                @if($Influencer->status == 'Activate')
                                <a href="javascript:void(0)" data-status="{{$Influencer->status}}" data-id="{{$Influencer->id}}" class="show-modal getInfulencerId"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/checked.png')}}" alt=""></a>
                                @else
                                <a href="javascript:void(0)" data-status="{{$Influencer->status}}" data-id="{{$Influencer->id}}" class="getInfulencerId"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/disabled.png')}}" alt=""></a>
                                @endif

                                <a href="javascript:void(0)" class="deleteUser" data-status="{{$Influencer->status}}" class="show-modal deleteUser" data-id="{{$Influencer->id}}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/trash.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>



                </table>
            </div>
            <div class="d-felx justify-content-center">
                {{ $Influencers->onEachSide(1)->withQueryString()->links('admin.layout.pegination') }}

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
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/view-image.png')}}" alt="" class="profileImgs">
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
                            <p class="infuBio"></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bio popup -- -->

<!-- Social Media popup -- -->

<div class="modal fade" id="socialmedia-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <h2>Social Media</h2>
                        <div class="following-wrap">
@foreach ($Influencer->social_links as $social)
    <div class="social-inner-wrap">
        <div class="social-detail-wrap">
            <a href="{{ $social->link }}" target="_blank">{{ $social->link }}</a>
        </div>
    </div>
@endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Social Media popup -- -->


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
</div>

<!-- Following popup -- -->


<!-- Followers popup -- -->

<div class="modal fade" id="followers-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <h2 class="pb-2">Followers</h2>

                        <div class="following-wrap-tab">

                            <!-- tab pill btn -->
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#refer-earn" data-toggle="tab"><img src="{{asset('admins/images/luvshare-images/refer-imges/logged-green.svg')}}" alt="" class="">Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#eventPassed" data-toggle="tab">Influencers</a>
                                </li>
                            </ul>
                            <!-- tab pill btn -->

                        </div>


                        <div class="following-wrap">




                            <div class="tab-content" id="ex2-content">

                                <!-- tab pill btn Section 1 -->

                                <div class="tab-pane fade active show" id="refer-earn" role="tabpanel" aria-labelledby="ex3-tab-1">

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon3.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->
                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                </div>

                                <!-- tab pill btn Section 1 -->


                                <!-- tab pill btn Section 2 -->

                                <div class="tab-pane fade" id="eventPassed" role="tabpanel" aria-labelledby="ex3-tab-2">

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon3.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                    <!-- followers -->
                                    <div class="follow-inner-wrap">
                                        <div class="image-name">
                                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                            <p>Kathryn Murphy</p>
                                        </div>
                                        <!-- <span>10k+</span> -->
                                    </div>
                                    <!-- followers -->

                                </div>

                                <!-- tab pill btn Section 2 -->



                            </div>











                        </div>

                </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Followers popup -- -->



<!-- Suspend popup -- -->

<div class="modal fade  Suspendspopups" id="suspend-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <input type="hidden" value="" class="infuId">
                            <span class="actionimg"> <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png')}}" alt=""></span>
                            <h4 class="suspendedText">Suspend!</h4>
                            <p class="messageMsg"></p>
                            <div class="bottom-action-wrap">
                                <button type="button" onclick="influencerStatus()">Confirm</button>
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


<!-- Edit popup -- -->

<div class="modal fade" id="edit-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <div class="edit-card-wrap">
                            <h4 class="suspendedText">Edit</h4>
                            <div class="profile-right-img">
                                <div class="profile-right-img-prev" style="background-image: url({{asset('admins/images/edit-profile-img.png')}});" id="imagePreview"></div>
                                <label class="upload-icon" for="imageUpload">
                                    <img src="{{asset('admins/images/upload-icon.png')}}" alt="">
                                    <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
                                </label>
                            </div>

                            <div class="edit-common-form">
                                <div>
                                    <label for="">
                                        <input type="text" placeholder="Enter Name">
                                    </label>
                                </div>
                                <div>
                                    <label for="">
                                        <input type="text" placeholder="Enter Phone">
                                    </label>
                                </div>
                                <div>
                                    <label for="">
                                        <input type="text" id="datepicker" placeholder="Enter Date of Birth">
                                        <div class="date-img">
                                            <img src="{{asset('admins/images/calender-icon.png')}}" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div>
                                    <label for="" style="height: 83px;">
                                        <textarea placeholder="Enter Bio"></textarea>
                                    </label>
                                </div>
                            </div>

                            <div class="edit-action-wrap">
                                <button type="button">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit popup -- -->


<!-- Delete popup -- -->

<div class="modal fade deleteUsers" id="delete-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <input type="hidden" value="" class="userIds">
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/delete.png')}}" alt="">
                            <h4 class="deleteText">Delete!</h4>
                            <p>Please confirm you want to<br />
                                delete this influencer?</p>
                            <div class="bottom-action-wrap">
                                <button type="button" onclick="deleteUser()">Confirm</button>
                                <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete popup -- -->
@include('admin.layout.footer')
<script>
    $('.profileImg').click(function() {
        var photo = $(this).attr('data-profile');
        $('.profileImgs').attr('src', photo);
    })


    $(document).on('click', '.applyBtn', function() {
        setInterval(function() {
            $('.influencerSearch').submit();
        }, 2000);
    })

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


    $(document).on('click', '.getbio', function() {
        var bio = $(this).attr('data-bio');
        $('.infuBio').text(bio);
        $('#Bio-popup').modal('show');
    })

    $(document).on('click', '.getInfulencerId', function() {
        var infuId = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var baseUrl = "{{url('/')}}";
        if (infuId) {
            if (status == 'Inactive') {
                $('.actionimg').html('<img src="' + baseUrl + '/public/admins/images/accept-green.png" alt="">');
                $('.suspendedText').text('Activate');
                $('.messageMsg').html('Please confirm you want to activate this Influencer?');

            } else {
                $('.actionimg').html('<img src="' + baseUrl + '/public/admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png" alt="">')
                $('.suspendedText').text('Suspend');
                $('.messageMsg').html('Please confirm you want to suspend this Influencer?')
            }

            $('.infuId').val(infuId);
            $('.Suspendspopups').addClass('show')
            $('#suspend-popup').modal('show');
        } else {
            toastr.error("Influencer id not found..");
        }
    })


    function influencerStatus() {
        var userIds = $('.infuId').val();
        //alert()
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

                        toastr.success("Influencer " + response.message);
                        $('#suspend-popup').modal('hide');
                        setInterval(function() {
                            location.reload(true);
                        }, 2000);
                    } else {
                        $('.deleteText').text(response.message);;
                    }
                }
            });
        } else {
            toastr.error("user id not found..");
        }
    }

    //   function deleteUser() {
    //         var userIds = $('.userIds').val();
    //         //alert()
    //         if (userIds) {
    //             $.ajax({
    //                 type: 'post',
    //                 url: "{{url('admin/user-delete')}}",
    //                 data: {
    //                     id: userIds
    //                 },
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 beforeSend: function() {
    //                     $('.deleteText').text('....Please wait');
    //                 },
    //                 success: function(response) {
    //                     if (response.status == 1) {
    //                         $('.delete' + userIds).remove();
    //                         $('.deleteText').text(response.message);
    //                         toastr.success(response.message);
    //                         setInterval(function() {
    //                             $('.deleteText').text('Delete');
    //                         }, 2000);
    //                     } else {
    //                         $('.deleteText').text(response.message);;
    //                     }
    //                 }
    //             });
    //         } else {
    //             toastr.error("user id not found..");
    //         }
    //     }


    $('.deleteUser').click(function() {
        var userId = $(this).attr('data-id');
        if (userId) {
            $('.deleteUsers').addClass('show')
            $('.userIds').val(userId)
            $('#delete-popup').modal('show');
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
        $(".dobDate").datepicker({
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
            setTimeout(function() {

                $('.userForm').submit();
            }, 1000);

        });
    });


    $(document).ready(function() {
        $('.comman1').click(function() {
            if ($(this).is(":checked")) {

                setTimeout(function() {

                    $('.userForm').submit();
                }, 1000);

            }
        });
    });
    $(document).ready(function() {
        $('.comman1').click(function() {
            $('.comman1').not(this).prop('checked', false);
            setTimeout(function() {

                $('.userForm').submit();
            }, 1000);

        });
    });
</script>