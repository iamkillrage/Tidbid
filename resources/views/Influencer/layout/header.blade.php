<header>
    <!-- NAV-STRIP -->
    <div class="second_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container">
                            <a class="navbar-brand_2" href="{{route('Home')}}"><img src="{{asset('Influencer/images/logo.svg') }}" alt=""></a>
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

                                    <li class="nav-item bg-white text-dark rounded-pill pl-2 pr-2">
                                        <a class="nav-link" href="{{route('SignIn')}}">
                                            Login
                                        </a>
                                    </li>
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
</header>


<!-- logout Popup -->
{{-- <div class="modal fade" id="exampleModal_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
            class="fas fa-times-circle"></i></button>
        <div class="modal-body pt-0 pb-5 ">
        <div class="succes_box">
          <img src="{{asset('Influencer/images/logout2.png')}}">
<h3>Do you want to logout?</h3>
<div class="cardbtn"><a href="{{route('Logout')}}" class="Ok_btn">Ok</div>
{{-- <button type="button" class="cardbtn">Ok</button> 
        </div>     
        </div>
      </div>
    </div>
  </div> --}}
<!--logout Popup-->