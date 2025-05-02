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
                                <form method="GET" action="">
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
                        <th>Post Title</th>
                        <th>Date of Post</th>
                        <th>Time of Post</th>
                        <th>Picture Posted</th>
                        <th>Likes</th>
                        <th>Comments</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <tr>
                            @foreach($post as $index => $row)
                        <tr>
                            <td>{{ $post->firstItem() + $index}}.</td>
                            <td>{{ isset($row->getInfluencer->name) ? $row->getInfluencer->name :''}}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ date("m/d/Y", strtotime($row->created_at)) }}</td>
                            <td>{{ date("H:i:s", strtotime($row->created_at)) }}</td>
                            <td>

                                <a href="javascript:void(0)" class="view-profile-photo show-modal" data-toggle="modal" data-target="#postpicture-popup">
                                    <img src="{{ asset('admins/images/Tidbid-images/all-icons/profile-images/1.png') }}" alt="">
                                </a>
                            </td>
                            <td><a href="javascript:void(0)" class="show-modal" data-toggle="modal" data-target="#likes-popup">20k</a></td>
                            <td><a href="javascript:void(0)" class="show-modal" data-toggle="modal" data-target="#comments-popup">20k</a></td>

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
                                                    <form method="post" action="{{url('admin/editPost')}}">
                                                        @csrf
                                                        <input type="hidden" name="post_id" value="{{ $row->id  }}">
                                                        <div class="edit-card-wrap">
                                                            <h4 class="suspendedText">Edit</h4>

                                                            <div class="edit-common-form">

                                                                <div>
                                                                    <label for="">
                                                                        <input type="text" placeholder="Stream Title" name="streamTitle" value="{{ $row->title }}">
                                                                    </label>
                                                                </div>

                                                                <div class="layoff-date-time-wrap">
                                                                    <div class="date-sec">

                                                                        <label for="">
                                                                            <input type="text" class="dobDate" placeholder="Enter Date" name="streamDate" value="{{ date("m/d/Y", strtotime($row->created_at)) }}">
                                                                            <div class="date-img">
                                                                                <img src="{{asset('admins/images/calender-icon.png')}}" alt="">
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="time-sec">
                                                                        <label for="">
                                                                            <input type="time" placeholder="Enter Name" name="streamTime" value="{{ date("H:i:s", strtotime($row->created_at)) }}">
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
                                <!-- <a href="#" class="show-modal deleteBid deleteUser deletePost" data-userid="{{ $row->user_id }}" data-infulencerid="{{ $row->infulencer_id }}" data-biddate="{{ $row->bid_date }}" data-streamId="{{ $row->stream_id }}" data-toggle="modal" data-target="#delete-popup">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/trash.png')}}"  class="deletePost" alt=""></a> -->



                                <a href="#" class="show-modal deletePost" data-id="{{ $row->id }}" data-toggle="modal" data-target="#delete-popup">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/action-icons/trash.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach


                        </tr>
                    </tbody>



                </table>
            </div>
        </div>
        <div class="d-felx justify-content-center">
            {{ $post->onEachSide(1)->withQueryString()->links('admin.layout.pegination') }}
        </div>



        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->


<!-- Following popup -- -->

<div class="modal fade" id="likes-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <h2>Likes</h2>
                        <div class="following-wrap">

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon3.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
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
</div>

<!-- Following popup -- -->


<!-- Active popup -- -->

<!-- <div class="modal fade" id="active-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/verification-manage-imgs/checked.png')}}" alt="">
                            <h4>Accept</h4>
                            <p>Please confirm you want to<br />
                                active this post.</p>
                            <div class="bottom-action-wrap">
                                <button type="submit">Confirm</button>
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


<!-- Comments popup -- -->

