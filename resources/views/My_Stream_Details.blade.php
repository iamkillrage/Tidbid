@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>My Streams Details | TidBid</title>
  <!-- CSS -->
</head>
@php
$stream_id = [];
foreach($Notify as $Notifys) {
$stream_id[] = $Notifys->stream_id;
}
@endphp

<body>
  <!-- Header-Section -->
  <header>
    <!-- NAV-STRIP -->
    @if(auth()->check())
    @include('User.Navbar.nav')
    @else
    @include('Navbar1.nav1')
    @endif
    <!-- NAV-STRIP -->
  </header>
  <!-- Header-Section -->
  <!-- Main-Section -->
  <main>

    <section class="details_sect">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div id="streamVideo" class="details_video" style="height: 420px;">
              <video src="{{ $data->videoUrl }}" height="420" style="width: -webkit-fill-available;" controls autoplay muted></video>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="details_right mt-3">
              <div class="details_text">
                <h5>{{$data->streamTitle}}</h5>
                <p>{{$data->description}}</p>
              </div>

              <div class="profile_details">
                <div class="details_img">
                  @if(!empty($data->getInfluencers->profile_img))
                  <img src="{{asset('Influencer/images/profile_img/'. $data->getInfluencers->profile_img)}}">
                  @else
                  <img src="{{asset('user.jpg')}}">
                  @endif
                </div>

                <div class="profile_dec">
                  <h6>{{$data->getInfluencers->name ??''}}</h6>
                  <p>{{$data->getInfluencers->bio??''}}</p>
                </div>
              </div>

              <div class="base_price">Base Price : <p>${{$data->baseBidPrice}}</p>

              </div>

              <div class="detail_share">
                <h6>Share :</h6>
                <ul>
                  <li><a href="https://www.facebook.com/" target="_blank"><img src="{{asset('Influencer/images/circle_facebook.png')}}"></a></li>
                  <li><a href="https://www.instagram.com/" target="_blank"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                </ul>
              </div>

              <div class="detail_share">
                <ul>
                  <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="{{asset('Influencer/images/report.svg')}}" class="reportimg"></a></li>
                </ul>

                <h6>Report</h6>

              </div>

              <div class="details_btn">
                <div class="follow_btn">
                  @if($checkFollow)
                  <a href="javascript:void(0)" data-userId="{{ $data->getInfluencers->id }}" data-url="{{url('/')}}" class="userFollow">Followed</a>
                  @else
                  <a href="javascript:void(0)" data-userId="{{ $data->getInfluencers->id }}" data-url="{{url('/')}}" class="userFollow">Follow</a>
                  @endif
                </div>
              </div>
              <div class="details_btn">
                <a href="#" class="clip_btn notify_btn" data-bs-toggle="modal" data-bs-target="#exampleModal_1">Share this clip</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="main_influncer">
      <div class="container">
        <div class="row">

          <!--itme-->
          @if ($streamdata->isEmpty())
          <div class="alert alert-secondary">
            <strong>No Data Found !</strong>
          </div>

          @else
          @foreach($streamdata as $value)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
              <div class="influtext">
                <h3><a href="influencers-details-streams.html">{{$value->streamTitle}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 20)) }}....</p>
                <div class="shedul">
                  <p class="gray_text"><i class="fas fa-calendar-alt"></i> <?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  </p>
                  <p class="gray_text"><i class="far fa-clock"></i> {{$value->streamTime}}</p>
                </div>

                <div class="stream_btn" id="changeButton_{{$value->id}}">
                  @if(in_array($value->id, $stream_id))
                  <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMeee('{{$value->id}}','notify')" class="notify_btn notifyMe">Subscribed</a>
                  @else
                  <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMeee('{{$value->id}}','Subscribe')" class="notify_btn notifyMe">Notify me</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <!--itme-->
          @endforeach
          @endif
        </div>

        <div class="row">
          <div class="col-lg-11">
            <div class="live_h mt-4 pb-4">
              <h3>Past Streams</h3>
            </div>
          </div>
          @if ($paststream->isEmpty())
          <div class="alert alert-secondary">
            <strong>No Data Found !</strong>
          </div>

          @else

          <!--itme-->
          @foreach($paststream as $value)

          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <div class="top_tag">
                <a href="#" class="strem_tag">&nbsp;</a>
                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
              </div>
              <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
              <div class="influtext">
                <h3><a href="#">{{$value->streamTitle}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($value->description, 1), 0, 20)) }}....</p>
                <div class="shedul">
                  <p class="gray_text"><i class="fas fa-calendar-alt"></i> <?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  </p>
                  <p class="gray_text"><i class="far fa-clock"></i> {{$value->streamTime}}</p>
                </div>
                <!-- <p class="pink_text1"><span>1K</span> Followers</p> -->
                <div class="stream_btn">
                  <a href="{{route('user_Explore')}}" class="notify_btn">View more</a>
                </div>
              </div>
            </div>
          </div>
          <!--itme-->
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </main>
  <!-- Main-Section -->

  <!-- Popup share -->
  <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

        <div class="modal-body pt-0 pb-5">
          <h1 class="modal-title text-center report-h5">Share </h1>

          <ul class="social_icon">
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

  <!-- Popup Report -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

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

          }
          if (resp.status == 2) {
            $('.userFollow').text('Follow');
            toastr.success(resp.message);

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
  $(document).ready(function() {
    $(document).on('click', '.report-click', function() {
      var post_id = $(this).data('id');
      $('.post-id').val(post_id);

    });

    $('#reportform').submit(function(e) {
      e.preventDefault();
      // alert('hi');
      $.ajax({
        url: "{{ route('Post_Reports') }}",
        type: 'POST', // Change GET to POST
        data: $(this).serialize(),
        success: function(response) {
          $('#exampleModal').modal('hide');
          toastr.success('You have report successfully this Stream');
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
  function notifyMeee(id, events) {
    event.preventDefault(); // Commenting out this line since there's no event parameter in this function

    $.ajax({
      url: "{{ url('notifyMeee') }}",
      method: 'GET',
      data: {
        stream_id: id,
        events: events
      },
      dataType: 'json',
      success: function(resp) {
        if (resp.status == 1) {
          $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMeee(' + resp.id + ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
          toastr.success(resp.message);
        } else if (resp.status == 2) {
          $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMeee(' + resp.id + ', \'Subscribe\')" class="notify_btn notifyMe" >Notify me</a>');
          toastr.success(resp.message);
        }

      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown); // Log any errors for debugging purposes
      }
    });
  }
</script>