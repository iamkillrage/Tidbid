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
                                <form method="GET" action="" class="streamForm">
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
                    </form>

                </div>
            </div>
        </div>
        <div class="influ-table">
            <div id="table-responsive-1" class="table-responsive">
                <table>
                    <tr>
                        <th>S.No.</th>
                        <th>Influencer Name</th>
                        <th>Stream Title</th>
                        <th>Date of Stream</th>
                        <th>Time of Stream</th>
                        <th>About Stream</th>
                        <th>Base Bid Price</th>
                        <th>Current Bid</th>
                        <th>Gift Received</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @if(count($streamData) > 0)
                        @foreach($streamData as $index => $row)
                        <tr>
                            <td>{{ $streamData->firstItem() + $index}}.</td>
                            <td> {{ $row->getInfluencer->name}}</td>
                            <td>{{ $row->streamTitle }}</td>
                            <td>{{ date("m/d/Y", strtotime($row->streamDate)) }}</td>
                            <td>{{ date("H:i A", strtotime($row->streamTime)) }}</td>
                            <td><a href="javascript:void(0)" data-about="{{ $row->description }}" class="show-modal aboutmodel" data-toggle="modal" data-target="#Bio-popup">View</a></td>
                            <td>{{ $row->baseBidPrice}}k</td>
                            <td>20k</td>
                            <td><a href="#" class="show-modal" data-toggle="modal" data-target="#socialmedia-popup">200</a></td>
                            <td>

                                @if ($row->id == 2 || $row->id == 4 || $row->id == 6 || $row->id == 8 || $row->id == 10 || $row->id == 12 || $row->id == 14 || $row->id == 16 || $row->id == 18)
                                <div class="live-and-view-wrap">
                                    <button><img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/dot-image.png')}}" alt="" class="src">
                                        Live</button>
                                    <button><img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/Views-Icon.png')}}" alt="" class="src">
                                        5k</button>
                                </div>
                                @else
                                <div class="disable-live-and-view-wrap">
                                    <button><img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/dot-image.png')}}" alt="" class="src">
                                        Live</button>
                                    <button><img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/Views-Icon.png')}}" alt="" class="src">
                                        22k</button>
                                </div>
                                @endif
                            </td>
                            <td>

                                <a href="#" class="show-modal" data-toggle="modal" data-target="#edit-popup_{{$row->id}}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/edit.png')}}" alt=""></a>

                                <!-- Edit popup -- -->

                                <div class="modal fade" id="edit-popup_{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-dialog-edit" role="document">
                                        <div class="modal-content clearfix">
                                            <div class="modal-heading">
                                                <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="addpayment-card-form">
                                                    <form method="post" action="{{url('admin/editStream')}}">
                                                        @csrf
                                                        <input type="hidden" name="stream_id" value="{{ $row->id  }}">
                                                        <div class="edit-card-wrap">
                                                            <h4 class="suspendedText">Edit</h4>

                                                            <div class="edit-common-form">

                                                                <div>
                                                                    <label for="">
                                                                        <input type="text" placeholder="Stream Title" name="streamTitle" value="{{ $row->streamTitle }}">
                                                                    </label>
                                                                </div>

                                                                <div class="layoff-date-time-wrap">
                                                                    <div class="date-sec">

                                                                        <label for="">
                                                                            <input type="text" class="dobDate" placeholder="Enter Date of Birth" name="streamDate" value="{{$row->streamDate}}">
                                                                            <div class="date-img">
                                                                                <img src="{{asset('admins/images/calender-icon.png')}}" alt="">
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="time-sec">
                                                                        <label for="">
                                                                            <input type="time" placeholder="Enter Name" name="streamTime" value="{{ $row->streamTime }}">
                                                                        </label>
                                                                    </div>
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
                                <a href="javascript:void(0);" data-status="{{$row->status}}" class="changeStatus" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/checked.png')}}" alt=""></a>
                                @else
                                <a href="javascript:void(0);" data-status="{{$row->status}}" class="changeStatus" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/disabled.png')}}" alt=""></a>
                                @endif
                               
                                <a href="#" class="show-modal deletestream" data-toggle="modal" data-target="#delete-popup" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/trash.png')}}" alt=""></a>

                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="12"> No data found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-felx justify-content-center">


            </div>

            <div class="d-felx justify-content-center">
                {{ $streamData->onEachSide(1)->withQueryString()->links('admin.layout.pegination') }}

            </div>


        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

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
                        <h2>About Stream</h2>
                        <div class="biopopup-wrap">
                            <p class="aboutStrem"></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bio popup -- -->

