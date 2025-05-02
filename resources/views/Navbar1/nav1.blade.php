<!-- NAV-STRIP -->
<div class="second_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <a class="navbar-brand_2" href="{{url('/')}}"><img src="{{asset('Influencer/images/logo.svg')}}" alt=""></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse mt-0" id="navbarNav">
                            <ul class="navbar-nav">
                               


                                    <li class="nav-item">
                                        <a class="nav-link  {{Request::is('/') ? 'class=text-dark':'text-white'}}" href="{{route('Home')}}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Request::is('about-us') ? 'class=text-dark':'text-white'}}" href="{{route('about_us')}}">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  {{Request::is('influencer-explore') ? 'class=text-dark':'text-white'}}" href="{{route('Influencer_Explore')}}">Explore</a>
                                    </li>








                                @if (!session()->has('login_is'))   
                                <li class="nav-item bg-white text-dark rounded-pill pl-2 pr-2">
                                    <a class="nav-link" href="{{route('User_SignIn')}}">
                                        Login
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item bg-lightpink text-dark rounded-pill">
                                    <a class="nav-link" href="{{route('SignIn')}}">For Influencers</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- NAV-STRIP -->


