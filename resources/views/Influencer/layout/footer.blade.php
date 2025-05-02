<footer>
    <div class="footer-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="footer-in">
                        <a href="#"><img src="{{asset('Influencer/images/footer_logo.png') }}" alt=""
                                class="-footer-logo"></a>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-in footer-in-mid">
                        <h1>Quick Links</h1>

                        @if(session('user_id'))
                        <p><a href="{{ route('Influencer_index') }}">Home</a></p>
                        @else
                        <p><a href="/">Home</a></p>
                        @endif

                        @if(session('user_id'))
                        <p><a href="{{route('Influencer_About_us')}}">About</a></p>
                        @else
                        <p><a href="{{route('about_us')}}">About</a></p>
                        @endif

                        <p><a href="{{route('Influencer_Explore')}}">Explore Now</a></p>

                        @if(session('user_id'))
                        <p><a href="{{route('terms_condition')}}">Terms and Conditions</a></p>
                        @else
                        <p><a href="{{route('terms_condition')}}">Terms and Conditions</a></p>
                        @endif


                        <p><a href="{{route('Privacy_Policy')}}">Privacy Policy</a></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-in">
                        <h1>Connect with us</h1>
                        <ul class="social_link">
                            <li><a href="https://snap.com/en-US" target="_blank"><img
                                        src="{{asset('Influencer/images/tik-tok.png') }}"> TikTok</a></li>
                            <li><a href="https://twitter.com/" target="_blank"><img
                                        src="{{asset('Influencer/images/twiter.png') }}"> Twitter</a></li>
                            <li><a href="https://www.youtube.com" target="_blank"><img
                                        src="{{asset('Influencer/images/youtube.png') }}"> YouTube</a></li>
                            <li><a href="https://www.instagram.com/" target="_blank"><img
                                        src="{{asset('Influencer/images/instagram.png') }}"> Instagram</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row footer_bottom">
                <div class="col-lg-12">
                    <div class="footer-bottom-in">
                        <p>Copyright©2023. All Rights Reserved.</p>
                        <p>Developed with <i class="fas fa-heart"></i> by <a href="http://www.yesitlabs.com/"
                                target="_blank"> YES
                                IT LABS LLC</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>


</footer>