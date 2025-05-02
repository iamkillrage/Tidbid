@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>User Panel Home | TidBid</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
        .post_lgimg.mt-4 {
            width: 100%;
        }

        li.bell-icon {
            display: flex;
            align-items: center;
            margin-top: 6px;
            margin-left: 7px;
        }

        .postright {
            margin-bottom: 30px;
            background: #F9DDEF;
            padding: 30px;
            border-radius: 10px;
            margin-left: 20px;
            position: relative;
        }

        #current-box .owl-dots {
            margin-top: 10px;
            display: flex;
            gap: 5px;
            align-items: center;
            justify-content: center;
        }

        #current-box .owl-dots button.owl-dot {
            width: 10px;
            height: 10px;
            background: #D9D9D9;
            border-radius: 10px;
        }

        #current-box .owl-dots button.owl-dot.active {
            background: #971c93;
        }
    </style>
</head>

<body>

    <!-- Header-Section -->
    <header>

        <!-- BANNER-SECTION -->
        <div class="banner-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="container">
                                <a class="navbar-brand_2" href="{{route('User_Home')}}"><img src="{{asset('Influencer/images/logo.svg')}}" alt=""></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse mt-0" id="navbarNav">

                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{route('User_Home')}}">Home</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{route('UserAboutUs')}}">About</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{route('user_Explore')}}">Explore</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{route('UserUpcomingStream')}}"> My
                                                Upcoming Stream</a>
                                        </li>

                                         <li class="nav-item bg-lightpink text-dark rounded-pill mb-3">
                                        <a class="nav-link" href="{{route('SignIn')}}">For Influencers</a>
                                        </li> 

                                        <li class="nav-item">
                                            <a href="{{ route('User_Profile') }}">
                                                @if(auth()->check() && !empty(auth()->user()->profile_img))
                                                    <img src="{{ asset('Influencer/images/profile_img/' . auth()->user()->profile_img) }}" alt="Profile Image">
                                                @else
                                                    <img src="{{ asset('Influencer/images/dummy.jpg') }}" alt="Default Image">
                                                @endif
                                            </a>
                                        </li>


                                        {{-- Notification --}}
                                        <div class="notification-in">
                                            <button type="button" id="notification_icon"><img src="{{ asset('Influencer/images/bell-icon.png') }}"></button>
                                            <div class="notification-list">
                                                <div class="notification-heading">
                                                    <h1>Notifications</h1>
                                                </div>
                                                <div class="notification-list-inner" id="notification_list">
                                                    <!-- Notifications will be dynamically loaded here -->
                                                </div>
                                            </div>
                                        </div>

                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="banner-inner">
                            <h1>Explore your favourite influencers and grab a Ball of a time!</h1>
                            <p>Welcome to our vibrant live streaming portal - TidBid, where the world comes alive with
                                captivating moments and thrilling experiences. Step into a virtual universe that
                                seamlessly blends entertainment, connection, and boundless creativity. </p>
                            <a href="{{route('user_Explore')}}">View More</a>

                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="header_right">
                            <img src="{{asset('Influencer/images/banner-right.png')}}">
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>
        <div class="main_influncer">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <div class="post_left">
                            <div class="post_h">
                                <h4>Streaming Live </h4>
                            </div>
                            @if ($streamdata->isEmpty())

                            <p style="text-align: center; margin-top:23px;">No streaming live now</p>

                            @else
                            @foreach($streamdata as $value)
                            <!--Item-->
                            <div class="post_sect">
                                <div class="post_img">
                                    <!-- <div class="tag_on"><img src="{{asset('Influencer/images/online_tag.png')}}"></div> -->
                                @if ($value->getInfluencer)
                                    <div class="post_img2">
                                        <img src="{{ asset('Influencer/images/profile_img/' . $value->getInfluencer->profile_img) }}">
                                    </div>
                                @endif

                                    <div class="clear"></div>
                                </div>

                                <div class="post_text">
                                    <h5>{{ $value->streamTitle}} </h5>
                                    <p>{{ implode(' ', array_slice(str_word_count($value->description, 1), 0, 8)) }}....
                                    </p>

                                    <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                                        <p> <?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                                    </div>

                                    {{-- <div class="post_btn"><a href="{{url('user-live-stream/'.$value->id)}}" class="join_btn_1">Join Now</a></div> --}}
                                    @if($value->status == 'Activate')
                                        <div class="post_btn">
                                            <a href="{{url('user-live-stream/'.$value->id)}}" class="join_btn_1">Join Now</a>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <!--Item-->

                            @endforeach
                            @endif
                        </div>

                        <div class="post_left">
                            <div class="post_h">
                                <h4 class="text-center">Refer a Friend</h4>
                            </div>

                            <div class="refer_img"><img src="{{asset('Influencer/images/refer_1.png')}}"></div>

                            <div class="refer_text">
                                <h5>Refer & Earn $10 auction free</h5>
                                <p>Invite your friend to join TidBid and both of you will get $10 for your next auction
                                    absolutely free.</p>
                                <a href="{{route('UserReferFriends')}}"><img src="{{asset('Influencer/images/file-upload.svg')}}">Refer a friend</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="posthead">
                            <h3><b>All Post</b></h3>
                        </div>

                        <!-----------post----------->
                        @include("User.partialPage.User_Home_partial")
                        <!---------post------------>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
    <!-- Main-Section -->

    <!-- Popup Report -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0">
                    <h1 class="modal-title text-center report-h5">Report </h1>
                    <form id="reportform">
                        @csrf
                        <textarea placeholder="Enter reason for reporting" name="description" value="description" class="textarea_sect" required></textarea>
                        <input type="hidden" name="post_id" class="post-id">
                        <button type="submit" class="singup-btn_2 mb-3 mt-3 loginInfu">Submit</button>
                    </form>
                </div>


                {{-- <input type="submit" value="submit" data-bs-dismiss="model" class="mb-5"> --}}

            </div>
        </div>
    </div>
    <!-- Popup Report -->

    <!-- Popup share -->
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

                <div class="modal-body pt-0 ">
                    <h1 class="modal-title text-center report-h5">Share </h1>

                    <ul class="social_icon mb-5">
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


    <div class="modal fade" id="comment_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <h1 class="modal-title text-center report-h5">Comments</h1>
                <div class="modal-body pt-0 pb-5 scrollbar scrollbar2" id="style-2">
                    <div class="like_outr force-overflow post-comment-section">

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--Like Popup -->
    <div class="modal fade" id="like_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <h1 class="modal-title text-center report-h5">Likes</h1>
                <div class="modal-body pt-0 pb-5 scrollbar scrollbar2" id="style-2">
                    <div class="like_outr force-overflow likeed-user">



                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<style>
    .more-content {
        display: none;
    }
