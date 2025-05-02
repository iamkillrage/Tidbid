<?php

// Website Front Page controller
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;


// Admin Panel Controller
use App\Http\Controllers\AdminController;


// Influencer Panel Controller
use App\Http\Controllers\InfluencerController;


//User Panel Controller
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Website Front Route
Route::get('/', [ExploreController::class, 'index'])->name('User_index');

Route::get('/explore', [ExploreController::class, 'Explore'])->name('Explore');
Route::get('/explore-stream', [ExploreController::class, 'Explore_Stream'])->name('Explore_Stream');
Route::get('/explore-stream-details/{id}', [ExploreController::class, 'Explore_Stream_Details'])->name('ExploreStreamDetails');
Route::get('/influencer-stream-details/{id}', [ExploreController::class, 'Influencer_Stream_Details'])->name('influencer-stream-details');
Route::get('/influencer-post-details/{id}', [ExploreController::class, 'Influencer_Post_Details'])->name('InfluencerPostDetails');
Route::get('/influencer-shedule-details/{id}', [ExploreController::class, 'Influencer_Shedule_Details'])->name('InfluencerSheduleDetails');
Route::get('/follower-user', [ExploreController::class, 'FollowerInfluencer'])->name('FollowerInfluencer');
Route::get('/my-stream-details', [ExploreController::class, 'My_Stream_Details'])->name('MyStreamDetails');


//Influencer Panel Route Start
Route::group(['prefix' => 'influencer'], function () {

    // Influencer Panel Sign In And Sign Up Route
    Route::get('/influencer-signIn', [InfluencerController::class, 'SignIn'])->name('SignIn');
    Route::post('/login', [InfluencerController::class, 'login'])->name('login');
    Route::get('/influencer-signUp', [InfluencerController::class, 'SignUp'])->name('SignUp');
    Route::get('/signup', [InfluencerController::class, 'influencer_signup'])->name('influencer_signup');
    Route::post('/influencer-SendOtp', [InfluencerController::class, 'SendOtp'])->name('SendOtp');
    Route::post('/influencer-create-signUp', [InfluencerController::class, 'create'])->name('create');
    Route::post('/registration', [InfluencerController::class, 'registration'])->name('registration');
    Route::get('/forgot-password', [InfluencerController::class, 'forotpassword'])->name('forgotpassword');
    Route::get('/influencer-OtpVerify', [InfluencerController::class, 'OtpVerify'])->name('OtpVerify');
    Route::post('/reset-password', [InfluencerController::class, 'resetpassword'])->name('resetpassword');
    Route::post('/reset-password-confirm', [InfluencerController::class, 'resetpasswordconfirm'])->name('resetpasswordconfirm');


    // Influencer Panel Route
    Route::get('/influencer-about', [InfluencerController::class, 'About_us'])->name('About_us');
    Route::get('/influencer-index', [InfluencerController::class, 'Influencer_index'])->name('Influencer_index');
    Route::get('/influencer-home', [InfluencerController::class, 'Influencer_Home'])->name('Influencer_Home');
    Route::get('/influencer-explore', [InfluencerController::class, 'Influencer_Explore'])->name('Influencer_Explore');
    Route::get('/influencer-stream', [InfluencerController::class, 'Influencer_Stream'])->name('Influencer_Stream');
    Route::get('/influencer-my-profile', [InfluencerController::class, 'Influencer_My_profile'])->name('Influencer_My_Profile');
    Route::post('/influencer-my-profile-create', [InfluencerController::class, 'Influencer_My_profile_Create'])->name('Influencer_My_Profile_Create');
    Route::get('/influencer-privacy-policy', [InfluencerController::class, 'Influencer_Privacy_policy'])->name('Influencer_Privacy_policy');
    Route::get('/influencer-terms-condition', [InfluencerController::class, 'Influencer_Terms_Condition'])->name('Influencer_Terms_Condition');
    Route::get('/influencer-no-saved-bank', [InfluencerController::class, 'Influencer_No_Saved_Bank'])->name('Influencer_No_Saved_Bank');
    Route::get('/influencer-add-bank', [InfluencerController::class, 'Influencer_Add_Bank'])->name('Influencer_Add_Bank');
    Route::get('/influencer-refer-a-friend', [InfluencerController::class, 'Influencer_Refer_a_Friend'])->name('Influencer_Refer_a_Friend');
    Route::get('/influencer-my-transactions', [InfluencerController::class, 'Influencer_My_Transactions'])->name('Influencer_My_Transactions');
});
// Influencer Panel Route End


