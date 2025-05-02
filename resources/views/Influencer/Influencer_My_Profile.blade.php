@extends('LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Influencers My Profile | TidBid</title>
    <style>
    #toast-container .toast-success {
        background-color: green !important; /* Adjust color as per your need */
    }
</style>
</head>

<body>
    <!-- Header-Section -->
    @include('Influencer.layout.header1')
    <!-- Header-Section -->
    <!-- Main-Section -->
    <main>
        <div class="prof_lefsect">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="profile_left">
                            <ul>
                                <a href="{{ route('Influencer_My_Profile') }}" class="text-white">
                                    <li class="{{ Request::is('influencer-my-profile') ? 'pro_active' : '' }}">
                                        <img src="{{ asset('Influencer/images/my-profile.svg') }}" alt=""> My Profile
                                    </li>
                                </a>
                                <a href="{{ route('Influencer_Saved_Bank') }}" class="text-white">
                                    <li class="{{ Request::is('influencer-saved-bank') ? 'pro_active' : '' }}">
                                        <img src="{{ asset('Influencer/images/Payment.svg') }}" alt=""> Payment Method
                                    </li>
                                </a>
                                <a href="{{ route('Influencer_My_Transaction') }}" class="text-white">
                                    <li class="{{ Request::is('influencer-my-transactions') ? 'pro_active' : '' }}">
                                        <img src="{{ asset('Influencer/images/Payment.svg') }}" alt=""> My Transactions
                                    </li>
                                </a>
                                <a href="{{ route('Refer_A_Friend') }}" class="text-white">
                                    <li class="{{ Request::is('influencer-refer-a-friend') ? 'pro_active' : '' }}">
                                        <img src="{{ asset('Influencer/images/Refer.svg') }}" alt=""> Refer a Friend
                                    </li>
                                </a>
                                <a href="{{ url('influencer-chat/{id}') }}" class="text-white">
                                    <li class="{{ Request::is('influencer-chat') ? 'pro_active' : '' }}">
                                        <img src="{{ asset('Influencer/images/chat.svg') }}" alt=""> Chats
                                    </li>
                                </a>
                                <a href="{{ route('Influencer_Bookmark') }}" class="text-white">
                                    <li class="{{ Request::is('influencer_bookmark') ? 'pro_active' : '' }}">
                                        <img src="{{ asset('Influencer/images/bookmark.png') }}" alt=""> Bookmarks
                                    </li>
                                </a>
                                <a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#exampleModal_3">
                                    <li>
                                        <img src="{{ asset('Influencer/images/logout.svg') }}" alt=""> Logout
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <div class="left_pinkbg">
                            <div class="people_img"><img src="{{asset('Influencer/images/People-img.png') }}"></div>
                            <p>View People you follow</p>
                            <a href="{{route('Influencer_My_Follower')}}">My Followers</a>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="pro_right">
                            
                            @if(empty($userdata->name) && empty($userdata->phone) && empty($userdata->dob) && empty($userdata->bio))

                            <div class="pro_head">Please complete your Profile</div>
                            @else
                            <div class="pro_head">Profile</div>
                            @endif

                            <div class="probox">
                                <div class="prof_img">
                                    @if(!empty($userdata->profile_img))
                                    <img id="preview_image" src="{{asset('/Influencer/images/profile_img/'.$userdata->profile_img)}}" name="profile_img" class="preview-circle">
                                    @else
                                    <img src="{{asset('user.jpg')}}" class="preview-circle" id="preview_image">
                                    @endif
                                </div>
                                @if($userdata->profile_img)
                                <a href="#" id="upload_icon" class="upload_icon comman"><img src="{{asset('Influencer/images/upload.png')}}"></a>
                                @else
                                <a href="#" id="upload_icon" class="upload_icon"><img src="{{asset('Influencer/images/upload.png')}}"></a>
                                @endif
                            </div>
                            @error('profile_img')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="text-danger" id="img_error"></span>
                            <form id="completeprofile" enctype="multipart/form-data">
                                @csrf
                                 @if($userdata->profile_img)
                                <input type="file" accept="image/*" class="comman" name="profile_img" id="image_input" style="display: none;">
                                   @else
                                   <input type="file" accept="image/*" name="profile_img" id="image_input" style="display: none;">
                                   @endif
                                <p id="message" style="color: red; display: none;">Please select a valid image file.</p>
                                <input type="hidden" name='id' value="{{$userdata->id}}">

                                <div class="pro_filed">
                                    <div class="form_icon"><img src="{{asset('Influencer/images/person.svg')}}"></div>
                                    @if($userdata->name )
                                    <input type="text" name="name" class="comman" id="name" value="{{ $userdata->name ? $userdata->name:old('name') }}" placeholder="Full Name"> <br>
                                    @else
                                    <input type="text" name="name" class="" id="name" placeholder="Full Name"> <br>
                                    @endif
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger" id="name_error"></span>
                                <div class="pro_filed">
                                    <div class="form_icon"><img src="{{asset('Influencer/images/person.svg')}}"></div>
                                    <input type="text" name="userName" class="comman" value="{{ $userdata->userName }}" placeholder="Username" readonly>
                                </div>
                                @error('userName')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="pro_filed">
                                    <div class="form_icon"><img src="{{asset('Influencer/images/mail.png')}}"></div>
                                    <input type="text" name="email" class="comman" placeholder="Email" value="{{$userdata->email}}" readonly>
                                </div>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="pro_filed">
                                    <div class="form_icon"><img src="{{asset('Influencer/images/call.png')}}"></div>
                                    @if($userdata->phone)
                                    <input type="text" pattern="[0-9]*" name="phone" class="comman" id="phone" value="{{ $userdata->phone ? $userdata->phone:old('phone') }}" placeholder="Enter your Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    @else
                                    <input type="text" pattern="[0-9]*" name="phone" class="" id="phone" placeholder="Enter your Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    @endif
                                </div>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger" id="phone_error"></span>
                                <div class="pro_filed">
                                    @php
                                    $dobs = date("m-d-Y", strtotime($userdata->dob))

                                    @endphp

                                    <div class="form_icon"><img src="{{asset('Influencer/images/date-time.png')}}">
                                    </div>
                                    @if($userdata->dob)
                                    <input type="text" name="dob" id="dob" class="comman" value="{{ $userdata->dob ? date('m-d-Y', strtotime($userdata->dob )) ? $dobs:old('dob') : $userdata->dob }}" placeholder="Date of Birth">
                                    @else
                                    <input type="text" name="dob" id="dob" class="" placeholder="Date of Birth">
                                    @endif
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger" id="dob_error"></span>
                                <div class="social_outer">
                                    <h3>Social Site Link</h3>
                                    @forelse($InfluencerSocial as $socialId)
                                    <div class="pro_filed_1">
                                        @if($socialId->social_site_link)
                                        <input type="text" placeholder="Enter your Social Media Link" class="comman" id="social" value="{{ $socialId->social_site_link }}" name="social_site_link[]" required>
                                        @else
                                        <input type="text" placeholder="Enter your Social Media Link" class="comman" id="social" value="{{ $socialId->social_site_link }}" name="social_site_link[]" required>
                                        @endif
                                    </div>
                                    @empty
                                    <div class="pro_filed_1">

                                        <input type="text" placeholder="Enter your Social Media Link" name="social_site_link[]" required>

                                    </div>
                                    @endforelse
                                    <div class="pro_filed_1data"></div>




                                    <button type="button" class="add-more-input"><img src="{{asset('Influencer/images/plus-line.svg')}}" class="pr-2">Add
                                        More</button>

                                    <div class="clear"></div>
                                </div>

                                <div class="pro_filed profil-textare">
                                    @if($userdata->bio)
                                    <textarea name="bio" id="bio" class="comman" placeholder="Enter Your Bio">{{$userdata->bio ? $userdata->bio:old('bio') }}</textarea>
                                    @else
                                    <textarea name="bio" id="bio" class="" placeholder="Enter Your Bio"></textarea>
                                    @endif
                                </div>
                                @error('bio')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger" id="bio_error"></span>
                                <!-- <div class="pro_btn1">
                                    <button type="submit" class="pro_save">Save</button>
                                </div> -->
                                {{-- <a href="#" class="pro_edit"></a> --}}
                                <div class="pro_btn1 btn-class">
                                    <button type="button" id="edit_btn" class="pro_edit">Edit</button>
                                    @if($userdata->name)
                                    <button type="submit" id="save_btn" class="pro_save" disabled>Save</button>
                                    @else
                                    <button type="submit" id="save_btn" class="pro_save">Save</button>
                                    @endif
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <!-- Main-Section -->
    <!-- Footer-Section -->
    @include('Influencer.layout.footer')
    <!-- Footer-Section -->

    <!-- logout Popup -->
    <div class="modal fade" id="exampleModal_3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times-circle"></i></button>
                <div class="modal-body pt-0 pb-5 ">
                    <div class="succes_box">
                        <img src="{{asset('Influencer/images/logout2.png')}}">
                        <h3>Do you want to logout?</h3>
                        <div class="cardbtn"><a href="{{route('Logout')}}" class="">Ok</div>
                        {{-- <button type="button" class="cardbtn">Ok</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--logout Popup-->

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<script>
    $(function() {
        $("#dob").datepicker({

            dateFormat: 'mm-dd-yy',
            maxDate: 0
        });
    });
</script>
<script>
    // $(document).ready(function() {
    //     var i = 1;
    //     $('.add-more-input').click(function() {
    //         i++;
    //         $('.pro_filed_1data').append('<div class="pro_filed_1" id="row' + i +
    //             '"><input type="text" required name="social_site_link[]" placeholder="Enter your instagram Link"><div class="form_icon"><img src="https://tidbidadmin.tgastaging.com/Influencer/images/maki_cross.svg" id="' +
    //             i + '" class="w-20 btn_remove"></div></div>');
    //     });

    //     $(document).on('click', '.btn_remove', function() {
    //         var button_id = $(this).attr("id");
    //         $('#row' + button_id + '').remove();
    //     });

    // });


    $(document).ready(function() {
        $('#upload_icon').click(function(e) {
            e.preventDefault();
            $('#image_input').click();
        });

        $('#image_input').change(function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(file);
        });


        $('#upload_button').click(function() {
            var formData = new FormData();
            formData.append('image', $('#image_input')[0].files[0]);

            $.ajax({
                url: 'upload.php',
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
    document.getElementById('image_input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const messageElement = document.getElementById('message');

        if (file) {
            const fileType = file.type.split('/')[0];

            if (fileType !== 'image') {
                messageElement.style.display = 'block';
                this.value = '';
            } else {
                messageElement.style.display = 'none';

            }
        }
    });
</script>

// <script>
//     $(document).ready(function() {
//         // 1) By default sabhi .comman fields disable kar do
//         $(".comman").prop("disabled", true);

//         // 2) Save button ko disable kar do
//         // $("#save_btn").prop("disabled", true);

//         // 3) Edit button click
//         $("#edit_btn").click(function() {
//             // Sabhi fields enable
//             $(".comman").prop("disabled", false);

//             // Save button enable
//             $("#save_btn").prop("disabled", false);

//             // Edit button disable
//             $(this).prop("disabled", true);
//         });

//         // 4) Form submit hone se pehle (optional):
//         //    Agar aap chahein, form submit hote hi fields ko wapas disable kar sakte hain 
//         //    ya toast message dikha sakte hain. Lekin page reload ho jaayega agar normal form submission hai.

//         //    (Optional) If you want an AJAX submission instead of normal reload:

//         $("#completeprofile").submit(function(e) {
//             e.preventDefault();

//             // Agar aap sirf text fields update kar rahe hain, to simple data collect kar sakte hain:
//             // var name = $("#name").val();
//             // var phone = $("#phone").val();
//             // ... etc.

//             // Lekin agar file (profile_img) bhi upload karni hai, to FormData use karein:
//             var formData = new FormData(this);

//             $.ajax({
//                 url: "{{ route('Influencer_My_profile_Create') }}",
//                 type: "POST",
//                 data: formData,
//                 contentType: false,
//                 processData: false,
//                 success: function(response) {
//                     console.log(response);
//                     if(response.isnew)
//                     toastr.success("Profile created successfully").fadeOut(5000);
//                 else
//                     toastr.success("Profile updated successfully").fadeOut(5000);
                    
//                     location.reload();
//                     // Wapas fields disable
//                     $(".comman").prop("disabled", true);
//                     $("#edit_btn").prop("disabled", false);
//                     $("#save_btn").prop("disabled", true);
//                 },
//                 error: function(xhr) {
//                     $(".text-danger").text(""); // Clear previous errors

//                     let errors = xhr.responseJSON.errors; // Get the validation errors

//                     if (errors.phone) {
//                         $("#phone_error").text(errors.phone[0]); // Display phone error
//                     }

//                     if (errors.name) {
//                         $("#name_error").text(errors.name[0]); // Display phone error
//                     }
//                     if (errors.profile_img) {
//                         $("#img_error").text(errors.profile_img[0]); // Display phone error
//                     }
//                     if (errors.dob) {
//                         $("#dob_error").text(errors.dob[0]); // Display phone error
//                     }
//                     if (errors.bio) {
//                         $("#bio_error").text(errors.bio[0]); // Display phone error
//                     }
//                 }

//             });
//         });

//     });
// </script>


<script>
    $(document).ready(function() {
        var i = 1;

        // ✅ By default sabhi input aur "Add More" button disable karo
        $(".comman").prop("disabled", true);
        $(".add-more-input").prop("disabled", true);

        // ✅ "Edit" button click hone par sab enable hoga
        $("#edit_btn").click(function() {
            $(".comman").prop("disabled", false);
            $(".add-more-input").prop("disabled", false);
            $(this).prop("disabled", true); // Edit button disable
            $("#save_btn").prop("disabled", false); // Save button enable
        });

        // ✅ Add more input field
        $('.add-more-input').click(function() {
            i++;
            $('.pro_filed_1data').append(
                `<div class="pro_filed_1" id="row${i}">
                    <input type="text" required name="social_site_link[]" class="comman" placeholder="Enter your Social Media Link">
                    <div class="form_icon">
                        <img src="https://tidbidadmin.tgastaging.com/Influencer/images/maki_cross.svg" id="${i}" class="w-20 btn_remove">
                    </div>
                </div>`
            );
        });

        // ✅ Remove added input field
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id).remove();
        });

        // ✅ Form submission via AJAX
        $("#completeprofile").submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('Influencer_My_profile_Create') }}",
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
                         }, 2000);                    // ✅ Form submit hone ke baad wapas disable karna hai
                     $(".comman").prop("disabled", true);
                    $(".add-more-input").prop("disabled", true);
                    $("#edit_btn").prop("disabled", false);
                    $("#save_btn").prop("disabled", true);
                },
                error: function(xhr) {
                    $(".text-danger").text(""); // Clear previous errors

                    let errors = xhr.responseJSON.errors;
                    if (errors.phone) $("#phone_error").text(errors.phone[0]);
                    if (errors.name) $("#name_error").text(errors.name[0]);
                    if (errors.profile_img) $("#img_error").text(errors.profile_img[0]);
                    if (errors.dob) $("#dob_error").text(errors.dob[0]);
                    if (errors.bio) $("#bio_error").text(errors.bio[0]);
                }
            });
        });

    });
</script>

<script>
    
    $(document).ready(function() {
    $("#phone").on("input", function() {
        var phone = $(this).val();
        if (phone.length === 0) {
            $("#phone_error").text("Please fill this phone field");
        } else {
            $("#phone_error").text("");
        }
    });

    $("#completeprofile").submit(function(e) {
        var phone = $("#phone").val();

        if (phone.length === 0) {
            e.preventDefault();
            $("#phone_error").text("please fill this phone field");
            return false;
        }
    });
});

</script>
@endsection