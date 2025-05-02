   <!-- JS -->

   @if(request()->segment(1) !='influencer-shedule-details')
   <script src="{{asset('Influencer/js/jquery.js')}}" type="text/javascript"></script>
   @endif

   <script src="{{asset('Influencer/js/bootstrap.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('Influencer/js/custom.js')}}" type="text/javascript"></script>
   <script src="{{asset('Influencer/js/animation.js')}}" type="text/javascript"></script>
   <script src="{{asset('Influencer/js/datepicker.js')}}" type="text/javascript"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   

   @stack('page_script')



   <!-- Footer-Section -->
   <footer>
       <div class="footer-wrap">
           <div class="container">
               <div class="row">
                   <div class="col-lg-4 col-md-12">
                       <div class="footer-in">
                           <img src="{{asset('Influencer/images/footer_logo.png')}}" alt="">
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-6">
                       <div class="footer-in footer-in-mid">
                           <h1>Quick Links</h1>
                           <!-- <p><a href="/">Home</a></p> -->
                           @if(Auth::check())
                           <p><a href="{{ route('User_Home') }}">Home</a></p>
                           @else
                           <p><a href="/">Home</a></p>
                           @endif
                           <p><a href="{{route('UserAboutUs')}}">About</a></p>
                    
                   
                           @if(Auth::check())
                           <p><a href="{{route('user_Explore')}}">Explore Now</a></p>
                           @else 
                           <p><a href="{{route('Explore')}}">Explore Now</a></p>
                           @endif
                           
                           <p><a href="{{route('User_Terms_Condition')}}">Terms and Conditions</a></p>
                           <p><a href="{{route('User_Privacy_policy')}}">Privacy Policy</a></p>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-6">
                       <div class="footer-in">
                           <h1>Connect with us</h1>
                           <ul class="social_link">
                               <li><a href="https://snap.com/en-US" target="_blank"><img src="{{asset('Influencer/images/Snapchat1.png')}}"> Snap</a></li>
                               <li><a href="https://twitter.com/" target="_blank"><img src="{{asset('Influencer/images/twiter.png')}}"> Twitter</a></li>
                               <li><a href="https://www.youtube.com" target="_blank"><img src="{{asset('Influencer/images/youtube.png')}}"> YouTube</a></li>
                               <li><a href="https://www.instagram.com/" target="_blank"><img src="{{asset('Influencer/images/instagram.png')}}"> Instagram</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="row footer_bottom">
                   <div class="col-lg-12">
                       <div class="footer-bottom-in">
                           <p>Copyright©2023. All Rights Reserved.</p>
                           <p>Developed with <i class="fas fa-heart"></i> by <a href="http://www.yesitlabs.com/" target="_blank"> YES
                                   IT LABS LLC</a></p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </footer>
   <!-- Footer-Section -->