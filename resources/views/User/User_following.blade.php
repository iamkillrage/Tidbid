@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Following | TidBid</title>
</head>

<body>

  <!-- Header-Section -->
  <header>
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
              <h1>My Following</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main_influncer">
      <div class="container">


        <div class="row">

          <!--itme-->
          @if ($followerData->isEmpty())
          <div class="alert alert-secondary">
            <strong>no data found !</strong>
          </div>

          @else
          @foreach($followerData as $value)
          <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
            <div class="influ_box_1 ">
              <div class="influimg1"><img src="{{asset('Influencer/images/profile_img/'.$value->getinfluencer->profile_img)}}" style="width: 270px; height:250px;"></div>
              <div class="influtext">
                <h3><a href="{{ url('influencer-stream-details/'.$value->id) }}">{{$value->getinfluencer ? $value->getinfluencer->name : ''}}</a></h3>
                <p>{{ implode(' ', array_slice(str_word_count($value->getinfluencer->bio, 1), 0, 10)) }}....</p>
                <p class="pink_text"><span>{{ $value->getinfluencer ? $value->getinfluencer->upcomingstreamcount ? count($value->getinfluencer->upcomingstreamcount) : 0 : 0 }}</span> Upcoming Streams</p>
                <p class="pink_text pb-4"><span>{{$value->getinfluencer ? $value->getinfluencer->followerscount ? count($value->getinfluencer->followerscount) : 0 : 0 }}</span> Followers</p>

            
                <a href="#" class="join_btn pp-space" data-id="{{$value->following_id}}" data-bs-toggle="modal" data-bs-target="#remove_Popup">Following</a>






              </div>
            </div>
          </div>

          <!--itme-->
          @endforeach
          @endif
        </div>
      </div>
  </main>
  <!-- Main-Section -->



  <!-- Unfollow PopUp -->
  <!-- <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content text-center">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="{{asset('Influencer/images/unfollow-cross.png')}}" alt=""></button>

        <div class="modal-body pt-0 mb-3">
          <div class="success_img"><img src="{{asset('Influencer/images/sucessfull.png')}}"></div>
          <h1 class="modal-title text-center Conf_h">Confirmation</h1>
          <p>Are you sure you want to unfollow</p>


        </div>

        <div class="modal_btn pb-5">
        
          <a href="javascript:void(0)" class="unfollow_yes" onclick="removefollower()">Yes</a>
          <a href="#" data-bs-dismiss="modal" class="unfollow_no">No</a>
        </div>



      </div>
    </div>
  </div> -->

  <div class="modal fade" id="remove_Popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog remove_Popup2">
      <div class="modal-content text-center">
        <input type="hidden" name="id" value="" class="followId">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="{{asset('Influencer/images/unfollow-cross.png')}}" alt=""></button>
        <div class="modal-body pt-0 mb-3">
          
          <div class="success_img"><img src="{{asset('Influencer/images/sucessfull.png')}}"></div>
          <h1 class="modal-title text-center Conf_h">Confirmation</h1>
          <p>Are you sure you want to unfollow</p>
        </div>
        <div class="modal_btn pb-5">
          <a href="javascript:void(0)" class="unfollow_yes" onclick="removefollower()">Yes</a>
          <a href="#" data-bs-dismiss="modal" class="unfollow_no">No</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Unfollow PopUp -->


</body>

</html>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).on('click','.removeFollower', function(){
      var id = $(this).attr('data-id');
      if(id !=''){
        $('#remove_Popup').modal('show');
        $('.followId').val(id);
      }
      
  });
  $(document).on('click','.pp-space', function(){
      var id =$(this).data('id');
      $('.followId').val(id);
      
      
  });
  function removefollower(){
    // alert('hi');
    var id = $('.followId').val();
    console.log('id',id);
    $.ajax({
      url: "{{route('removefollower')}}",
      type: 'get',
      data: {id:id},
      dataType: 'json',
      success: function(data){
       
        if(data.status == 2){
          $('#followerId_'+id).remove();
          $('#remove_Popup').modal('hide');
          toastr.success(data.message);   
          window.location.reload(true);   
        } else {
          toastr.error(data.message);
        }
      }
    });
  }

</script>