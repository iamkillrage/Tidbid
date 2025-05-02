@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Influencers My Followers | TidBid</title>
  
</head>

<body>
     <!-- Header-Section -->
     @include('Influencer.layout.header1')
      <!-- Header-Section -->

      <!-- Main-Section -->
  <main>
    <div class="explore_banner">
        <div class="container">
  
          <div class="row">
            <div class="col-lg-12 ">
              <div class="influ_text">
                <h1>My Followers</h1>
              </div>
            </div>
  
          </div>
        </div>
      </div>
  
      <div class="main_influncer">
        <div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="follow-h2">
        <h2>My Influencer Followers</h2>
      </div>
    </div>
  
      <!--itme-->
     @forelse($getMyFollower as $followers)
      <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full" id="followerId_{{$followers->id}}">
        <div class="influ_box_1 ">
        <div class="influimg1"><img src="{{asset('Influencer/images/userinflu_img5.png')}}"></div>
        <div class="influtext">
          <h3><a href="{{url('detail-stream-page?id='.$followers->following_id)}}">{{ $followers->user->name }}</a></h3>
          <p>{{ $followers->user->bio }}</p>
          <p class="pink_text"><span>{{ count($followers->upcomingStreams) }}</span> Upcoming Streams</p>
          <p class="pink_text pb-4"><span>{{ count($followers->getFollowing) }}</span> Followers</p>
          <a href="javascript:void(0)" data-id="{{$followers->id}}" class="join_btn removeFollower" data-bs-toggle="modal" data-bs-target="#remove_Popup">Remove</a>
        </div>
      </div>
    </div>
    @empty
  <div class="col-12 mb-6">
    <h5>No Followers found</h5>
  </div>
    @endforelse
      <!--itme-->
  
      <!--itme-->
  
  
      <!--itme-->
  
        </div>
  
  
  
        <div class="row">
          <div class="col-lg-12">
            <div class="follow-h2 mt-4">
              <h2>My User Followers</h2>
            </div>
          </div>
  
  
          @forelse($getMyUserFollower as $value)
          <div class="col-lg-12"  id="followerId_{{$value->id}}">
            <!--item-1 -->
            <div class="fol_outer">
            <div class="follow-box">
              <div class="follo_img"><img src="{{ $value->user->profile_img ? asset('Influencer/images/profile_img/'.$value->user->profile_img) : asset('Influencer/images/dummy.jpg') }}" alt="User Image">
</div>
              <div class="follo-text">
                <h3><a href="{{url('detail-stream-page?id='.$value->following_id)}}">{{ $value->user->name }}</a></h3>
                <p><a href="{{url('detail-stream-page?id='.$value->following_id)}}">{{ $value->user->userName }}</a></p>
              </div>
            </div>
            
            <div class="follow-box">
              <a href="#" class="join_btn pp-space" data-bs-toggle="modal" data-bs-target="#remove_Popup">Remove</a>
            </div>
          </div>
          <!--item-1 -->
          </div>
          @empty
          <h5>No Followers found</h5>
        @endforelse
        </div>
      </div>
    </main>
    <!-- Main-Section -->
    <!-- Footer-Section -->
  @include('Influencer.layout.footer')
  <!-- Footer-Section -->

  <!-- Remove PopUp -->
  <div class="modal fade" id="remove_Popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog remove_Popup2">
      <div class="modal-content text-center">
        <input type="hidden" name="id" value="" class="followId">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="{{('Influencer/images/unfollow-cross.png')}}" alt=""></button>
        <div class="modal-body pt-0 mb-3">
          <div class="success_img"><img src="{{('Influencer/images/sucessfull.png')}}"></div>
          <h1 class="modal-title text-center Conf_h">Remove</h1>
          <p>Are you sure you want to Remove
            this follower?</p>
        </div>
        <div class="modal_btn pb-5">
          <a href="javascript:void(0)" class="unfollow_yes" onclick="removefollower()">Yes</a>
          <a href="#" data-bs-dismiss="modal" class="unfollow_no">No</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Remove PopUp -->

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).on('click','.removeFollower', function(){
      var id = $(this).attr('data-id');
      if(id !=''){
        $('#remove_Popup').modal('show');
        $('.followId').val(id);
      }
      
  });
  function removefollower(){
    var id = $('.followId').val();
    $.ajax({
      url: "{{url('remove-follower')}}",
      type: 'get',
      data: {id:id},
      dataType: 'json',
      success: function(data){
       
        if(data.status == 2){
          $('#followerId_'+id).remove();
          $('#remove_Popup').modal('hide');
          toastr.success(data.message);     
        } else {
          toastr.error(data.message);
        }
      }
    });
  }

</script>
@endsection