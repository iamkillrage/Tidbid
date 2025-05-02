@include('admin.layout.header')


<!-- NAVBAR -->



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
                                <form action="" method="get" class="bidForm">
                                    <input type="text" id="input-box" name="searchTerm" value="{{ request()->searchTerm }}" placeholder="Search by Name" autocomplete="off">
                                    <button type="submit"><img src="{{asset('admins/images/Tidbid-images/all-icons/search.png')}}" alt=""></button>
                                </form>
                            </div>
                        </div>

                    </div>

                    <form method="GET" action="" class="bidForm">
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
                        <th>Title of Stream</th>
                        <th>Date of Stream</th>
                        <th>Time of Stream</th>
                        <th>About Stream</th>
                        <th>Base Bid Price</th>
                        <th>Win Bid Price</th>
                        <th>Winner</th>
                        <th>Results</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @foreach($latestRecords as $index => $row)
                        <tr>
                            <td>{{ $latestRecords->firstItem() + $index}}.</td>
                            <td>{{ $row->getInfluencer->name }}</td>
                            <td>{{ $row->getStream->streamTitle }}</td>
                            <td> {{ date('m/d/Y', strtotime($row->getStream->streamDate))}}</td>
                            <td>{{ date("h:i A", strtotime($row->getStream->streamTime)) }}</td>
                            <td><a href="javascript:void(0)" data-about="{{ $row->getStream->description }}" class="show-modal getabout" data-toggle="modal" data-target="#Bio-popup">View</a></td>
                            <td>5k</td>
                            <td>20k</td>
                            <td>{{ $row->getUser->name }}</td>
                            <td>
                                Lorem Ipsum
                            </td>
                            <td>
                                <a href="#" class="show-modal" data-toggle="modal" data-target="#edit-popup_{{$row->id}}">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/edit.png')}}" alt=""></a>
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
                                                    <form method="post" action="{{url('admin/editBid')}}">
                                                        @csrf
                                                        <input type="hidden" name="bid_id" value="{{ $row->getStream->id }}">
                                                        <div class="edit-card-wrap">
                                                            <h4 class="suspendedText">Edit</h4>

                                                            <div class="edit-common-form">

                                                                <div>
                                                                    <label for="">
                                                                        <input type="text" placeholder="Stream Title" name="streamTitle" value="{{ $row->getStream->streamTitle }}">
                                                                    </label>
                                                                </div>

                                                                <div class="layoff-date-time-wrap">
                                                                    <div class="date-sec">

                                                                        <label for="">
                                                                            <input type="text" class="dobDate" placeholder="Enter Date" name="streamDate" value="{{$row->getStream->streamDate}}">
                                                                            <div class="date-img">
                                                                                <img src="{{asset('admins/images/calender-icon.png')}}" alt="">
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="time-sec">
                                                                        <label for="">
                                                                            <input type="time" placeholder="Enter Name" name="streamTime" value="{{ $row->getStream->streamTime }}">
                                                                        </label>
                                                                    </div>
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

                                @if($row->status == 'Activate')
                                <a href="javascript:void(0);" data-status="{{$row->status}}" class="changeStatus" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/checked.png')}}" alt=""></a>
                                @else
                                <a href="javascript:void(0);" data-status="{{$row->status}}" class="changeStatus" data-id="{{ $row->id }}"><img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/disabled.png')}}" alt=""></a>
                                @endif

                                <a href="#" class="show-modal deleteBid deleteUser" data-userid="{{ $row->user_id }}" data-infulencerid="{{ $row->infulencer_id }}" data-biddate="{{ $row->bid_date }}" data-streamId="{{ $row->stream_id }}" data-toggle="modal" data-target="#delete-popup">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/trash.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>



                </table>
            </div>
            <!-- <p>Showing 50 of 170 results</p> -->
            <div class="d-felx justify-content-center">
                {{ $latestRecords->onEachSide(1)->withQueryString()->links('admin.layout.pegination') }}

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
                            <p class="aboutus"> </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bio popup -- -->

<!-- Active popup -- -->

