@foreach($influencerdata as $value)

<div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
    <div class="influ_box_1 ">
        <div class="influimg1">
            <?php
            // Assuming $value->profile_img contains the path to the upoaded image or is empty
            $profile_img = $value->profile_img ? $value->profile_img : 'noimages.jpg'
            ?>
            <img src="{{asset('Influencer/images/profile_img/'.$profile_img)}}">
        </div>
        <div class="influtext">
            <h3><a href="{{ url('influencer-stream-details/'.$value->id) }}">{{$value->name}}</a></h3>
            <p>{{$value->bio}}</p>
            <p class="pink_text"><span>{{$value->upcomingstreamcount ? count($value->upcomingstreamcount) : 0 }}</span> Upcoming Streams</p>
            <p class="pink_text"><span>{{$value->followerscount ? count($value->followerscount) : 0 }}</span> Followers</p>
        </div>
    </div>
</div>
@endforeach
<div class="d-felx justify-content-center">
    {{ $influencerdata->onEachSide(1)->withQueryString()->links('Influencer.layout.pegination') }}

</div>