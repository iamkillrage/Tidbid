@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <title>User My Profile | TidBid</title>
</head>

<body>

  <!-- Header-Section -->
  <header>
    @include('User.Navbar.nav')
  </header>
  <!-- Header-Section -->

  <!-- Main-Section -->
  <main>

    <div class="prof_lefsect">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="profile_left">
              <ul>

                <li class="{{ request()->is('user-my-profile') ? 'pro_active' : '' }}">
                  <img src="{{ asset('Influencer/images/my-profile.svg') }}">
                  <a href="{{ route('User_Profile') }}">My Profile</a>
                </li>

                <li class="{{ request()->is('user-no-save-card') ? 'pro_active' : '' }}">
                  <img src="{{asset('Influencer/images/Payment.svg')}}">
                  <a href="{{route('UserNoSaveCard')}}">Payment Method</a>
                </li>

                <li class="{{ request()->is('user-my-transactions') ? 'pro_active' : '' }}">
                  <img src="{{asset('Influencer/images/Payment.svg')}}">
                  <a href="{{route('UserMyTransactions')}}">My Transactions</a>
                </li>

                <li class="{{ request()->is('user-refer-friends') ? 'pro_active' : '' }}">
                  <img src="{{asset('Influencer/images/Refer.svg')}}">
                  <a href="{{route('UserReferFriends')}}">Refer A Friend</a>
                </li>
                <li>
                  <img src="{{asset('Influencer/images/chat.svg') }}">
                  <a href="{{url('user-chat/self')}}">Chats</a>
                </li>


                <li class="{{ request()->is('user-bookmark') ? 'pro_active' : '' }}">
                  <img src="{{asset('Influencer/images/bookmark.png')}}">
                  <a href="{{route('UserBookmark')}}">Bookmarks</a>
                </li>

                <li>
                  <img src="{{asset('Influencer/images/logout.svg')}}">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_3">Logout</a>
                </li>

              </ul>


            </div>

            <div class="left_pinkbg">
              <div class="people_img"><img src="{{asset('Influencer/images/People-img.png')}}"></div>
              <p>View People you follow</p>
              <a href="{{route('UserFollowing')}}">My Following</a>

            </div>
          </div>

          <div class="col-lg-9 col-md-8 col-sm-12">
            @if (session('success'))
            <script>
              toastr.success('Profile updated successfully!');
            </script>
            @endif

            @if (session('error'))
            <script>
              toastr.error('An error occurred while updating profile details..');
            </script>
            @endif
            <div class="pro_right">
              <!-- <div class="pro_head">Please complete your Profile</div> -->
              @if($useralldeatils->name =='' && $useralldeatils->phone =='' && $useralldeatils->dob =='')
              <div class="pro_head">Please complete your Profile</div>
              @else
              <div class="pro_head">Profile</div>
              @endif

              <form id="completeprofile" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_img" id="image_input" style="display: none;">
                <input type="hidden" name="id" value="{{ $useralldeatils->id }}">

                <div class="probox">
                  <div class="prof_img">
                    @if(!empty($useralldeatils->profile_img))
                    <img id="preview_image" src="{{asset('/Influencer/images/profile_img/'.$useralldeatils->profile_img)}}" name="profile_img" class="preview-circle">
                    @else
                    <img src="{{asset('user.jpg')}}" class="preview-circle" id="preview_image">
                    @endif
                  </div>
                  @if($useralldeatils->profile_img)
                  <a href="#" id="upload_icon" class="upload_icon comman"><img src="{{asset('Influencer/images/upload.png')}}"></a>
                  @else
                  <a href="#" id="upload_icon" class="upload_icon"><img src="{{asset('Influencer/images/upload.png')}}"></a>
                  @endif
                </div>
                @error('profile_img')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="img_error"></span>

                <div class="pro_filed">
                  <div class="form_icon"><img src="{{asset('Influencer/images/person.svg')}}"></div>
                  @if($useralldeatils->name)
                  <input type="text" name="name" id="name" class="comman" value="{{$useralldeatils->name}}" placeholder="Full Name">
                  @else
                  <input type="text" name="name" id="name"  placeholder="Full Name">
                  @endif
                </div>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="name_error"></span>
                <div class="pro_filed">
                  <div class="form_icon"><img src="{{asset('Influencer/images/mail.png')}}"></div>
                  <input type="text" name="email" class="comman" value="{{$useralldeatils->email}}" placeholder="Tidbid@gmail.com" readonly>
                </div>


                    <div class="pro_filed">
                      <div class="form_icon"><img src="{{asset('Influencer/images/call.png')}}"></div>
                      @if($useralldeatils->phone)
                      <input type="text" name="phone" class="comman" id="phone" value="{{$useralldeatils->phone}}" placeholder="Phone number" pattern="[0-9]*" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                      @else
                      <input type="text" name="phone" id="phone"  placeholder="Phone number" pattern="[0-9]*" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                      @endif
                    </div>
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="phone_error"></span>
                <div class="pro_filed">
                  @php
                  $dobs = date("m-d-Y", strtotime($useralldeatils->dob))
                  @endphp
                  <div class="form_icon"><img src="{{asset('Influencer/images/date-time.png')}}"></div>
                  @if($useralldeatils->dob)
                  <input type="text" name="dob" id="dob" class="comman" value="{{ $useralldeatils->dob ? date('m-d-Y', strtotime($useralldeatils->dob )) ? $dobs:old('dob') : $useralldeatils->dob }}" placeholder="Date of Birth">
                  @else
                  <input type="text" name="dob" id="dob"  placeholder="Date of Birth">
                  @endif
                  <i class="far fa-calendar-alt"></i>
                </div>
                @error('dob')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="dob_error"></span>
                <div class="pro_btn1 btn-class">
                  <button type="button" id="edit_btn" class="pro_edit">Edit</button>
                @if($useralldeatils->name)
                  <button type="submit" id="save_btn" class="pro_save" disabled>Save</button>
                  @else
                  <button type="submit" id="save_btn" class="pro_save">Save</button>
                  @endif
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!-- Main-Section -->


  <!-- logout Popup -->
  <div class="modal fade" id="exampleModal_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>

        <div class="modal-body pt-0 pb-5 ">
          <div class="succes_box">
            <img src="{{asset('Influencer/images/logout2.png')}}">
            <h3>Do you want to logout?</h3>
            <div class="cardbtn"><a href="{{route('Userlogout')}}" class="Ok_btn">Ok</a></div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!--logout Popup-->

