@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Influencers My Stream Detail | TidBid</title>

</head>

<body>
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

  <!-- Main-Section -->
  <main>
    <section class="details_sect">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div id="streamVideo" class="details_video" style="height: 420px;">
              <video src="{{ $streamData->videoUrl }}" height="420" style="width: -webkit-fill-available;" controls autoplay muted></video>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="details_right mt-3">

              <div class="details_text">
                <h5>{{$streamData->streamTitle}}</h5>
                <p>{{$streamData->description}}</p>
              </div>

              <div class="profile_details">

                <div class="details_img">
                  @if(!empty($streamData->getInfluencers->profile_img))
                  <img src="{{asset('Influencer/images/profile_img/'. $streamData->getInfluencers->profile_img)}}">
                  @else
                  <img src="{{asset('user.jpg')}}">
                  @endif
                </div>

                <div class="profile_dec">
                  <h6>{{$streamData->getInfluencers->name ??''}}</h6>
                  <p>{{ implode(' ', array_slice(str_word_count($streamData->getInfluencers->bio, 1), 0, 40)) }}...
                  </p>

                </div>
              </div>

              <div class="base_price">Base Price : <p>${{$streamData->baseBidPrice}}</p>
              </div>

              <div class="detail_share">
                <h6>Share :</h6>
                <ul>
                  <li><a href="https://www.facebook.com/" target=_blank><img src="{{asset('Influencer/images/circle_facebook.png')}}"></a></li>
                  <li><a href="https://www.instagram.com/" target=_blank><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
                </ul>
              </div>

              <div class="detail_share">
                <ul>
                  <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="{{asset('Influencer/images/report.svg')}}" class="reportimg"></a></li>
                </ul>
                <h6>Report</h6>
              </div>

              <div class="details_btn">
                <!--<span class="detail_f join_btn">-->
                <!--  @if($checkFollow)-->
                <!--  <a href="javascript:void(0)" data-userId="{{ $streamData->influencer_id }}" data-url="{{url('/')}}" data-role="{{request()->session()->get('role')}}" class="followUser" style="color: white;">Followed</a>-->
                <!--  @else-->
                <!--  <a href="javascript:void(0)" data-userId="{{ $streamData->influencer_id }}" data-url="{{url('/')}}" data-role="{{request()->session()->get('role')}}" class="followUser" style="color: white;">Follow</a>-->
                <!--  @endif-->
                <!--</span>-->

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
          @php
          $stream_id = []; // Initialize an empty array to store stream IDs
          foreach($Notify as $Notifys) {
          $stream_id[] = $Notifys->stream_id; // Push each stream ID into the array
          }
          @endphp
          @foreach($upcomming_stream as $data)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <!-- <div class="top_tag">
                      <a href="#" class="strem_tag"><img src="images/online_tag.png"></a>
                      <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img
                          src="images/share_icon.svg"></a>
                    </div> -->
              <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'. $data->thumbnail_img)}}"></div>
              <div class="influtext">
                <h3><a href="">{{$data->streamTitle}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($data->what_to_expect, 1), 0, 9)) }}</p>
                <div class="shedul">
                  <p class="gray_text"><i class="fas fa-calendar-alt"></i><?php echo date('m-d-Y', strtotime($data->streamDate)); ?></p>
                  <p class="gray_text"><i class="far fa-clock"></i> {{$data->streamTime}}</p>
                </div>
                <!-- <p class="pink_text1"><span>1K</span> Followers</p> -->
                <!-- <div class="stream_btn">
                  <a href="#" class="notify_btn">Notify me</a>
                </div> -->
                <div class="stream_btn" id="changeButton_{{$data->id}}">

                  @if(in_array($data->id, $stream_id))
                  <a href="javascript:void(0)" data-id="{{$data->id}}" onclick="notifyMe('{{$data->id}}' ,'notify')" class="notify_btn notifyMe">Subscribed</a>
                  @else
                  <a href="javascript:void(0)" data-id="{{$data->id}}" onclick="notifyMe('{{$data->id}}','Subscribe')" class="notify_btn notifyMe">Notify Me</a>
                  @endif

                </div>

              </div>
            </div>
          </div>
          @endforeach
          <!--itme-->

        </div>


        <div class="row">
          <div class="col-lg-11">
            <div class="live_h mt-4 pb-4">
              <h3>Past Streams</h3>
            </div>
          </div>

          <div class="col-lg-1">
            <div class="live_h mt-4 pb-4">
              <a href="{{route('Influencer_Explore_Stream')}}">View All</a>
            </div>
          </div>
          @if ($paststream->isEmpty())
          <h5>No other Past Stream data found !</h5>
          @else
          <!--itme-->
          @foreach($paststream as $value)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <div class="top_tag">
                <a href="#" class="strem_tag">&nbsp;</a>
                <!--<a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>-->
                <a href="javascript:void(0)" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1" data-title="{{ $value->streamTitle }}" data-url="{{ url('/stream/' . $value->id) }}"><img src="{{ asset('Influencer/images/share_icon.svg') }}"></a>
              </div>
              <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'. $value->thumbnail_img)}}"></div>
              <div class="influtext">
                <h3><a href="#">{{$value->streamTitle}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 9)) }}</p>

                <div class="shedul">
                  <p class="gray_text"><i class="fas fa-calendar-alt"></i><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  <p class="gray_text"><i class="far fa-clock"></i> {{$value->streamTime}}</p>
                </div>
                <!-- <p class="pink_text1"><span>1K</span> Followers</p> -->
                <div class="stream_btn">
                  <a href="{{route('Influencer_Explore')}}" class="notify_btn">View more</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
          <!--itme-->
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

        <div class="modal-body pt-0 pb-5 ">
          <h1 class="modal-title text-center report-h5">Share "<span id="shareTitle"></span>"</h1>
            <!--<h1 class="modal-title text-center report-h5">Share "<span id="shareTitle"></span>"</h1>-->
          <ul class="social_icon">
             
            <li><a href="https://www.facebook.com/" id="facebookLink" target="_blank"><img src="{{asset('Influencer/images/facebook.svg')}}"></a></li>
            <li><a href="https://www.instagram.com/" id="instagramLink" target="_blank"><img src="{{asset('Influencer/images/instagram.svg')}}"></a></li>
            <li><a href="https://twitter.com/" id="twitterLink" target="_blank"><img src="{{asset('Influencer/images/x-twitter.svg')}}"></a></li>
            <li><a href="https://in.linkedin.com/" id="linkedinLink" target="_blank"><img src="{{asset('Influencer/images/linkedin.svg')}}"></a></li>
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
            <input type="hidden" value="Stream" name="type">
            <input type="hidden" name="post_id" value="{{$streamData->id }}">
            <textarea placeholder="Enter reason for reporting" name="description" value="description" class="textarea_sect"></textarea>
            <div class="d-flex justify-content-center">
            <button type="submit" class="Report_btn stream_btn">Submit</button>
            </div>
          </form>
        </div>


        {{-- <input type="submit" value="submit" data-bs-dismiss="model" class="mb-5"> --}}

      </div>
    </div>
  </div>

  <!-- Popup Report -->


  <!-- Footer-Section -->
  @include('Influencer.layout.footer')
  <!-- Footer-Section -->
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

          }
          if (resp.status == 2) {
            $('.followUser').text('Follow');
            toastr.success(resp.message);

          }
          if (resp.status == 0) {
            // toastr.error('All input field are required..');
            toastr.error('Something went wrong');
          }


        }
      })

    } else {
      toastr.error('Please login first to follow this Influencer');
    }


    // Now you can use influencerId variable to perform further actions
  });
