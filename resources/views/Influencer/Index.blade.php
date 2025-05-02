@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Influencers Home Post Option-2 | TidBid</title>

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
    <!-- NAV-STRIP -->

    <!-- NAV-STRIP -->
    <!-- BANNER-SECTION -->
    <div class="banner-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="container">
                <a class="navbar-brand_2" href="{{route('Influencer_index')}}"><img src="{{asset('Influencer/images/logo.svg')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-0" id="navbarNav">

                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link text-dark" href="{{route('Influencer_index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white" href="{{route('Influencer_About_us')}}">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white" href="{{route('Influencer_Explore')}}">Explore</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white" href="{{route('Influencer_Stream')}}"> My Upcoming Stream</a>
                    </li>

                 
                    <li class="nav-item bg-lightpink text-dark rounded-pill mb-3">
                      <a class="nav-link" href="{{url('/user-signIn')}}">For Users</a>
                    </li> 


                    <li class="nav-item">
                      @if(request()->session()->has('profile_img'))
                      <a href="{{ route('Influencer_My_Profile') }}">
                        <img src="{{ asset('Influencer/images/profile_img/' . request()->session()->get('profile_img')) }}">
                      </a>
                      @else
                      <!-- Display a default image when no image is uploaded -->
                      <a href="{{ route('Influencer_My_Profile') }}">
                        <img src="{{ asset('Influencer/images/profile_img/1714652397_dummy_image.png') }}">
                      </a>
                      @endif
                    </li>
                    {{-- <li class="bell-icon"><a href="#"><img src="{{asset('Influencer/images/bell-icon.png')}}"></a></li> --}}

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
              <p>Welcome to our vibrant live streaming portal - TidBid, where the world comes alive with captivating moments and thrilling experiences. Step into a virtual universe that seamlessly blends entertainment, connection, and boundless creativity. </p>
              <a href="{{route('Influencer_Explore')}}">View More</a>
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
          <div class="col-lg-4 col-md-5  col-sm-12">

            <div class="post_left">
              <div class="post_h">
                <h4>Streaming Live </h4>
              </div>
              <!--Item-->
              @forelse($livestream as $value)
              <div class="post_sect">
                <div class="post_img">
                  <!-- <div class="tag_on"><img src="{{asset('Influencer/images/online_tag.png')}}"></div> -->
                  <div class=" post_img2"> <img src="{{asset('Influencer/images/profile_img/'.$value->getInfluencer->profile_img)}}"></div>
                  <div class="clear"></div>
                </div>
                <div class="post_text">
                  <h5>{{$value->streamTitle}} </h5>
                  <p>{{$value->what_to_expect}}</p>
                  {{-- <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                    <p> <?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  </div> --}}
                  <div class="shedul">
                    <p class="gray_text"><img class="callender" src="{{asset('Influencer/images/callender.png')}}" alt="">
                        <?php echo date('m-d-Y', strtotime($value->streamDate)); ?>
                    <p class="gray_text"><i class="far fa-clock"></i>
                        {{date('h:i A', strtotime($value->streamTime))}}
                    </p>
                  </div>
                  <div class="post_btn"><a href="{{url('influencer-my-live-stream/'.$value->id)}}" class="join_btn_1">Join Now</a></div>
                </div>
              </div>
              @empty
              <p style="text-align: center; margin-top:23px;">No streaming live now</p>
              @endforelse
              <!--Item-->
            </div>

            <div class="post_left">
              <div class="post_h">
                <h4 class="text-center">Refer a Friend</h4>
              </div>
              <div class="refer_img"><img src="{{asset('Influencer/images/refer_1.png')}}"></div>
              <div class="refer_text">
                <h5>Refer & Earn $10 auction free</h5>
                <p>Invite your friend to join TidBid and both of you will get $10 for your next auction absolutely free.</p>
                <a href="{{route('Refer_A_Friend')}}"><img src="{{asset('Influencer/images/file-upload.svg')}}">Refer a friend</a>
              </div>
            </div>
          </div>

          {{--
          <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="posthead">
              <h3><b>All Post</b></h3>
            </div>
            <div class="PostSection">
            </div>
          </div> --}}
          <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="posthead">
              <h3><b>All Post</b></h3>
            </div>
            <div id="data-wrapper">
              @include('Influencer.partial-page.influencer-index-post')
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Main-Section -->
  <!-- Footer-Section -->
  @include('Influencer.layout.footer')
  <!-- End -Footer-Section -->


  <!--Like Popup -->

  <!-- Like Popup  -->

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
  <div class="modal fade" id="share-Popup2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

        <div class="modal-body pt-0 pb-5">
          <h1 class="modal-title text-center report-h5">Share </h1>

          <ul class="social_icon">
            <li><a href="#"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
            <li><a href="#"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
            <li><a href="#"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
            <li><a href="#"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Popup share -->


  <!-- Footer-Section -->


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
  <!-- Like Popup  -->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

{{-- Notification Ajax --}}
<script>
  $(document).ready(function() {
     $('#notification_icon').click(function() {

         $.ajax({
             url: "{{ route('notification-inf') }}",
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

  var ENDPOINT = "{{ url('influencer-index') }}";
  var page = 1;
  $(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 5)) {
      page++;
      infinteLoadMore(page);
    }
  });

  function infinteLoadMore(page) {
    $.ajax({
        url: ENDPOINT + "?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function() {
          $('.auto-load').show();
        }
      })
      .done(function(response) {
        if (response.html == '') {
          $('.auto-load').append("We don't have more data to display :(");
          return;
        }

        $('.auto-load').hide();
        $("#data-wrapper").append(response.html);
      })
      .fail(function(jqXHR, ajaxOptions, thrownError) {
        console.log('Server error occured');
      });
  }
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
    $('.showbutton_' + postId).show();

  })
</script>

<script>
  var ENDPOINT = "{{ url('influencer-index') }}";
  var page = 1;
  $(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 5)) {
      page++;
      infinteLoadMore(page);
    }
  });

  function infinteLoadMore(page) {
    $.ajax({
        url: ENDPOINT + "?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function() {
          $('.auto-load').show();
        }
      })
      .done(function(response) {
        if (response.html == '') {
          $('.auto-load').html("We don't have more data to display :(");
          return;
        }

        $('.auto-load').hide();
        $("#data-wrapper").append(response.html);
      })
      .fail(function(jqXHR, ajaxOptions, thrownError) {
        console.log('Server error occured');
      });
  }
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
@php
$postId = [];
foreach($getBlockPost as $block_post){
$postId[] = $block_post->post_id;
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
@endsection