<!-- gifts popup -- -->

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
                        <h2>Gifts</h2>
                        <div class="following-wrap">

                            <!-- followers -->
                            <div class="giftsmain-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/icon2.png')}}" alt="" class="src">
                                    <p>Danny</p>
                                </div>
                                <div class="gift-box-warp">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/gift-icon.png')}}" alt="">
                                    <p>$5</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="giftsmain-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/icon4.png')}}" alt="" class="src">
                                    <p>Robin</p>
                                </div>
                                <div class="gift-box-warp">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/gift-icon.png')}}" alt="">
                                    <p>$5</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="giftsmain-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/icon3.png')}}" alt="" class="src">
                                    <p>Cody Fisher</p>
                                </div>
                                <div class="gift-box-warp">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/gift-icon.png')}}" alt="">
                                    <p>$5</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="giftsmain-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/icon1.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                                <div class="gift-box-warp">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/gift-icon.png')}}" alt="">
                                    <p>$5</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="giftsmain-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/icon5.png')}}" alt="" class="src">
                                    <p>Wade Warren</p>
                                </div>
                                <div class="gift-box-warp">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/stream-manage-imgs/gift-icon.png')}}" alt="">
                                    <p>$5</p>
                                </div>
                            </div>
                            <!-- followers -->

                        </div>

                </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- gifts popup -- -->


<!-- Suspend popup -- -->

<!-- <div class="modal fade" id="suspend-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png')}}" alt="">
                                <h4>Suspend!</h4>
                                <p>Please confirm you want to<br />
                                    deactivate this stream.</p>
                                <div class="bottom-action-wrap">
                                    <button type="submit" onclick="deleteStream()">Confirm</button>
                                    <button type="submit">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!-- Suspend popup -- -->

<div class="modal fade suspendedStream" id="suspend-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

                        <span class="actionimg"> <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png')}}" alt=""></span>
                            <h4 class="suspendedText" >Suspend!</h4>
                            <p class="messageMsg"></p>
                            <div class="bottom-action-wrap">
                                <input type="hidden" class="postIds">
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
                        <input type="hidden" value="" class="streamId">
                        <div class="payment-card-wrap">
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/delete.png')}}" alt="">
                            <h4 class="deleteText">Delete!</h4>
                            <p>Please confirm you want to<br />
                                delete this stream.</p>
                            <div class="bottom-action-wrap">
                                <button type="button" onclick="deleteStream()">Confirm</button>
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




<!-- Active popup -- -->

<div class="modal fade" id="active-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <input type="hidden" value="" class="stremId"> 
                            <div class="payment-card-wrap">
                                <img src="{{asset('admins/images/Tidbid-images/all-icons/verification-manage-imgs/checked.png')}}" alt="">
                                <h4 class="suspendedText">Accept</h4>
                                <p>Please confirm you want to<br />
                                    active this stream.</p>
                                <div class="bottom-action-wrap">
                                    <button type="button" onclick="stremStatus()">Confirm</button>
                                    <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Active popup -- -->


@include('admin.layout.footer')
<script>
    $(document).on('click', '.applyBtn', function() {
        setInterval(function() {
            $('.streamForm').submit();
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

    $(document).on('click', '.aboutmodel', function() {
        var aboutmodel = $(this).attr('data-about');
        $('.aboutStrem').text(aboutmodel);
    })


    $(document).on('click', '.deletestream', function() {
        var stremId = $(this).attr('data-id');
        $('.streamId').val(stremId);

    })

    function deleteStream() {
        var streamId = $('.streamId').val();
        //alert()
        if (streamId) {
            $.ajax({
                type: 'post',
                url: "{{url('admin/delete-stream')}}",
                data: {
                    id: streamId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // beforeSend: function() {
                //     $('.deleteText').text('....Please wait');
                // },
                success: function(response) {
                    if (response.status == 1) {
                        // $('.deleteText').text(response.message);
                        // toastr.success(response.message);
                        // setInterval(function() {
                        //     $('.deleteText').text('Delete');
                        //     location.reload(true)
                        // }, 2000);
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
            toastr.error("stream id not found..");
        }
    }


    $('.changeStatus').click(function() {
        var streamId = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var baseUrl = "{{url('/')}}";
        if (streamId) {
            if (status == 'Inactive') {
                $('.actionimg').html('<img src="'+baseUrl+'/public/admins/images/accept-green.png" alt="">');
                $('.suspendedText').text('Activate');
                $('.messageMsg').html('Please confirm you want to activate this Stream?')

            } else {
                $('.actionimg').html('<img src="'+baseUrl+'/public/admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png" alt="">')
                $('.suspendedText').text('Suspend');
                $('.messageMsg').html('Please confirm you want to suspend this Stream?')
            }
            $('.suspendedStream').addClass('show')
            $('.streamId').val(streamId)
            $('#suspend-popup').modal('show');
        } else {
            toastr.error("post id not founddddd..");
        }
    })


    function changeStatus() {
        var streamId = $('.streamId').val();
        if (streamId) {
            $.ajax({
                type: 'post',
                url: "{{url('admin/change-stream-status')}}",
                data: {
                    id: streamId
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
                        // toastr.success(response.message);
                        // setInterval(function() {
                        //     location.reload(true);
                        // }, 2000);
                         toastr.success(response.message);
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
            toastr.error("stream id not found..");
        }
    }
</script>


<script>
    // $(function() {
    //     $(".dobDate").datepicker();
    //    // $("#datepicker2").datepicker();
    // });
    $(function() {
  $(".dobDate").datepicker({
    dateFormat: "yy-mm-dd" // Change the date format here
  });
});
</script>