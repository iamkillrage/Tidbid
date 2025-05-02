@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>My Upcoming Streams | TidBid</title>
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
    @include('User.Navbar.nav')
  </header>
  <!-- Header-Section -->

  <!-- Main-Section -->
  <main>

    <div class="explore_banner">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 ">
            <div class="influ_text">
              <h1>My Upcoming Streams</h1>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="main_influncer">
      <div class="container">
    <div class="broker-date">
              <input type="text" name="datefilter" id="datefilter" placeholder="Date Range" readonly>
              <button type="button" onclick="data_filter_click()"></button>
            </div>
      <div class="container-stream">
        <div class="row mt-5 mb-5">

          <div class="col-lg-12">
            <div class="devide-sect">
              <div class="live_h ">
                <h3>Live Now </h3>
              </div>

              <!-- <div class="broker-date">
                <input type="text" name="datefilter" value="" placeholder="Date Range" readonly>
              </div> -->
             

            </div>
          </div>
        </div>

        <div class="row">

          @if ($streamdata->isEmpty())
          <div class="alert alert-secondary">
            <strong>No Stream Live Now !</strong>
          </div>

          @else
          @foreach($streamdata as $value)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <div class="top_tag">
                <a href="#" class="strem_tag"><img src="{{asset('Influencer/images/online_tag.png')}}"></a>
                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
              </div>

              <div class="influimg1"><img src="{{asset('Influencer/images/profile_img/'.$value->getInfluencer->profile_img)}}"></div>
              <div class="influtext">
                <h3><a href="{{url('influencer-stream-details/'.$value->influencer_id)}}">{{$value->streamTitle}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 15)) }}...</p>
                <div class="shedul">

                  <p class="gray_text"><i class="fas fa-calendar-alt"></i><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  <!-- <p class="gray_text"><i class="far fa-clock"></i> 7pm onwards</p> -->
                </div>
                <p class="pink_text1"><span>Base Price :</span>{{$value->baseBidPrice}}</p>
                <div class="stream_btn">
                  <a href="{{url('user-live-stream/'.$value->id)}}" class="join_btn">Join Now</a>
                </div>
              </div>

            </div>
          </div>

          <!--itme-->
          @endforeach
          @endif
        </div>


        <div class="row">
          <div class="col-lg-12">
            <div class="live_h mt-4 pb-4">
              <h3>Tomorrow </h3>
            </div>
          </div>
          <!--itme-->

          @if ($tomorrowdata->isEmpty())
          <div class="alert alert-secondary">
            <strong>No Data Found !</strong>
          </div>

          @else
          @foreach($tomorrowdata as $value)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <div class="top_tag">
                <a href="#" class="strem_tag">&nbsp;</a>
                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
              </div>
              <div class="influimg1"><img src="{{asset('Influencer/images/profile_img/'.$value->getInfluencer->profile_img)}}"></div>
              <div class="influtext">
                <h3><a href="">{{$value->streamTitle}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 15)) }}...</p>
                <div class="shedul">
                  <p class="gray_text"><i class="fas fa-calendar-alt"></i><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  <p class="gray_text"><i class="far fa-clock"></i>{{$value->streamTime}}</< /p>
                </div>
                <p class="pink_text1"><span>Base Price :</span>{{$value->baseBidPrice}}</p>

                <div class="stream_btn" id="changeButton_{{$value->id}}">
                  @if(in_array($value->id, $stream_id))
                  <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'notify')" class="notify_btn notifyMee">Subscribed</a>
                  @else
                  <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'Subscribe')" class="notify_btn notifyMee">Notify Me</a>
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
          <div class="col-lg-12">
            <div class="live_h mt-4 pb-3">
              <h3>This Month</h3>
            </div>
          </div>

          <!--itme-->

          @if ($monthdata->isEmpty())
          <div class="alert alert-secondary">
            <strong>No Data Found !</strong>
          </div>

          @else
          @foreach($monthdata as $value)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <div class="top_tag">
                <a href="#" class="strem_tag">&nbsp;</a>
                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
              </div>
              <div class="influimg1"><img src="{{asset('Influencer/images/profile_img/'.$value->getInfluencer->profile_img)}}"></div>
              <div class="influtext">
                <h3><a href="">{{$value->streamTitle}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 15)) }}... </p>
                <div class="shedul">
                  <p class="gray_text"><i class="fas fa-calendar-alt"></i><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  <p class="gray_text"><i class="far fa-clock"></i>{{$value->streamTime}}</p>
                </div>
                <p class="pink_text1"><span>Base Price :</span>{{$value->baseBidPrice}}</p>
                <!-- <div class="stream_btn">
                  <a href="#" class="join_btn">Subscribed</a>
                </div> -->

                <div class="stream_btn" id="changeButton_{{$value->id}}">
                  @if(in_array($value->id, $stream_id))
                  <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'notify')" class="notify_btn notifyMee">Subscribed</a>
                  @else
                  <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'Subscribe')" class="notify_btn notifyMee">Notify Me</a>
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
              <h3>Explore More Streams</h3>
            </div>
          </div>

          <div class="col-lg-1">
            <div class="live_h mt-4 pb-4">
              <a href="{{route('explore_stream')}}">View All</a>
            </div>
          </div>

          <!--itme-->

          @if ($morestream->isEmpty())
          <div class="alert alert-secondary">
            <strong>No Data Found !</strong>
          </div>

          @else
          @foreach($morestream as $value)
          <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="influ_box_1 ">

              <div class="influimg1"><img src="{{asset('Influencer/images/profile_img/'.$value->getInfluencer->profile_img)}}"></div>
              <div class="influtext">
                <div class="shedul">
                  <p class="gray_text"><i class="fas fa-calendar-alt"></i> <?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                  <p class="gray_text"><i class="far fa-clock"></i> {{$value->streamTime}}</p>
                </div>
                <!-- <h3 class="pt-1 pb-2"><a href="#">Lorem Ipsum is simply</a></h3> -->
                <a href="#" class="time_pink">{{$value->streamTitle}}</a>
                <p>{{ implode(' ', array_slice(str_word_count($value->description, 1), 0, 15)) }}...</p>
                <div class="stream_btn">
                  <a href="{{route('MyStreamDetails',['id' => $value->id])}}" class="join_btn">View More</a>
                </div>
              </div>
            </div>
          </div>

          <!--itme-->

          @endforeach
          @endif

          <!--itme-->



        </div>





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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  function notifyMee(id, events) {
    // event.preventDefault(); // Commenting out this line since there's no event parameter in this function

    $.ajax({
      url: "{{ url('notifyMee') }}",
      method: 'GET',
      data: {
        stream_id: id,
        events: events
      },
      dataType: 'json',
      success: function(resp) {
        if (resp.status == 1) {
          $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMee(' + resp.id + ', \'notify\')" class="notify_btn notifyMe">Subscribed</a>');
          toastr.success(resp.message);
        } else if (resp.status == 2) {
          $('#changeButton_' + id).html('<a href="javascript:void(0)" onclick="notifyMee(' + resp.id + ', \'Subscribe\')" class="notify_btn notifyMe" >Notify Me</a>');
          toastr.success(resp.message);
        }
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown); // Log any errors for debugging purposes
      }
    });
  }

  $(document).on('click', '.cancelBtn ', function() {
    location.reload(true)
  })



  
  $(document).on('click', '.applyBtn', function() {
    var eventdate = $('.drp-selected').text();

    var page = '';
    var search = '';
    var type = '';
    searchStreem(search, page, type, eventdate)
  })

  function searchStreem(search, page, type, eventdate) {
    $.ajax({
      url: "{{url('user-upcoming-stream')}}",
      type: 'GET',
      data: {
        search: search,
        page: page,
        type:type,
        eventdate:eventdate
      },
      success: function(data) {
        $('.container-stream').empty(); // Clear the existing content
        var content = '';

        if (data.morestream.length === 0) {
            content += `
                <div class="alert alert-secondary mt-3">
                    <strong>No Data Found</strong>
                </div>
            `;
        } else {
            content += '<div class="row">';
            $.each(data.morestream, function(index, value) {
              console.log('value',value);
             var img =  value.get_influencer ? value.get_influencer.profile_img : '';
                content += `
                
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full mt-4">
                        <div class="influ_box_1">
                            <div class="top_tag">
                               
                                <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="{{asset('Influencer/images/share_icon.svg')}}"></a>
                            </div>
                            <div class="influimg1"><img src="{{asset('Influencer/images/profile_img/` + img + `')}}"></div>
                            <div class="influtext">
                                <h3><a href="{{url('influencer-stream-details/` + value.influencer_id + `')}}">${value.streamTitle}</a></h3>
                                <p>${value.what_to_expect.split(' ').slice(0, 15).join(' ')}...</p>
                                <div class="shedul">
                                    <p class="gray_text"><i class="fas fa-calendar-alt"></i> ${new Date(value.streamDate).toLocaleDateString()}</p>
                                </div>
                                <p class="pink_text1"><span>Base Price :</span>${value.baseBidPrice}</p>

                                <div class="stream_btn">  
                                  <a href="{{url('my-stream-details/` + value.id + `')}}" class="join_btn">View More</a>
                                  
                                </div>

                            </div>
                        </div>
                    </div>
                `;
            });
            content += '</div>';
        }
        console.log(content);
        $('.container-stream').append(content);
      }
    })
  }


</script>