</script>
<script>
  function notifyMe(id, events) {
    event.preventDefault(); // Commenting out this line since there's no event parameter in this function

    $.ajax({
      url: "{{ url('notifyMe') }}",
      method: 'GET',
      data: {
        stream_id: id,
        events: events
      },
      dataType: 'json',
      success: function(resp) {
        if (resp.status == 1) {
          $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMe(' + resp.id + ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
          toastr.success(resp.message);
        } else if (resp.status == 2) {
          $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMe(' + resp.id + ', \'Subscribe\')" class="notify_btn notifyMe" >Notify Me</a>');
          toastr.success(resp.message);
        } else {
          toastr.error(resp.message);
        }
        // location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown); // Log any errors for debugging purposes
      }
    });
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
  
  document.addEventListener('DOMContentLoaded', function () {
    const shareButtons = document.querySelectorAll('.online_share');

    shareButtons.forEach(button => {
        button.addEventListener('click', function () {
            const title = this.getAttribute('data-title');
            const url = this.getAttribute('data-url');

            document.getElementById('shareTitle').textContent = title;
           
            // Update social links
            document.getElementById('facebookLink').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            document.getElementById('twitterLink').href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
            document.getElementById('linkedinLink').href = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(url)}&title=${encodeURIComponent(title)}`;
            document.getElementById('instagramLink').href = `https://www.instagram.com/`; // Instagram doesn’t support direct URL shares
        });
    });
});

</script>
@endsection