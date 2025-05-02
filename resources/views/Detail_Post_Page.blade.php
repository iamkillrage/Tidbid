@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Influencers Details Posts | TidBid</title>
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
  @if(session('user_id') || auth()->check())
  @if(session('user_id'))
  @include('Influencer.layout.header1')
  @elseif(auth()->check())
  @include('User.Navbar.nav')
  @endif
  @else
  @include('Influencer.layout.header')
  {{-- @include('Navbar1.nav1') --}}
  @endif
  <!-- End-Header-Section-->

  <!-- Main-Section -->
  <main>
    <section class="influ_profile">
      <div class="container">
        <div class="row influ_bg">
          <div class="col-lg-3"></div>
          <div class="col-lg-6 ">
            <div class="profile_box">
              @if($data->profile_img == '')
              <div class="profile_img"><img src="{{asset('user-profile-icon.webp')}}" alt=""></div>
              @else
              <div class="profile_img"><img src="{{asset('Influencer/images/profile_img/'.$data->profile_img)}}"></div>
              @endif
              <div class="profile_text">
                <h5>{{$data->userName}}</h5>
                <p>{{$data->bio}}</p>
              </div>
              <div class="follow_sect">
                <p class="text_follow"><b class="text-dark">{{$upcommingtreamdata}} </b>Upcoming Streams</p>
                <p class="text_follow"><b class="text-dark">{{ $totalfollowers}} </b>Followers</p>
              </div>
              <div class="follow_btn">
                @if($checkFollow)
                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" data-role="{{ $data->role }}" class="followUser">Followed</a>
                @else
                <a href="javascript:void(0)" data-userId="{{ $data->id }}" data-url="{{url('/')}}" data-role="{{ $data->role }}" class="followUser">Follow</a>
                @endif
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-3">
            <div class="chat_btn"><a href="{{url('influencer-chat/{id}')}}">Chat <img src="{{asset('Influencer/images/chat.svg')}}"></a></div>
          </div> -->
        </div>
      </div>
    </section>

    <div class="main_influncer">
      <div class="container">

        <div class="row">
          <div class="col-md-12">
            <div class="nav nav-tabs1 mb-5 ">
              <a href="{{ route('Detail_Stream_Page', ['id' => $data->id]) }}" class="nav-link1">Streams</a>
              <a href="{{route('Detail_Post_Page', ['id' => $data->id])}}" class="nav-link1 active">Posts</a>
              <a href="{{route('Detail_Schedule_Page', ['id' => $data->id])}}" class="nav-link1"> Schedule</a>
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
              @forelse($paststreamdata as $value)
              <div class="post_sect">
                {{-- <div class="post_img"><img src="{{asset('Influencer/images/post_img1.png')}}"></div> --}}
                <div class="post_img"><img src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
                <div class="post_text">
                  <h5>{{$value->streamTitle}} <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon1.svg')}}"></a></h5>
                  {{-- <p>{{$value->what_to_expect}}</p> --}}
                  <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 9)) }}</p>
                  <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                    <p>{{$value->streamDate}}</p>
                  </div>
                  <div class="Post_icon"><i class="far fa-clock"></i>
                    <p>{{$value->streamTime}}</p>
                  </div>
                  <div class="post_btn"><a href="{{url('/influencer-my-stream-details?stream_id='.$value->id)}}">View Details</a></div>
                </div>
              </div>
              @empty
              <p style="text-align: center;">No past streams found</p>
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


          <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="posthead">
              <h3>All Post </h3>
            </div>
            <div id="data-wrapper">
              @include('Detail_Post_Partial_Page')
            </div>



          </div>
        </div>
      </div>
    </div>




  </main>
  <!-- Main-Section -->

  <!-- Footer-Section -->
  @include('Influencer.layout.footer')
  <!-- Footer-Section -->

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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

  /** Add bookMark */
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
      $.ajax({
        url: "{{ route('Post_Report') }}",
        type: 'POST', // Change GET to POST
        data: $(this).serialize(),
        success: function(response) {
          $('#exampleModal').modal('hide');
          toastr.success('You have report successfully this post');
          $('.textarea_sect').val('');
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  });
</script>
<script>
  $(document).on('click', '.followUser', function() {
    var influencerId = $(this).attr('data-userId');
    var url = $(this).attr('data-url');
    var role = $(this).attr('data-role');
    if (influencerId != '' && url != '' && role != '') {
      $.ajax({
        url: url + '/follower-user',
        method: "GET",
        data: {
          influencerId: influencerId,
          role: role
        },
        dataType: 'json',
        success: function(resp) {
          if (resp.login_status == 'false') {
            toastr.error('Please login first to follow this Influencer');
            return false;
          }

          if (resp.status == 1) {
            $('.followUser').text('Followed');
            toastr.success(resp.message);
            window.location.reload(true);
          }
          if (resp.status == 2) {
            $('.followUser').text('Follow');
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

  // data fetching for edit Post //

  $(document).ready(function() {
    $('.edit-link').on('click', function() {
      var post = $(this).data('post');
      
      $('.postId').val(post.id);
      $('.post-title').val(post.title);
      $('.post-description').val(post.description);
    });
  });
  // End data fetching for edit post //

  // updating the post //
  $(document).ready(function() {
    $('#postform').submit(function(event) {
      event.preventDefault();

      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "{{route('Influencer_Update_Post')}}",
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log(response.success);
          if (response.success) {
            window.location.reload();
            $('#edit-Post-1').modal('hide');
          }
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.error(xhr.responseText);
        }
      });
    });
  });
  // End updating post //

  //delete post //
  $(document).ready(function() {
    $(document).on('click', '.deletePost', function() {
      var postId = $(this).data('id');
      
      if (postId) {
        $('.postId').val(postId);
        $('#delete-post').modal('show');
      } else {
        alert('Post id not found')
      }
    });
  });

  function deletePosts() {
    var id = $('.postId').val();
    $.ajax({
      url: "{{route('Influencer_Delete_Post')}}",
      method: 'GET',
      data: {
        postId: id
      },
      dataType: 'json',
      success: function(data) {
        // Optionally, you can remove the deleted FAQ item from the DOM
        if (data.status == 1) {
          location.reload(true)
        } else {
          alert('something is wrong')
        }
        
        $('#delete-post').model('hide');
      },
      error: function(xhr, status, error) {
        alert('Error deleting Post');
      }
    });
  }
  //delete post //
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

  var ENDPOINT = "{{ url('detail-post-page/'.$ids) }}";
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

@foreach($postData as $key => $value)

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


@endforeach