<!-- <div class="modal fade suspendedUser" id="active-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <span class="actionimg">  <img src="images/Tidbid-images/all-icons/verification-manage-imgs/checked.png" alt=""></span>
                            <h4>Accept</h4>
                            <p>Please confirm you want to<br />
                                active this stream.</p>
                            <div class="bottom-action-wrap">
                                <button type="submit" onclick="changeStatus()">Confirm</button>
                                <button type="submit">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Active popup -- -->






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
                        <span class="actionimg"> <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png')}}" alt=""></span>
                        <h4 class="suspendedText" >Suspend!</h4>
                            <p class="messageMsg"></p>
                            <div class="bottom-action-wrap">

                                <input type="hidden" class="bidIds">

                                <button type="submit" onclick="changeStatus()">Confirm</button>
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

                        <input type="hidden" value="" class="userIds">
                        <input type="hidden" value="" class="userId">
                        <input type="hidden" value="" class="infulencer_id">
                        <input type="hidden" value="" class="stream_id">
                        <input type="hidden" value="" class="bid_date">
                        <div class="payment-card-wrap">
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/delete.png')}}" alt="">
                            <h4 class="deleteText">Delete!</h4>
                            <p>Please confirm you want to<br />
                                delete this Bid.</p>
                            <div class="bottom-action-wrap">
                                <button type="button" onclick="deletebid()">Confirm</button>
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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script>
    $(document).on('click', '.getabout', function() {
        var about = $(this).attr('data-about');
        $('.aboutus').text(about)
    })

    $(document).on('click', '.applyBtn', function() {
        setInterval(function() {
            $('.bidForm').submit();
        }, 1000);
    })
    $(document).on('click', '.applyBtn', function() {
        setTimeout(function() {

            $('.bidForm').submit();
        }, 1000);
    })
    $(document).on('click', '.cancelBtn', function() {
        setTimeout(function() {

            $('.bidForm').submit();
        }, 1000);
    })

    $(document).on('click', '.deleteBid', function() {
        var UserId = $(this).attr('data-userid');
        var infulencerid = $(this).attr('data-infulencerid');
        var biddate = $(this).attr('data-biddate');
        var streamId = $(this).attr('data-streamId');

        $('.userId').val(UserId);
        $('.infulencer_id').val(infulencerid);
        $('.bid_date').val(biddate);
        $('.stream_id').val(streamId)
    })

    function deletebid() {
        var userIds = $('.userId').val();
        var infulencer_id = $('.infulencer_id').val();
        var bid_date = $('.bid_date').val();
        var stream_id = $('.stream_id').val();
        //alert()
        if (userIds != '' && infulencer_id != '' && bid_date != '' && stream_id != '') {
            $.ajax({
                type: 'post',
                url: "{{url('admin/delete-bid')}}",
                data: {
                    user_id: userIds,
                    infulencer_id: infulencer_id,
                    bid_date: bid_date,
                    stream_id: stream_id
                },
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
            toastr.error("All peremeter are required..");
        }
    }

    // $('.changeStatus').click(function() {
        $(document).on('click', '.changeStatus', function() {
        var bidId = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var baseUrl = "{{url('/')}}";
        if (bidId) {
            if (status == 'Inactive') {
                $('.actionimg').html('<img src="'+baseUrl+'/public/admins/images/accept-green.png" alt="">');
                $('.suspendedText').text('Activate');
                $('.messageMsg').html('Please confirm you want to activate this Bid?')

            } else {
                $('.actionimg').html('<img src="'+baseUrl+'/public/admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png" alt="">')
                $('.suspendedText').text('Suspend');
                $('.messageMsg').html('Please confirm you want to suspend this Bid?')
            }
            $('.suspendedUser').addClass('show')
            $('.bidIds').val(bidId)
            $('#suspend-popup').modal('show');
        } else {
            toastr.error("bid id not found..");

        }
    })


    function changeStatus() {
        var bidIds = $('.bidIds').val();
        if (bidIds) {
            $.ajax({
                type: 'post',
                url: "{{url('admin/change-bid-status')}}",
                data: {
                    id: bidIds
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // beforeSend: function() {
                //     $('.suspendedText').text('....Please wait');
                // },
                success: function(response) {
                    if (response.status == 1) {
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
            toastr.error("bid id not found..");
        }
    }

    $(function() {
  $(".dobDate").datepicker({
    dateFormat: "yy-mm-dd" // Change the date format here
  });
});
</script>