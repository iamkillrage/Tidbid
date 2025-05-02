@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>Influencers Home Post Option-2 | TidBid</title>

</head>

<body>
  <!-- Header-Section -->
  <header>
    <!-- NAV-STRIP -->

    <!-- NAV-STRIP -->
    <!-- BANNER-SECTION -->
    <div class="banner-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="container">
                <a class="navbar-brand_2" href="influencers-home-post-option-2.html"><img src="images/logo.svg"
                    alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-0" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link text-dark" href="{{route('Influencer_Home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white" href="{{route('About_us')}}">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white" href="{{route('Influencer_Explore')}}">Explore</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white" href="{{route('Influencer_Stream')}}"> My Upcoming Stream</a>
                    </li>
                    <li class="nav-item bg-lightpink text-dark rounded-pill mb-3">
                      <a class="nav-link" href="{{route('/user-signIn')}}">For Users</a>
                    </li>
                    <li class="nav-item"><a href="{{route('Influencer_My_Profile')}}"><img
                          src="{{asset('Influencer/images/login_img.png')}}"></a></li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-7 col-md-6 col-sm-12">
            <div class="banner-inner">
              <h1>Explore your favourite influencers and grab a Ball of a time!</h1>
              <p>Welcome to our vibrant live streaming portal - TidBid, where the world comes alive with captivating
                moments and thrilling experiences. Step into a virtual universe that seamlessly blends entertainment,
                connection, and boundless creativity. </p>
              <a href="#">View More</a>
            </div>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12">
            <div class="header_right">
              <img src="images/banner-right.png">
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header-Section -->
  <!-- Main-Section -->
  <main>
    <div class="main_influncer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="post_left">
              <div class="post_h">
                <h4>Streaming Live </h4>
              </div>
              <!--Item-->
              <div class="post_sect">
                <div class="post_img">
                  <div class="tag_on"><img src="images/online_tag.png"></div>
                  <div class=" post_img2"> <img src="images/post_img1.png"></div>
                  <div class="clear"></div>
                </div>
                <div class="post_text">
                  <h5>Zoesennett </h5>
                  <p>15 mins private chat</p>
                  <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                    <p>Wed, March 5</p>
                  </div>
                  <div class="post_btn"><a href="my-live-stream.html" class="join_btn_1">Join Now</a></div>
                </div>
              </div>
              <!--Item-->

              <!--Item-->
              <div class="post_sect">
                <div class="post_img">
                  <div class="tag_on"><img src="images/online_tag.png"></div>
                  <div class=" post_img2"> <img src="images/post_img1.png"></div>
                  <div class="clear"></div>
                </div>
                <div class="post_text">
                  <h5>Zoesennett</h5>
                  <p>Lorem Ipsum is simply</p>
                  <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                    <p>Wed, March 5</p>
                  </div>
                  <div class="post_btn"><a href="my-live-stream.html" class="join_btn_1">Join Now</a></div>
                </div>
              </div>
              <!--Item-->

              <!--Item-->
              <div class="post_sect">
                <div class="post_img">
                  <div class="tag_on"><img src="images/online_tag.png"></div>
                  <div class=" post_img2"> <img src="images/post_img1.png"></div>
                  <div class="clear"></div>
                </div>
                <div class="post_text">
                  <h5>Zoesennett</h5>
                  <p>Lorem Ipsum is simply</p>
                  <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                    <p>Wed, March 5</p>
                  </div>
                  <div class="post_btn"><a href="my-live-stream.html" class="join_btn_1">Join Now</a></div>
                </div>
              </div>
              <!--Item-->


              <!--Item-->
              <div class="post_sect">
                <div class="post_img">
                  <div class="tag_on"><img src="images/online_tag.png"></div>
                  <div class=" post_img2"> <img src="images/post_img1.png"></div>
                  <div class="clear"></div>
                </div>
                <div class="post_text">
                  <h5>Zoesennett</h5>
                  <p>Lorem Ipsum is simply</p>
                  <div class="Post_icon"><i class="fas fa-calendar-alt"></i>
                    <p>Wed, March 5</p>
                  </div>
                  <div class="post_btn"><a href="my-live-stream.html" class="join_btn_1">Join Now</a></div>
                </div>
              </div>
              <!--Item-->
            </div>
            <div class="post_left">
              <div class="post_h">
                <h4 class="text-center">Refer a Friend</h4>
              </div>
              <div class="refer_img"><img src="images/refer_1.png"></div>

              <div class="refer_text">
                <h5>Refer & Earn $10 auction free</h5>
                <p>Invite your friend to join TidBid and both of you will get $10 for your next auction absolutely free.
                </p>
                <a href="influencers-refer-a-friend.html"><img src="images/file-upload.svg">Refer a friend</a>
              </div>
            </div>
          </div>


          <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="posthead">
              <h3><b>All Post</b></h3>
            </div>

            <div class="postright">

              <div class="post_profile">
                <div class="postimg">
                  <div class="person_img">
                    <img src="images/about_img1.png">
                  </div>
                  <div class="person_text">
                    <h5>Zoesennett</h5>
                    <span><i class="fas fa-map-marker-alt"></i>Los Angeles, California </span>
                  </div>
                </div>


                <div class="dropdown">
                  <button class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/dropdown_dot.svg">
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><img src="images/block.svg"> Block</a></li>
                    <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal"><img
                          src="images/report.svg"> Report</a></li>
                  </ul>
                </div>

              </div>


              <div class="post_lgimg mt-4"><img src="images/profile_lg.png"></div>

              <div class="icon_box">
                <ul class="comment_box pb-0">
                  <li><a href="#"><i class="far fa-heart"></i></a></li>
                  <li><a href="#"><i class="far fa-comment"></i></a></li>
                  <li><a href="#" data-bs-toggle="modal" data-bs-target="#share-Popup2"><i
                        class="fas fa-paper-plane"></i></a></li>
                </ul>

                <div class="save_icon"><a href="#"><i class="far fa-bookmark"></i></a></div>
              </div>

              <div class="desc_box"><img src="images/login_img.png"><a href="#" class="pinktext" data-bs-toggle="modal"
                  data-bs-target="#like_popup">Liked by</a> Jordan and 9 others</div>
              <div class="black_text">
                <a href="">View all 2,400 Comments</a>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </p>
                <span>28 min ago</span>

              </div>


              <div class="post_form">
                <div class="form_img"><img src="images/userinflu_img8.png"></div>
                <div class="post_search">
                  <input type="text" placeholder="Write a comment...">
                  <a href="#"><img src="images/send3.png" alt=""></a>
                </div>
              </div>


            </div>


            <div class="postright">

              <div class="post_profile">
                <div class="postimg">
                  <div class="person_img">
                    <img src="images/about_img1.png">
                  </div>
                  <div class="person_text">
                    <h5>Zoesennett</h5>
                    <span><i class="fas fa-map-marker-alt"></i>Los Angeles, California </span>
                  </div>
                </div>


                <div class="dropdown">
                  <button class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/dropdown_dot.svg">
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><img src="images/block.svg"> Block</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><img
                          src="images/report.svg"> Report</a></li>
                  </ul>
                </div>

              </div>


              <div class="post_lgimg mt-4"><img src="images/postimg2.png"></div>

              <div class="icon_box">
                <ul class="comment_box pb-0">
                  <li><a href="#"><i class="far fa-heart"></i></a></li>
                  <li><a href="#"><i class="far fa-comment"></i></a></li>
                  <li><a href="#" data-bs-toggle="modal" data-bs-target="#share-Popup2"><i
                        class="fas fa-paper-plane"></i></a></li>
                </ul>

                <div class="save_icon"><a href="#"><i class="far fa-bookmark"></i></a></div>
              </div>

              <div class="desc_box"><img src="images/login_img.png"><a href="#" class="pinktext" data-bs-toggle="modal"
                  data-bs-target="#like_popup">Liked by</a> Jordan and 9 others</div>
              <div class="black_text">
                <a href="">View all 2,400 Comments</a>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </p>
                <span>28 min ago</span>

              </div>


              <div class="post_form">
                <div class="form_img"><img src="images/userinflu_img8.png"></div>
                <div class="post_search">
                  <input type="text" placeholder="Write a comment...">
                  <a href="#"><img src="images/send3.png" alt=""></a>
                </div>
              </div>


            </div>


          </div>



        </div>
      </div>
    </div>



  </main>
  <!-- Main-Section -->
  <!-- Footer-Section -->
  <footer>
    <div class="footer-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="footer-in">
              <img src="images/footer_logo.png" alt="">

            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="footer-in footer-in-mid">
              <h1>Quick Links</h1>
              <p><a href="influencers-home-post-option-2.html">Home</a></p>
              <p><a href="Influencers-about-us.html">About</a></p>
              <p><a href="influencers-explore-influencers.html">Explore Now</a></p>
              <p><a href="influencers-terms-and-conditions.html">Terms and Conditions</a></p>
              <p><a href="influencers-privacy-policy.html">Privacy Policy</a></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="footer-in">
              <h1>Connect with us</h1>
              <ul class="social_link">
                <li><a href="#"><img src="images/tik-tok.png"> TikTok</a></li>
                <li><a href="#"><img src="images/twiter.png"> Twitter</a></li>
                <li><a href="#"><img src="images/youtube.png"> YouTube</a></li>
                <li><a href="#"><img src="images/instagram.png"> Instagram</a></li>
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


  <!--Like Popup -->
  <div class="modal fade" id="like_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
            class="fas fa-times-circle"></i></button>
        <h1 class="modal-title text-center report-h5">Likes</h1>

        <div class="modal-body pt-0 pb-5 scrollbar scrollbar2" id="style-2">
          <div class="like_outr force-overflow">

            <div class="likebox">
              <div class="likeimg"><img src="images/userinflu_img6.png"></div>
              <div class="liketext">
                <p>Kathryn Murphy</p>
              </div>
            </div>


            <div class="likebox">
              <div class="likeimg"><img src="images/userinflu_img6.png"></div>
              <div class="liketext">
                <p>Kathryn Murphy</p>
              </div>
            </div>

            <div class="likebox">
              <div class="likeimg"><img src="images/userinflu_img6.png"></div>
              <div class="liketext">
                <p>Kathryn Murphy</p>
              </div>
            </div>

            <div class="likebox">
              <div class="likeimg"><img src="images/userinflu_img6.png"></div>
              <div class="liketext">
                <p>Kathryn Murphy</p>
              </div>
            </div>

            <div class="likebox">
              <div class="likeimg"><img src="images/userinflu_img6.png"></div>
              <div class="liketext">
                <p>Kathryn Murphy</p>
              </div>
            </div>

            <div class="likebox">
              <div class="likeimg"><img src="images/userinflu_img6.png"></div>
              <div class="liketext">
                <p>Kathryn Murphy</p>
              </div>
            </div>

            <div class="likebox">
              <div class="likeimg"><img src="images/userinflu_img6.png"></div>
              <div class="liketext">
                <p>Kathryn Murphy</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Like Popup  -->

  <!-- Popup Report -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
            class="fas fa-times-circle"></i></button>

        <div class="modal-body pt-0">
          <h1 class="modal-title text-center report-h5">Report </h1>

          <textarea placeholder="Enter reason for reporting" class="textarea_sect"></textarea>

        </div>

        <button type="button" class="Report_btn" data-bs-dismiss="modal">Submit</button>


      </div>
    </div>
  </div>

  <!-- Popup Report -->

  <!-- Popup share -->
  <div class="modal fade" id="share-Popup2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i
            class="fas fa-times-circle"></i></button>

        <div class="modal-body pt-0 pb-5">
          <h1 class="modal-title text-center report-h5">Share </h1>

          <ul class="social_icon">
            <li><a href="#"><img src="images/facebook.svg"></a></li>
            <li><a href="#"><img src="images/instagram.svg"></a></li>
            <li><a href="#"><img src="images/x-twitter.svg"></a></li>
            <li><a href="#"><img src="images/linkedin.svg"></a></li>
          </ul>

        </div>



      </div>
    </div>
  </div>

  <!-- Popup share -->

  <!-- Footer-Section -->
  
</body>

</html>
@endsection