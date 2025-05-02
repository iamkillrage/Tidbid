@php
$stream_id = [];
foreach($Notify as $Notifys) {
$stream_id[] = $Notifys->stream_id;
}
@endphp
@foreach($streamdata as $value)
<div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
    <div class="influ_box_1 ">
        <div class="top_tag">
    
        </div>
        <div class="influimg1"><img src="{{asset('Influencer/images/thumbnail/'.$value->thumbnail_img)}}"></div>
        <div class="influtext">
            <h3><a href="{{route('MyStreamDetails',['id' => $value->id])}}">{{$value->streamTitle}}</a></h3>
            <p>{{$value->what_to_expect}}</p>
            <div class="shedul">
                <p class="gray_text"><i class="fas fa-calendar-alt"></i><?php echo date('m-d-Y', strtotime($value->streamDate)); ?></p>
                <p class="gray_text"><i class="far fa-clock"></i>{{$value->streamTime}}</p>
            </div>
            <p class="pink_text1"><span>Base Price :</span> ${{$value->baseBidPrice}}</p>
        
            <div class="sidebysidebtn">
                @php
                    $date = date('Y-m-d');
                    $Currenttime = date('H:i:s');
                @endphp
                @if($value->streamDate == $date && $value->streamTime <= $Currenttime && $value->status == 'Activate')
                <div class="stream_btn">
                    @if(Auth::check())
                    <a href="{{ url('user-live-stream/'.$value->id) }}" class="join_btn">Join Now</a>
                    @else
                    <a href="{{ route('SignIn') }}" class="join_btn">Join Now</a>
                    @endif
                </div>
                @else
                <div class="stream_btn" id="changeButton_{{$value->id}}">
                    @if(in_array($value->id, $stream_id))
                    <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'notify')" class="notify_btn notifyMee">Subscribed</a>
                    @else
                    <a href="javascript:void(0)" data-id="{{$value->id}}" onclick="notifyMee('{{$value->id}}', 'Subscribe')" class="notify_btn notifyMee">Notify Me</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@if($streamdata->isEmpty())
<h5>No Data Found</h5>
@endif
<div class="d-felx justify-content-center">
    {{ $streamdata->onEachSide(1)->withQueryString()->links('Influencer.layout.pegination') }}
</div>