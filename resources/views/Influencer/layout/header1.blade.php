<header>
    <!-- NAV-STRIP -->
    <div class="second_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container">
                            <a class="navbar-brand_2" href="{{route('Influencer_index')}}"><img src="{{asset('Influencer/images/logo.svg') }}" alt=""></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse mt-0" id="navbarNav">

                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link  {{Request::is('influencer-index') ? 'class=text-dark':'text-white'}}" href="{{route('Influencer_index')}}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Request::is('influencer-about') ? 'class=text-dark':'text-white'}}" href="{{route('Influencer_About_us')}}">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  {{Request::is('influencer-explore') ? 'class=text-dark':'text-white'}}" href="{{route('Influencer_Explore')}}">Explore</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Request::is('influencer-stream') ? 'class=text-dark':'text-white'}}" href="{{route('Influencer_Stream')}}"> My
                                            Upcoming Stream</a>
                                    </li>
                                  
                                    <li class="nav-item bg-lightpink text-dark rounded-pill mb-3">
                                        <a class="nav-link" href="{{url('user-signIn')}}">For Users</a>
                                    </li>
                             

                                    <!-- <li class="nav-item"><a href="{{route('Influencer_My_Profile')}}"><img src="{{asset('Influencer/images/profile_img/' . request()->session()->get('profile_img'))}}"></a></li> -->
                                    <li class="nav-item">
                                        @if(request()->session()->has('profile_img'))
                                        <a href="{{ route('Influencer_My_Profile') }}">
                                            <img src="{{ asset('Influencer/images/profile_img/' . request()->session()->get('profile_img')) }}">
                                        </a>
                                        @else
                                        <!-- Display a default image when no image is uploaded -->
                                        <a href="{{ route('Influencer_My_Profile') }}">
                                            <img src="{{ asset('Influencer/images/dummy.jpg') }}">
                                        </a>
                                        @endif
                                    </li>
                                    {{-- <li class="bell-icon"><a href="#"><img src="{{asset('Influencer/images/bell-icon.png')}}"></a></li> --}}

                                    {{-- Notification --}}
                                    <div class="notification-in">
                                      <button type="button" id="notification_icon"><img src="{{ asset('Influencer/images/bell-icon.png') }}"></button>
                                      <div class="notification-list">
                                          <div class="notification-heading">
                                              <h1>Notifications</h1>
                                          </div>
                                          <div class="notification-list-inner" id="notification_list">
                                              <!-- Notifications will be dynamically loaded here -->
                                          </div>
                                      </div>
                                  </div>

                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- NAV-STRIP -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Notification Ajax --}}
    <script>
      $(document).ready(function() {
        $('#notification_icon').click(function() {

            $.ajax({
                url: "{{ route('notification-inf') }}",
                method: 'GET',
                success: function(resp) {
                      // Clear any existing notifications
                      $('#notification_list').empty();
                      
                      if (resp.notifications.length > 0) {
                          $.each(resp.notifications, function(index, notification) {
                              var notificationHTML = `
                                  <div class="notification-list-item">
                                      <div class="notification-list-item-text">
                                          <p>` + notification.title + `</p>
                                          <p style="font-size: 12px;">` + notification.message + `</p>
                                          <span><i class="far fa-clock"></i> ` + notification.created_at + `</span>
                                      </div>
                                  </div>
                              `;
                              $('#notification_list').append(notificationHTML);
                          });
                      } else {
                          $('#notification_list').html('<p>No notifications available</p>');
                      }
                  },
                  error: function(xhr, status, error) {
                      console.log("Error:", error);
                  }
            });
        });
      });
    </script>
</header>

<!-- logout Popup -->
 
<!--logout Popup-->