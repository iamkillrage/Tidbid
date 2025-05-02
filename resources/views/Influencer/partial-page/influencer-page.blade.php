@forelse($influencerdata as $value )
           <div class="col-lg-3 col-md-4 col-sm-6 col-6 follow-full">
             <div class="influ_box_1 ">
             <div class="influimg1">
                @if($value->profile_img =='')
                <img src="{{asset('user.jpg')}}" style="width:100%; height:250px;">
                @else
                <img src="{{asset('Influencer/images/profile_img/'.$value->profile_img)}}">
                @endif
                
            </div>
             <div class="influtext">
               <h3><a href="{{ route('Detail_Stream_Page', ['id' => $value->id]) }}">{{$value->name}}</a></h3>
               <p>{{ implode(' ', array_slice(str_word_count($value->bio, 1), 0, 16)) }}....</p>
               <p class="pink_text"><span>{{ count($value->upcomingStreams) }}</span> Upcoming Streams</p>
               <p class="pink_text"><span>{{ count($value->followerscount) }}</span> Followers</p>
             </div>
           </div>
         </div>
   @empty
<h5>No data found</h5>
   @endforelse
   <div class="d-felx justify-content-center">
                {{ $influencerdata->onEachSide(1)->withQueryString()->links('Influencer.layout.pegination') }}

            </div>