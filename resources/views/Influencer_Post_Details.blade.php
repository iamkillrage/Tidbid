@extends('User.LayoutWebsite.masterwebsite')
@section('content')

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers Details Posts | TidBid</title>
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
        @if(auth()->check())
        @include('User.Navbar.nav')
        @else
        @include('Navbar1.nav1')
        @endif
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>
        <section class="influ_profile">
            <div class="container">
                <div class="row influ_bg">
                    @foreach($postdata as $value)
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 ">
                        <div class="profile_box">
                            <div class="profile_img"><img src="{{ asset('Influencer/images/profile_img/' . ($value->profile_img )) }}"></div>
                            <div class="profile_text">
                                <h5>{{$value->name}}</h5>
                                <p>{{$value->bio}} </p>
                            </div>

                            <div class="follow_sect">
                                <p class="text_follow"><b class="text-dark">{{$value->upcomingstreamcount ? count($value->upcomingstreamcount) : 0 }}
                                    </b>Upcoming Streams</p>
                                <p class="text_follow"><b class="text-dark">{{$value->followerscount ? count($value->followerscount) : 0 }}
                                    </b>Followers</p>
                            </div>
                            @endforeach

                            <div class="follow_btn">
                                @if($checkFollow)
                                <a href="javascript:void(0)" data-userId="{{$postdata[0]->id }}" data-url="{{url('/')}}" class="userFollow">Followed</a>
                                @else
                                <a href="javascript:void(0)" data-userId="{{$postdata[0]->id }}" data-url="{{url('/')}}" class="userFollow">Follow</a>
                                @endif
                            </div>


                        </div>
                    </div>

                    <!-- <div class="col-lg-3">
                        <div class="chat_btn"><a href="{{url('user-chat/{id}')}}">Chat <img src="{{asset('Influencer/images/chat.svg')}}"></a></div>
                    </div> -->
                </div>
            </div>
        </section>

        <div class="main_influncer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav nav-tabs1 mb-5" style="padding: 13px 0px 13px 0px;">
                            <li>
                                <a href="{{ url('influencer-stream-details', ['id' => request()->segment(2)]) }}" class="nav-link1   @if(request()->segment(1) == 'influencer-stream-details')active @endif">Streams</a>
                            </li>

                            <li>
                                <a href="{{ url('influencer-post-details', ['id' => request()->segment(2)]) }}" class="nav-link1   @if(request()->segment(1) == 'influencer-post-details')active @endif">Posts</a>
                            </li>

                            <li>
                                <a href="{{ url('influencer-shedule-details',['id' => request()->segment(2)]) }}" class="nav-link1  @if(request()->segment(1) == 'influencer-shedule-details') active @endif">
                                    Schedule</a>
                            </li>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12 ">
                        <div class="post_left">
                            <div class="post_h">
                                <h4>Past Streams</h4>
                            </div>

                            <!--Item-->
                            @if ($paststream->isEmpty())

                            <p style="margin-left:102px; margin-top:10px;">No Data Found !</p>


                            @else
                            @foreach($paststream as $value)

                            <div class="post_sect">
                                <div class="post_img"><img src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
                                <div class="post_text">
                                    <h5>{{$value->streamTitle}} <a href="influencers-my-streams-details.html" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon1.svg')}}"></a></h5>
                                    <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 20)) }}....
                                    </p>

                                    <!-- <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                                        <p>Upcoming Streams</p>
                                    </div> -->
                                    <div class="Post_icon">
                                        <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt=""><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                                        </p>
                                        <!-- <p class="gray_text"><i class="far fa-clock"></i> {{$value->streamTime}}</p> -->
                                    </div>
                                    <div class="post_btn"><a href="{{route('MyStreamDetails',['id' => $value->id])}}">View Details</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            <!--Item-->


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
                                <a href="#"><img src="{{asset('Influencer/images/file-upload.svg')}}">Refer a friend</a>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="posthead">
                            <h3>All Post </h3>
                        </div>



                        <div class="influencer-post">
                            @include('Partial.Influencer_Post_Details_Partial')
                        </div>



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

                <div class="modal-body pt-0 pb-5 ">
                    <h1 class="modal-title text-center report-h5">Share </h1>

                    <ul class="social_icon">
                        <li><a href="https://www.facebook.com/" target="_blank"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
                        <li><a href="https://www.instagram.com/accounts/login/" target="_blank"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                        <li><a href="https://twitter.com/?lang=en" target="_blank"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
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

</html>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).on('click', '.userFollow', function() {
        var influencerId = $(this).attr('data-userId');
        var url = $(this).attr('data-url');
        var role = 'user';
        if (influencerId != '' && url != '' && role != '') {
            $.ajax({
                url: url + '/follower-users',
                method: "GET",
                data: {
                    influencerId: influencerId,
                    role: role
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 'false') {
                        toastr.error('Please login first to follow this Influencer');
                        return false;
                    }

                    if (resp.status == 1) {
                        $('.userFollow').text('Followed');
                        toastr.success(resp.message);
                        window.location.reload(true);

                    }
                    if (resp.status == 2) {
                        $('.userFollow').text('Follow');
                        toastr.success(resp.message);
                        window.location.reload(true);
                    }
                    if (resp.status == 0) {
                        toastr.error('All input field are required..');
                    }

                }
            })

        } else {
            toastr.error('All input field are required..');
        }


        // Now you can use influencerId variable to perform further actions
    });
</script>

<script>
    function resetForm() {
        document.getElementById('reportform').reset();
    }

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
                url: "{{url('get-post-like-user')}}",
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


    function getPostComment(id) {
        if (id) {
            $.ajax({
                url: "{{url('get-post-comment-user')}}",
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
            //   alert('hi');
            $.ajax({
                url: "{{ route('Post_Report') }}",
                type: 'POST', // Change GET to POST
                data: $(this).serialize(),
                success: function(response) {
                    $('#exampleModal').modal('hide');
                    toastr.success('You have report successfully this post');
                    $('.textarea_sect').val('');
                    // window.location.href = "{{ route('Influencer_index') }}";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    var ENDPOINT = "{{ url('influencer-post-details/'.$id) }}";
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
@if(count($postDatas) > 0)
@foreach($postDatas as $key=>$value)

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