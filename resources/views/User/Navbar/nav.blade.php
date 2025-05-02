<!-- NAV-STRIP -->
<div class="second_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <a class="navbar-brand_2" href="{{route('User_Home')}}"><img src="{{asset('Influencer/images/logo.svg')}}" alt=""></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse mt-0" id="navbarNav">

                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{route('User_Home')}}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{route('UserAboutUs')}}">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{route('user_Explore')}}">Explore</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{route('UserUpcomingStream')}}"> My Upcoming Stream</a>
                                </li>

                                <li class="nav-item bg-lightpink text-dark rounded-pill">
                                    <a class="nav-link" href="{{route('SignIn')}}">For Influencers</a>
                                </li>

                               <li class="nav-item">
                                    <a href="{{ route('User_Profile') }}">
                                        <img src="{{ auth()->user()->profile_img ? asset('Influencer/images/profile_img/' . auth()->user()->profile_img) : asset('Influencer/images/dummy.jpg') }}">
                                    </a>
                                </li>


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

{{-- Notification Ajax --}}
<script>
    $(document).ready(function() {
       $('#notification_icon').click(function() {

           $.ajax({
               url: "{{ route('notification-user') }}",
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

