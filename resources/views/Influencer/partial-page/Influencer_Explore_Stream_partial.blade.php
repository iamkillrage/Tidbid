@php
$stream_id = [];
foreach($Notify as $Notifys) {
$stream_id[] = $Notifys->stream_id;
}
@endphp

@forelse($streamdata as $value)
<div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
  <div class="influ_box_1 ">
    <div class="top_tag">


      {{-- <a href="#" class="strem_tag"><img src="{{asset('Influencer/images/online_tag.png')}}"></a>
      <a href="#" class="online_share" data-bs-toggle="modal" data-bs-target="#exampleModal_1"><img src="images/share_icon.svg"></a> --}}

    </div>

    <div class="influimg1">
      @if($value->thumbnail_img =='')
      <img src="{{asset('noimages.jpg')}}" style="width: 100%;">
      @else
      <img src="{{asset('Influencer/images/thumbnail/'.$value->thumbnail_img)}}" style="width: 100%;">
      @endif

    </div>
    <div class="influtext">
      <h3><a href="{{ route('Influencer_My_Stream_Detail', ['stream_id' => $value->id]) }}">
          @if(isset($value->getInfluencers) && isset($value->streamTitle))
          {{ $value->streamTitle }}
          @endif
        </a>
      </h3>
      <p>{{ implode(' ', array_slice(str_word_count($value->what_to_expect, 1), 0, 15)) }}</p>

      <div class="shedul">
        <p class="gray_text"><i class="fas fa-calendar-alt"></i> <?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
        <p class="gray_text"><i class="far fa-clock"></i> {{date('h:i A', strtotime($value->streamTime))}}</p>
      </div>
      <p class="pink_text1"><span>Base Price :</span> ${{$value->baseBidPrice}}</p>

      <div class="sidebysidebtn">

        @if(strtotime($value->streamDate) == strtotime(date('Y-m-d'))) <div class="stream_btn">
          @if(session('user_id'))
          <a href="{{ url('influencer-my-live-stream/{id}') }}" class="join_btn">Join Now</a>
          @else
          <a href="{{ route('SignIn') }}" class="join_btn">Join Now</a>
          @endif
        </div>
        @else

        @endif

        <div class="stream_btn" id="changeButton_{{$value->id}}">
          @if(strtotime($value->streamDate) != strtotime(date('Y-m-d')))
          @if(in_array($value->id, $stream_id) )
          <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}', 'notify')" class="notify_btn notifyMe">Subscribed</a>
          @else
          <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}', 'Subscribe')" class="notify_btn notifyMe">Notify Me</a>
          @endif
          @endif
        </div>



        <!-- <div class="stream_btn">
        @if(in_array($value->id, $stream_id))
          <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}', 'notify')" class="notify_btn notifyMe">Subscribed</a>
          @else
          <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}', 'Subscribe')" class="notify_btn notifyMe">Notify Me</a>
          @endif
        </div> -->


        <!-- <div class="stream_btn22">
        @if(in_array($value->id, $stream_id))
            <button data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}', 'notify')">Notify Me</button>
            @else
            <button data-id="{{$value->id}}" onclick="notifyMe('{{$value->id}}', 'Subscribe')">Notify Me</button>
            @endif
        </div> -->


      </div>

    </div>
  </div>
</div>
@empty
<h5>No data found</h5>
@endforelse
<div class="d-felx justify-content-center">
  {{ $streamdata->onEachSide(1)->withQueryString()->links('Influencer.layout.pegination') }}

</div>