</body>

</html>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" media="all">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if (session('success'))
<script>
  toastr.success('Profile updated successfully!', );
</script>
@endif


<script>
  $(function() {
    $("#dob").datepicker({

      dateFormat: 'mm-dd-yy',
      maxDate: 0
    });
  });
</script>



<script>
$(document).ready(function() {
        // 1) By default sabhi .comman fields disable kar do
        $(".comman").prop("disabled", true);

        // 2) Save button ko disable kar do
        // $("#save_btn").prop("disabled", true);

        // 3) Edit button click
        $("#edit_btn").click(function() {
            // Sabhi fields enable
            $(".comman").prop("disabled", false);

            // Save button enable
            $("#save_btn").prop("disabled", false);

            // Edit button disable
            $(this).prop("disabled", true);
        });

        // 4) Form submit hone se pehle (optional):
        //    Agar aap chahein, form submit hote hi fields ko wapas disable kar sakte hain 
        //    ya toast message dikha sakte hain. Lekin page reload ho jaayega agar normal form submission hai.

        //    (Optional) If you want an AJAX submission instead of normal reload:

        $("#completeprofile").submit(function(e) {
            e.preventDefault();

            // Agar aap sirf text fields update kar rahe hain, to simple data collect kar sakte hain:
            // var name = $("#name").val();
            // var phone = $("#phone").val();
            // ... etc.

            // Lekin agar file (profile_img) bhi upload karni hai, to FormData use karein:
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('User_My_Profile_Create') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if(response.isnew)
                    
                    toastr.success("Profile created successfully");
                else
                    toastr.success("Profile updated successfully");
                   setTimeout(function() {
                    location.reload();
                         }, 2000); 
                    // Wapas fields disable
                    $(".comman").prop("disabled", true);
                    $("#edit_btn").prop("disabled", false);
                    $("#save_btn").prop("disabled", true);
                },
                error: function(xhr) {
                    $(".text-danger").text(""); // Clear previous errors

                    let errors = xhr.responseJSON.errors; // Get the validation errors

                    if (errors.phone) {
                        $("#phone_error").text(errors.phone[0]); // Display phone error
                    }

                    if (errors.name) {
                        $("#name_error").text(errors.name[0]); // Display phone error
                    }
                    if (errors.profile_img) {
                        $("#img_error").text(errors.profile_img[0]); // Display phone error
                    }
                    if (errors.dob) {
                        $("#dob_error").text(errors.dob[0]); // Display phone error
                    }
                   
                }

            });
        });

    });
</script>

<script>
  $(document).ready(function() {
    var i = 1;
    $('.add-more-input').click(function() {
      i++;
      $('.pro_filed_1data').append('<div class="pro_filed_1" id="row' + i + '"><input type="text" required name="social_site_link[]" placeholder="Enter your instagram Link"><div class="form_icon"><img src="https://tidbidadmin.tgastaging.com/Influencer/images/maki_cross.svg" id="' + i + '" class="w-20 btn_remove"></div></div>');
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

  });

// $(document).ready(function() {
//     $('#upload_icon').click(function(e) {
//       e.preventDefault(); // Prevent default action of link
//       $('#image_input').click();
//     });

//     $('#image_input').change(function() {
//       var file = this.files[0];
//       var reader = new FileReader();

//       reader.onload = function(e) {
//         $('#preview_image').attr('src', e.target.result);
//       }

//       reader.readAsDataURL(file);
//     });

//     $('#upload_button').click(function() {
//       var formData = new FormData();
//       formData.append('image', $('#image_input')[0].files[0]);

//       $.ajax({
//         url: 'upload.php', // Your PHP endpoint to handle the upload
//         type: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function(response) {
//           // Handle success
//           alert('Image uploaded successfully!');
//         },
//         error: function(xhr, status, error) {
//           // Handle errors
//           console.error(error);
//         }
//       });
//     });
//   });

$(document).ready(function() {
    $('#upload_icon').click(function(e) {
        if ($('#save_btn').prop('disabled')) {
            e.preventDefault(); // Agar save button disabled hai toh kuch mat karo
            return false;
        }
        $('#image_input').click();
    });

    $('#image_input').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $('#upload_button').click(function() {
        var formData = new FormData();
        formData.append('image', $('#image_input')[0].files[0]);

        $.ajax({
            url: 'upload.php', // Your PHP endpoint to handle the upload
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Image uploaded successfully!');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>

<script>
$(document).ready(function() {
    $("#completeprofile").submit(function(e) {
        var phone = $("#phone").val().trim();

        if (phone === "" || phone.length !== 10) {
            e.preventDefault();
            $("#phone_error").text("please enter a valid number");
            return false;
        } else {
            $("#phone_error").text("");
        }
    });
});

</script>




<script>
  function clearFields() {
    $('.editbutton').hide();
    $('.submitbutton').show();
    document.getElementById('name').readOnly = false;
    document.getElementById('phone').readOnly = false;
    document.getElementById('dob').disabled = false;

  }
</script>