// User Panel Route Start
Route::group(['prefix' => 'user'], function () {

    // User Panel Sign In And Sign Up Route

    Route::get('/user-signIn', [UserController::class, 'SignIn'])->name('User_SignIn');
    Route::any('/user-login', [UserController::class, 'Userlogin'])->name('Userlogin');
    Route::get('/user-signUp', [UserController::class, 'SignUp'])->name('User_SignUp');
    Route::post('/user-registration', [UserController::class, 'Userregistration'])->name('user-registration');
    Route::POST('/user-forgot-password', [UserController::class, 'Userforgotpassword'])->name('Userforgotpassword');
    Route::post('/user-otp-verify', [UserController::class, 'UserOtpVerify'])->name('UserOtpVerify');
    Route::post('/user-reset-password', [UserController::class, 'Userresetpassword'])->name('Userresetpassword');
    Route::post('/user-reset-password-confirm', [UserController::class, 'Userresetpasswordconfirm'])->name('Userresetpasswordconfirm');
    Route::get('/user-logout', [UserController::class, 'Userlogout'])->name('Userlogout');

    // User Panel Route
    // Route::middleware(['user.auth'])->group(function () {
    Route::get('/user-home', [UserController::class, 'User_Home'])->name('User_Home');
    Route::get('/user-about-us', [UserController::class, 'User_About_Us'])->name('UserAboutUs');
    Route::get('/user-my-profile', [UserController::class, 'User_Profile'])->name('User_Profile');
    Route::post('/user-my-profile-create', [UserController::class, 'User_My_profile_Create'])->name('User_My_Profile_Create');
    Route::get('/user-terms-condition', [UserController::class, 'User_Terms_Condition'])->name('User_Terms_Condition');
    Route::get('/user-privacy-policy', [UserController::class, 'User_Privacy_policy'])->name('User_Privacy_policy');
    Route::get('/user-payment-method', [UserController::class, 'User_Payment_Method'])->name('UserPaymentMethod');
    Route::get('/user-no-save-card', [UserController::class, 'User_No_Save_Card'])->name('UserNoSaveCard');
    Route::post('/user-add-card', [UserController::class, 'User_Add_Card'])->name('User_Add_Card');
    Route::get('/user-my-transactions', [UserController::class, 'User_My_Transactions'])->name('UserMyTransactions');
    Route::get('/user-refer-friends', [UserController::class, 'User_Refer_Friends'])->name('UserReferFriends');
    Route::get('/user-upcoming-stream', [UserController::class, 'User_Upcoming_Stream'])->name('UserUpcomingStream');
    Route::get('/user-following', [UserController::class, 'User_Following'])->name('UserFollowing');
    Route::get('/user-chat', [UserController::class, 'User_Chat'])->name('UserChat');
    Route::get('/user-live-stream', [UserController::class, 'UserLiveStream'])->name('UserLiveStream');
    Route::get('/user-auction', [UserController::class, 'User_Auction'])->name('UserAuction');
    Route::get('/user-my-stream-details', [UserController::class, 'User_My_Stream_Details'])->name('UserMyStreamDetails');
    Route::get('user-remove-followoing', [UserController::class, 'remove_follower'])->name('removefollower');
    Route::get('/user-bookmark', [UserController::class, 'User_Bookmark'])->name('UserBookmark');
    Route::get('/user-post', [InfluencerController::class, 'User_Post'])->name('User_Post');
});
// });
// User Panel Route End


// Admin Panel Route Start
Route::group(['prefix' => 'admins'], function () {

    // Admin Login Route
    Route::any('/', [AdminController::class, 'Admin_login'])->name('admin.Admin_login');
    Route::post('/admin-sign-in', [AdminController::class, 'Admin_Sign_In'])->name('Admin_Sign_In');


    // User Management Route
    Route::get('/user-management', [AdminController::class, 'User_management'])->name('User_management');
    Route::post('/user-delete', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/change-user-status', [AdminController::class, 'changeUserStatus'])->name('changeUserStatus');


    // Influencer Management Route
    Route::get('/influencer-management', [AdminController::class, 'Influencer_management'])->name('Influencer_management');


    // Varification Management Route
    Route::get('/varification-management', [AdminController::class, 'Varification_management'])->name('Varification_management');
    Route::post('/change-influencer-status', [AdminController::class, 'changeInfluencerStatus'])->name('changeInfluencerStatus');


    // Stream Management Route
    Route::get('/stream-management', [AdminController::class, 'Stream_management'])->name('Stream_management');
    Route::post('/change-stream-status', [AdminController::class, 'changeStreamStatus'])->name('changeStreamStatus');
    Route::post('/delete-stream', [AdminController::class, 'deleteStream'])->name('deleteStream');


    // Bid Management Route
    Route::get('/bid-management', [AdminController::class, 'Bid_management'])->name('Bid_management');
    Route::post('/delete-bid', [AdminController::class, 'deleteBid'])->name('deleteBid');

    // Post MAnagement Route
    Route::get('/post-management', [AdminController::class, 'Post_management'])->name('Post_management');
    Route::post('/post-delete', [AdminController::class, 'deletePost'])->name('deletePost');
    Route::post('/change-post-status', [AdminController::class, 'changePostStatus'])->name('changePostStatus');


    // Refer Friends Route 
    Route::get('/refer-a-friend', [AdminController::class, 'Refer_a_Friend'])->name('Refer_a_Friend');


    // Terms And Condition Route
    Route::get('/terms-condition', [AdminController::class, 'Terms_Condition'])->name('Terms_Condition');
    Route::post('/add-term-condetion', [AdminController::class, 'addTermCondetion'])->name('addTermCondetion');


    // Privacy Policy Route
    Route::get('/privacy-policy', [AdminController::class, 'Privacy_policy'])->name('Privacy_policy');
    Route::post('/privacy-policy-add', [AdminController::class, 'addPrivacyPolicy'])->name('addPrivacyPolicy');
});
// Admin Panel Route End