<div class="modal fade" id="comments-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <h2>Comments</h2>
                        <div class="following-wrap">

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                    <div class="social-detail-wrap">
                                        <p>Kathryn Murphy
                                        <blockquote>2m</blockquote>
                                        </p>
                                        <a href="javascript:void(0);">Nice Pic</a>
                                    </div>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon3.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon1.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
                                </div>
                            </div>
                            <!-- followers -->

                            <!-- followers -->
                            <div class="follow-inner-wrap">
                                <div class="image-name">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/icon2.png')}}" alt="" class="src">
                                    <p>Kathryn Murphy</p>
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
</div>

<!-- Comments popup -- -->



<!-- Post Picture popup -- -->

<div class="modal fade" id="postpicture-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Carousel indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for carousel items -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/post-management-imgs/1.png')}}" class="img-fluid" alt="">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                        ligula eget dolor. Aenean massa</p>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/post-management-imgs/1.png')}}" class="img-fluid" alt="">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                        ligula eget dolor. Aenean massa</p>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{asset('admins/images/Tidbid-images/all-icons/post-management-imgs/1.png')}}" class="img-fluid" alt="">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                        ligula eget dolor. Aenean massa</p>
                                </div>
                            </div>
                            <!-- Carousel controls -->
                            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post Picture popup -- -->

<!-- Suspend popup -- -->
<div class="modal fade suspendedPost" id="suspend-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

                        <input type="hidden" value="" class="userIds">
                        <input type="hidden" class="postIds">
                        <input type="hidden" value="" class="infulencer_id">
                        <input type="hidden" value="" class="stream_id">
                        <input type="hidden" value="" class="bid_date">
                        <div class="payment-card-wrap">
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/user-mangement-imgs/delete.png')}}" alt="">
                            <h4 class="deleteText">Delete!</h4>
                            <p>Please confirm you want to<br />
                                delete this post.</p>
                            <div class="bottom-action-wrap">

                                <input type="hidden" class="postIds">

                                <button type="button" onclick="deletePost()">Confirm</button>
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
    $(document).on('click', '.GetBio', function() {
        var bio = $(this).attr('data-bio');
        $('#myParagraphBio').text(bio);

    })

    $(document).on('click', '.applyBtn', function() {
        setTimeout(function() {
            $('.userForm').submit();
        }, 1000);
    })



    $(document).on('click', '.deletePost', function() {
        var postId = $(this).attr('data-id');
        if (postId) {
            $('.deletePosts').addClass('show')
            $('.postIds').val(postId)
            $('#delete-popup').modal('show');
        } else {
            toastr.error("post id not found..");
        }
    })


    function deletePost() {
        var postIds = $('.postIds').val();
        if (postIds) {
            $.ajax({
                type: 'post',
                url: "{{url('admin/delete-post')}}",
                data: {
                    id: postIds
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
            toastr.error("post id not found..");
        }
    }




    // $('.changeStatus').click(function() {
        $(document).on('click', '.changeStatus', function() {
        var postId = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var baseUrl = "{{url('/')}}";
        if (postId) {
            if (status == 'Inactive') {
                $('.actionimg').html('<img src="'+baseUrl+'/public/admins/images/accept-green.png" alt="">');
                $('.suspendedText').text('Activate');
                $('.messageMsg').html('Please confirm you want to activate this Post?')

            } else {
                $('.actionimg').html('<img src="'+baseUrl+'/public/admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png" alt="">')
                $('.suspendedText').text('Suspend');
                $('.messageMsg').html('Please confirm you want to suspend this Post?')
            }
            $('.suspendedPost').addClass('show')
            $('.postIds').val(postId)
            $('#suspend-popup').modal('show');
        } else {
            toastr.error("post id not founddddd..");
        }
    })


    function changeStatus() {
        var postIds = $('.postIds').val();
        if (postIds) {
            $.ajax({
                type: 'post',
                url: "{{url('admin/change-post-status')}}",
                data: {
                    id: postIds
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
            toastr.error("post id not found..");
        }
    }
        $(function() {
  $(".dobDate").datepicker({
    dateFormat: "yy-mm-dd" // Change the date format here
  });
});
</script>