</style>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-content').forEach(function(toggleLink) {
            toggleLink.addEventListener('click', function() {
                var lessContent = this.previousElementSibling.previousElementSibling;
                var moreContent = this.previousElementSibling;

                if (moreContent.style.display === 'none') {
                    moreContent.style.display = 'inline';
                    lessContent.style.display = 'none';
                    this.textContent = 'less';
                } else {
                    moreContent.style.display = 'none';
                    lessContent.style.display = 'inline';
                    this.textContent = 'more';
                }
            });
        });
    });
</script>

{{-- Notification Ajax --}}
<script>
    $(document).ready(function() {
       $('#notification_icon').click(function() {

           $.ajax({
               url: "{{ route('notification-user') }}",
               method: 'GET',
               success: function(resp) {
                    // Clear any existing notifications
                    $('#notification_list').empty();
                    
                    if (resp.notifications.length > 0) {
                        $.each(resp.notifications, function(index, notification) {
                            var notificationHTML = `
                                <div class="notification-list-item">
                                    <div class="notification-list-item-text">
                                        <p>` + notification.title + `</p>
                                        <p style="font-size: 12px;">` + notification.message + `</p>
                                        <span><i class="far fa-clock"></i> ` + notification.created_at + `</span>
                                    </div>
                                </div>
                            `;
                            $('#notification_list').append(notificationHTML);
                        });
                    } else {
                        $('#notification_list').html('<p>No notifications available</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
           });
       });
    });
</script>

<script>
    function toggleDropdown(postId) {
        var dropdown = $('#dropdown_' + postId);

        // Hide all other dropdowns
        $('.show-elipse-card').not(dropdown).fadeOut(200);

        // Toggle the clicked dropdown
        dropdown.stop(true, true).fadeToggle(200);
    }

    // Optional: Close the dropdown if clicked outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.elipse-wrap').length) {
            $('.show-elipse-card').fadeOut(200);
        }
    });

    function getLike(id) {
        if (id) {
            $.ajax({
                url: "{{('get-post-like-user')}}",
                method: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(resp) {
                    $('.likeed-user').html(resp.html)
                    $('#like_popup').modal('show');
                }
            })
        }
    }

    function resetForm() {
        document.getElementById('reportform').reset();
    }

    function getPostComment(id) {
        if (id) {
            $.ajax({
                url: "{{('get-post-comment-user')}}",
                method: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(resp) {
                    $('.post-comment-section').html(resp.html)
                    $('#comment_popup').modal('show');
                }
            })
        }
    }

    function block_post(id) {
        if (id) {
            $.ajax({
                url: "{{ url('block-post-user') }}",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp && resp.status == 1) {
                        $('#remove-post' + id).fadeOut(500, function() {
                            $(this).remove(); // Remove the post from the DOM after fading out
                        });
                        toastr.success(resp.message); // Show success message
                    } else {
                        toastr.error(resp && resp.message ? resp.message :
                            'Failed to block post.'); // Show error message
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to block post: ' + error); // Show error message
                }
            });
        } else {
            toastr.error('Post ID required.'); // Show error message if no ID provided
        }
    }

    function addBookMark(id) {
        if (id) {
            $.ajax({
                url: "{{url('add-post-book-mark-user')}}",
                method: 'GET',
                data: {
                    'postid': id
                },
                dataType: 'json',
                //         headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                success: function(data) {
                    if (data.status == 1) {
                        $('.bookmarkclass_' + id).removeClass('far fa-bookmark');
                        $('.bookmarkclass_' + id).addClass('fa fa-bookmark');
                        toastr.success(data.message);
                    } else {
                        $('#remove-post_' + id).remove();
                        $('.bookmarkclass_' + id).removeClass('fa fa-bookmark');
                        $('.bookmarkclass_' + id).addClass('far fa-bookmark');

                        toastr.success(data.message);
                    }
                }
            })
        } else {
            toastr.error('post id required..');
        }
    }

    /** post comment */
    $(document).on('click', '.postComment', function() {
        var commentValue = $(this).closest('.post_search').find('.comment-text').val();
        var postid = $(this).attr('data-postId');
        if (commentValue != '' && postid != '') {
            $('.comment-text').val('');
            $.ajax({
                url: "{{url('post-commnet-user')}}",
                method: "GET",
                data: {
                    'commentValue': commentValue,
                    'postid': postid
                },
                dataType: "json",
                //   headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                success: function(data) {
                    if (data.status == true) {
                        $('.totalComment_' + postid).text(data.totalComment);
                        //  $(this).closest('.post_search').find('.comment-text').val('');
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            })

        } else {
            toastr.error('plese enter comment');
        }
    });

    function likePost(id) {
        $.ajax({
            url: "{{url('post-like-user')}}",
            method: "GET",
            data: {
                'postid': id
            },
            dataType: "json",
            //   headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            success: function(data) {
                if (data.status == 1) {
                    $('.addClass_' + id).removeClass('far fa-heart');
                    $('.addClass_' + id).addClass('fa fa-heart');
                    $('.postLike_' + id).text(data.totalLike);
                    toastr.success(data.message);

                } else if (data.status == 2) {
                    $('.addClass_' + id).removeClass('fa fa-heart');
                    $('.addClass_' + id).addClass('far fa-heart');
                    $('.postLike_' + id).text(data.totalLike);
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        })
    }
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.report-click', function() {
            var post_id = $(this).data('id');
            $('.post-id').val(post_id);

        });

        $('#reportform').submit(function(e) {

            e.preventDefault();
            // alert('hi');
            $.ajax({
                url: "{{ route('Post_Report') }}",
                type: 'POST', // Change GET to POST
                data: $(this).serialize(),
                success: function(response) {
                    $('#exampleModal').modal('hide');
                    toastr.success('You have report successfully this post');
                    $('.textarea_sect').val('');
                    // window.location.href = "{{ route('Influencer_index') }}";
                    location.reload();

                },
                    error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    var ENDPOINT = "{{ url('user-home') }}";
    var page = 1;
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 5)) {
            page++;
            infinteLoadMorebook(page);
        }
    });

    function infinteLoadMorebook(page) {

        $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('#data-wrapper').show();
                }
            })
            .done(function(response) {
                if (response.html == '') {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }

                $('#auto-load').hide();
                $("#data-wrapper").append(response.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
<script>
    $(document).ready(function() {
        // Listen for click on show button
        $('[class^="showbutton_"]').click(function() {
            var id = $(this).attr('class').split('_').pop();
            console.log('id', id);
            var elipseCard = $('.show-elipse-card_' + id).toggle();
        });
    });
</script>

<!-- Slide Js -->
@if(count($postData) > 0)
@foreach($postData as $key=>$value)

@if(!in_array($value->id, $getBlockPost))
@push('page_script')
<script>
    $(document).ready(function() {
        $("#current-box-{{$key}}").owlCarousel({
            items: 1,
            loop: false,
            center: false,
            autoplay: false,
            margin: 20,
            dots: true,
            nav: true,
            rewind: true,
            autoplayTimeout: 3000,
            autoplaySpeed: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 1,
                }
            }
        });
        $(".owl-prev").html('<i class="far fa-chevron-left"></i>');
        $(".owl-next").html('<i class="far fa-chevron-right"></i>');
    });
</script>
@endpush
@endif
@endforeach
@endif
@endsection