@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers My Profile | TidBid</title>
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


                        <div class="left_pinkbg">
                            <div class="people_img"><img src="{{asset('Influencer/images/People-img.png')}}"></div>
                            <p>View People you follow</p>
                            <a href="{{route('Influencer_My_Follower')}}">My Following</a>

                        </div>
                    </div>


                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="">

                            <div class="bookmark-heading">
                                <h1>Bookmarked</h1>
                            </div>
                            <div class="bookmark-wrap row" id="data-wrapper">

                                @include('Influencer.partial-page.book-mark-partial')

                            </div>

                        </div>


                    </div>

                </div>



            </div>
        </div>
        </div>
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
  <div class="modal fade" id="share" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
        <div class="modal-body pt-0 pb-5 ">
          <h1 class="modal-title text-center report-h5">Share </h1>
          <ul class="social_icon">
            <li><a href="https://www.facebook.com/" target="_blank"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
            <li><a href="https://x.com/i/flow/login" target="_blank"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
            <li><a href="https://in.linkedin.com/" target="_blank"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Popup share -->
   

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


    </main>
    <!-- Main-Section -->
    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">




<script>
    function getLike(id) {
        if (id) {
            $.ajax({
                url: "{{('getPost_like')}}",
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
                url: "{{('get-Post-comment')}}",
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
</script>
<script>
    function block_post(id) {
        if (id) {
            $.ajax({
                url: "{{ url('blockPost') }}",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 1) {
                        //  alert('remove-post_'+id)
                        $('#remove-post_' + id).remove(); // Remove the post from the DOM
                        toastr.success(resp.message); // Show success message
                    } else {
                        toastr.error(resp.message); // Show error message
                    }
                }
            });
        } else {
            toastr.error('Post ID required.'); // Show error message if no ID provided
        }
    }

    // loadContent();

    // var ENDPOINT = "{{ url('influencer_bookmark') }}";
    //     var page = 1; 
    //     $(window).scroll(function () {
    //         if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 5)) {
    //             page++;
    //             infinteLoadMorebook(page);
    //         }
    //     });
    //     function infinteLoadMorebook(page) {

    //         $.ajax({
    //                 url: ENDPOINT + "?page=" + page,
    //                 datatype: "html",
    //                 type: "get",
    //                 beforeSend: function () {
    //                     $('#data-wrapper').show();
    //                 }
    //             })
    //             .done(function (response) {
    //                 if (response.html == '') {
    //                     $('.auto-load').html("We don't have more data to display :(");
    //                     return;
    //                 }

    //                 $('#auto-load').hide();
    //                 $("#data-wrapper").append(response.html);
    //             })
    //             .fail(function (jqXHR, ajaxOptions, thrownError) {
    //                 console.log('Server error occured');
    //             });
    //     }
</script>

<!-- block post -->



<script>
    function addBookMark(id) {
        if (id) {
            $.ajax({
                url: "{{url('add-post-book-mark')}}",
                method: 'POST',
                data: {
                    'postid': id
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
                url: "{{url('post-commnet')}}",
                method: "POST",
                data: {
                    'commentValue': commentValue,
                    'postid': postid
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
            url: "{{url('post-like')}}",
            method: "POST",
            data: {
                'postid': id
            },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
    $(document).on('click', '.showbutton', function() {
        var postId = $(this).attr('data-postId');
        //alert(postId);
        // $('.showbutton_' + postId).show();
        $('.showbutton_' + postId).toggle();

    });
</script>


<script>
    function resetForm() {
        document.getElementById('reportform').reset();
    }
    
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
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@php
$postId = [];
foreach($getBlockPost as $block_post){
$postId[] = $block_post->post_id;
}
$book_mark_postId = [];
foreach($getBookMark as $getBookMarks){
$book_mark_postId[] = $getBookMarks->post_id;
}

@endphp
@foreach($postData as $key => $value)
@if (!in_array($value->id, $postId))
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

@endif
@endforeach
<script>
    // Activate the carousel with a specific interval
    $(document).ready(function() {
        $('#demoCarousel').carousel({
            interval: 1 // Adjust the interval time in milliseconds (e.g., 5000 for 5 seconds)
        });
    });
</script>
@endsection