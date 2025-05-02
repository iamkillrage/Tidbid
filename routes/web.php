<?php
// Admin Panel Controller
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Influencer Panel Controller
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\ExploreController;

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

// Front Route
Route::get('/clear', function () {
    \Artisan::call('config:cache');
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');

    echo 'Caching Clear Compleated';
});

Route::get('/user-explore', [ExploreController::class, 'user_Explore'])->name('user_Explore');
Route::get('/influencer-stream-details/{id}', [ExploreController::class, 'Influencer_Stream_Details'])->name('influencer-stream-details');
Route::get('/influencer-post-details/{id}', [ExploreController::class, 'Influencer_Post_Details'])->name('InfluencerPostDetails');
Route::get('/influencer-shedule-details/{id}', [ExploreController::class, 'Influencer_Shedule_Details'])->name('InfluencerSheduleDetails');
Route::get('/Suggest_Influencer', [ExploreController::class, 'Suggest_Influencer'])->name('Suggest_Influencer');
Route::get('/eventdatas', [ExploreController::class, 'eventdatas'])->name('eventdatas');

Route::get('/explore-stream-data', [ExploreController::class, 'Explore_Stream'])->name('Explore_Stream');

Route::get('/notifyMeee', [ExploreController::class, 'notifyMeee'])->name('notifyMeee');
Route::get('/joinStreeming', [InfluencerController::class, 'joinStreeming'])->name('joinStreeming');

// Influencer Panel Route
Route::get('/', [InfluencerController::class, 'Home'])->name('Home');
Route::get('/explore', [InfluencerController::class, 'Explore'])->name('Explore');
Route::get('/about-us', [InfluencerController::class, 'about_us'])->name('about_us');
Route::get('/Explore-Stream', [InfluencerController::class, 'explore_stream'])->name('explore_stream');
Route::get('/detail-stream-page', [InfluencerController::class, 'Detail_Stream_Page'])->name('Detail_Stream_Page');
Route::get('/detail-post-page', [InfluencerController::class, 'Detail_Post_Page'])->name('Detail_Post_Page');
Route::get('/detail-schedule-page', [InfluencerController::class, 'Detail_Schedule_Page'])->name('Detail_Schedule_Page');
Route::get('Privacy-policy', [InfluencerController::class, 'Privacy_Policy'])->name('Privacy_Policy');
Route::get('/terms-condition', [InfluencerController::class, 'terms_condition'])->name('terms_condition');
Route::post('/post-report', [InfluencerController::class, 'Post_Report'])->name('Post_Report');
Route::get('/influencer-explore', [InfluencerController::class, 'Influencer_Explore'])->name('Influencer_Explore');
Route::get('/Influencer-Explore-ajax', [InfluencerController::class, 'Influencer_ExploreAjax'])->name('Influencer_ExploreAjax');
Route::get('/influencer-explore-stream', [InfluencerController::class, 'Influencer_Explore_Stream'])->name('Influencer_Explore_Stream');
Route::get('/influencer-explore-stream-ajax', [InfluencerController::class, 'Influencer_Explore_Stream_Ajax'])->name('Influencer_Explore_Stream_Ajax');
Route::get('/influencer-my-stream-details', [InfluencerController::class, 'Influencer_My_Stream_Detail'])->name('Influencer_My_Stream_Detail');
Route::get('/resend-Otp', [InfluencerController::class, 'resenOtp'])->name('resenOtp');
Route::get('/endBid', [InfluencerController::class, 'endBid'])->name('endBid');

Route::get('/influencer-signIn', [InfluencerController::class, 'SignIn'])->name('SignIn');
Route::post('/login', [InfluencerController::class, 'login'])->name('login');
Route::get('/influencer-signUp', [InfluencerController::class, 'SignUp'])->name('SignUp');
Route::post('/influencer-Sign-Up', [InfluencerController::class, 'influencerSignUp'])->name('influencerSignUp');
Route::post('/matcheOtp', [InfluencerController::class, 'matcheOtp'])->name('matcheOtp');
Route::post('/forgot-password', [InfluencerController::class, 'forgotpassword'])->name('forgotpassword');
Route::post('/verifyotp', [InfluencerController::class, 'verifyotp'])->name('verifyotp');
Route::post('/reset-password', [InfluencerController::class, 'resetpassword'])->name('resetpassword');
Route::post('/reset-password-confirm', [InfluencerController::class, 'resetpasswordconfirm'])->name('resetpasswordconfirm');
Route::get('/influencer-verification', [InfluencerController::class, 'InfluencerVerification'])->name('InfluencerVerification');

Route::get('/createuserPwd', [InfluencerController::class, 'createuserPwd'])->name('createuserPwd');

Route::get('/eventdata', [InfluencerController::class, 'eventdata'])->name('eventdata');

// Influencer Panel Route
Route::get('/notifyMe', [InfluencerController::class, 'notifyMe'])->name('notifyMe');
Route::middleware(['login'])->group(function () {
    Route::get('/influencer-index', [InfluencerController::class, 'Influencer_index'])->name('Influencer_index');
    Route::get('/influencer-my-profile', [InfluencerController::class, 'Influencer_My_profile'])->name('Influencer_My_Profile');
    Route::post('/influencer-my-profile-create', [InfluencerController::class, 'Influencer_My_profile_Create'])->name('Influencer_My_profile_Create');
    Route::get('/influencer-about', [InfluencerController::class, 'Influencer_About_us'])->name('Influencer_About_us');

    Route::get('/influencer-stream', [InfluencerController::class, 'Influencer_Stream'])->name('Influencer_Stream');
    Route::post('/influener-create-stream', [InfluencerController::class, 'Influencer_Create_Stream'])->name('Influencer_Create_Stream');
    //13-11-24
    Route::post('/influener-live-stream', [InfluencerController::class, 'Influencer_Live_Stream'])->name('Influencer_Live_Stream');
    //13-11-24
    Route::post('/influencer-update-stream', [InfluencerController::class, 'Influencer_Update_Stream'])->name('Influencer_Update_Stream');
    Route::get('/influencer-delete-stream', [InfluencerController::class, 'Influencer_Delete_Stream'])->name('Influencer_Delete_Stream');
    Route::get('/influencer-post', [InfluencerController::class, 'Influencer_Post'])->name('Influencer_Post');
    Route::post('/influencer-create-post', [InfluencerController::class, 'Influencer_Create_Post'])->name('Influencer_Create_Post');
    Route::post('/influencer-update-post', [InfluencerController::class, 'Influencer_Update_Post'])->name('Influencer_Update_Post');
    Route::get('/influencer-delete-post', [InfluencerController::class, 'Influencer_Delete_Post'])->name('Influencer_Delete_Post');
    Route::get('/influencer-no-saved-bank', [InfluencerController::class, 'Influencer_No_Saved_Bank'])->name('Influencer_No_Saved_Bank');
    Route::get('/influencer-saved-bank', [InfluencerController::class, 'Influencer_Saved_Bank'])->name('Influencer_Saved_Bank');
    Route::get('/new-add-bank', [InfluencerController::class, 'New_Add_Bank'])->name('New-Add-Bank');
    Route::get('/influencer-add-bank', [InfluencerController::class, 'Influencer_Add_Bank'])->name('Influencer_Add_Bank');
    Route::get('/influencer-logout', [InfluencerController::class, 'Logout'])->name('Logout');
    Route::get('/influencer-my-transactions', [InfluencerController::class, 'Influencer_My_Transaction'])->name('Influencer_My_Transaction');
    Route::get('/influencer-refer-a-friend', [InfluencerController::class, 'Refer_A_Friend'])->name('Refer_A_Friend');
    Route::get('/influencer-my-followers', [InfluencerController::class, 'Influencer_My_Follower'])->name('Influencer_My_Follower');
    Route::get('/influencer-my-live-stream/{id}', [InfluencerController::class, 'Influencer_My_Live_Stream'])->name('Influencer_My_Live_Stream');
    Route::get('/influencer-chat/{id}', [InfluencerController::class, 'Influencer_Chat'])->name('InfluencerChat');
    Route::get('/live', [InfluencerController::class, 'go_live'])->name('go_live');
    Route::get('/video-chat/{id}', [InfluencerController::class, 'video_chat'])->name('video_chat');

    Route::get('/get-all-Influencer-post', [InfluencerController::class, 'getAllInfluencerPost'])->name('getAllInfluencerPost');
    Route::post('/exportTransection', [InfluencerController::class, 'exportTransection'])->name('exportTransection');

    Route::get('/infusendLiveComment', [InfluencerController::class, 'infusendLiveComment'])->name('infusendLiveComment');
    Route::get('/InfuLiveStreamComment', [InfluencerController::class, 'InfuLiveStreamComment'])->name('InfuLiveStreamComment');
    Route::get('/get_gift_infu', [InfluencerController::class, 'get_gift_infu'])->name('get_gift_infu');

    Route::get('/influencer-post-ajax', [InfluencerController::class, 'Influencer_Post_ajax'])->name('Influencer_Post_ajax');
    Route::post('/post-commnet', [InfluencerController::class, 'post_commnet'])->name('post_commnet');
    Route::post('/post-like', [InfluencerController::class, 'post_like'])->name('post_like');
    Route::post('/add-post-book-mark', [InfluencerController::class, 'add_post_book_mark'])->name('add_post_book_mark');
    Route::get('/follower-user', [InfluencerController::class, 'FollowerUser'])->name('FollowerUser');
    Route::get('/remove-follower', [InfluencerController::class, 'remove_follower'])->name('remove_follower');
    Route::get('/Suggest_Influencer', [InfluencerController::class, 'Suggest_Influencer'])->name('Suggest_Influencer');
    Route::post('/block-post', [InfluencerController::class, 'Block_Post'])->name('Block_Post');
    Route::get('/influencer_bookmark', [InfluencerController::class, 'Influencer_Bookmark'])->name('Influencer_Bookmark');

    Route::get('/get-Post-comment', [InfluencerController::class, 'get_Post_comment'])->name('get_Post_comment');
    Route::get('/getPost_like', [InfluencerController::class, 'getPost_like'])->name('getPost_like');
    Route::get('/blockPost', [InfluencerController::class, 'blockPost'])->name('blockPost');

    Route::get('/Influencer_Delete_Bank', [InfluencerController::class, 'Influencer_Delete_Bank'])->name('Influencer_Delete_Bank');
    Route::get('/check-social-verification', [InfluencerController::class, 'checkSocialVerification'])->name('checkSocialVerification');

    Route::get('/infu-send-message', [InfluencerController::class, 'InfuSendMessage'])->name('InfuSendMessage');
    Route::get('/get-messages', [InfluencerController::class, 'getMessage'])->name('getMessage');
    Route::get('/get-last-message-inf', [InfluencerController::class, 'getLastMessageInf'])->name('getLastMessageInf');

    Route::get('/joinUserChanel', [InfluencerController::class, 'joinUserChanel'])->name('joinUserChanel');

    // working from 09-10-2024
    Route::get('/notification-inf', [InfluencerController::class, 'NotificationInf'])->name('notification-inf');
});


// User Panel Route Start
// User Panel Sign In And Sign Up Route
Route::get('/user-signIn', [UserController::class, 'SignIn'])->name('User_SignIn');
Route::any('/user-login', [UserController::class, 'Userlogin'])->name('Userlogin');
Route::get('/user-signUp', [UserController::class, 'SignUp'])->name('User_SignUp');
Route::post('/user-create-signUp', [UserController::class, 'createUser'])->name('createUser');
Route::post('/user-SendOtp', [UserController::class, 'UserSendOtp'])->name('UserSendOtp');
Route::post('/user-register2', [UserController::class, 'Userregistration2'])->name('user-registration2');
Route::post('/user-forgot-password', [UserController::class, 'Userforgotpassword'])->name('Userforgotpassword');
Route::post('/user-otp-verify', [UserController::class, 'UserOtpVerify'])->name('UserOtpVerify');
Route::post('/user-reset-password', [UserController::class, 'Userresetpassword'])->name('Userresetpassword');
Route::post('/user-reset-password-confirm', [UserController::class, 'Userresetpasswordconfirm'])->name('Userresetpasswordconfirm');
Route::get('/user-logout', [UserController::class, 'Userlogout'])->name('Userlogout');
Route::get('/user-resend-Otp', [UserController::class, 'UserresenOtp'])->name('UserresenOtp');

// User Panel Route

Route::middleware(['userlogin'])->group(function () {

    Route::get('/get-video-url', [UserController::class, 'getVideoUrl'])->name('getVideoUrl');

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
    Route::get('/user-chat/{id}', [UserController::class, 'User_Chat'])->name('UserChat');
    Route::get('/user-my-transaction-downloads', [UserController::class, 'getDownload'])->name('transactiongetDownload');
    Route::get('/user-live-stream/{id}', [UserController::class, 'UserLiveStream'])->name('UserLiveStream');
    Route::get('/user-auction/{id}', [UserController::class, 'User_Auction'])->name('UserAuction');
    Route::get('user-remove-followoing', [UserController::class, 'remove_follower'])->name('removefollower');
    Route::get('/user-bookmark', [UserController::class, 'User_Bookmark'])->name('UserBookmark');
    Route::get('/my-stream-details/{id}', [UserController::class, 'My_Stream_Details'])->name('MyStreamDetails');
    Route::get('/follower-users', [UserController::class, 'Follower_User'])->name('FollowerUser');
    Route::post('/add_card', [UserController::class, 'add_card'])->name('add_card');
    Route::get('/delete_user_card', [UserController::class, 'delete_card'])->name('delete_card');
    Route::get('/send_gift', [UserController::class, 'send_gift'])->name('send_gift');
    Route::get('/send_gift_user', [UserController::class, 'send_gift_user'])->name('send_gift_user');
    Route::get('/bid-now', [UserController::class, 'bidNow'])->name('bidNow');
    Route::get('/export-user-transection', [UserController::class, 'exportUserTransection'])->name('exportUserTransection');
    Route::get('/notifyMee', [UserController::class, 'notifyMee'])->name('notifyMee');
    Route::get('/get-post-comment-user', [UserController::class, 'get_Post_comment_user'])->name('get_Post_comment_user');
    Route::get('/get-post-like-user', [UserController::class, 'getPost_like_user'])->name('getPost_like_user');
    Route::get('/post-report-user', [UserController::class, 'Post_Report_user'])->name('Post_Report_user');
    Route::get('/block-post-user', [UserController::class, 'blockPost_user'])->name('blockPost_user');
    Route::get('/post-commnet-user', [UserController::class, 'post_commnet_user'])->name('post_commnet_user');
    Route::get('/post-like-user', [UserController::class, 'post_like_user'])->name('post_like_user');
    Route::get('/add-post-book-mark-user', [UserController::class, 'add_post_book_mark_user'])->name('add_post_book_mark_user');

    Route::get('/set_primary_card', [UserController::class, 'set_primary_card'])->name('set_primary_card');
    Route::get('/sendLiveComment', [UserController::class, 'sendLiveComment'])->name('sendLiveComment');
    Route::get('/LiveStreamComment', [UserController::class, 'LiveStreamComment'])->name('LiveStreamComment');
    Route::post('/post-reports', [UserController::class, 'Post_Reports'])->name('Post_Reports');
  
    Route::get('/send-message', [UserController::class, 'sendMessage'])->name('sendMessage');
    Route::get('/get-message', [UserController::class, 'getMessage'])->name('getMessage');
    Route::get('/get-last-message', [UserController::class, 'getLastMessage'])->name('getLastMessage');
    Route::get('/video-call/{id}', [UserController::class, 'video_chat'])->name('video_chat');


    // working from 09-10-2024
    Route::get('/notification-user', [UserController::class, 'NotificationUser'])->name('notification-user');
    
        Route::post('/upload-voice', [UserController::class, 'uploadVoice'])->name('upload.voice');


});
// User Panel Route End

// Admin Panel Route
Route::group(['prefix' => 'admin'], function () {
    Route::any('/', [AdminController::class, 'Admin_login'])->name('admin.Admin_login');
    Route::post('/admin-sign-in', [AdminController::class, 'Admin_Sign_In'])->name('Admin_Sign_In');
    Route::get('/', [AdminController::class, 'Admin_login'])->name('Admin_login');
    Route::middleware(['admin.auth'])->group(function () {

        Route::get('/user-management', [AdminController::class, 'User_management'])->name('User_management');
        Route::post('/user-delete', [AdminController::class, 'deleteUser'])->name('deleteUser');
        Route::post('/change-user-status', [AdminController::class, 'changeUserStatus'])->name('changeUserStatus');

        Route::get('/influencer-management', [AdminController::class, 'Influencer_management'])->name('Influencer_management');
        Route::get('/varification-management', [AdminController::class, 'Varification_management'])->name('Varification_management');

        Route::get('/stream-management', [AdminController::class, 'Stream_management'])->name('Stream_management');
        Route::post('/change-stream-status', [AdminController::class, 'changeStreamStatus'])->name('changeStreamStatus');
        Route::post('/delete-stream', [AdminController::class, 'deleteStream'])->name('deleteStream');
        Route::post('/editStream', [AdminController::class, 'editStream'])->name('editStream');

        Route::get('/bid-management', [AdminController::class, 'Bid_management'])->name('Bid_management');
        Route::post('/delete-bid', [AdminController::class, 'deleteBid'])->name('deleteBid');
        Route::post('/change-bid-status', [AdminController::class, 'changeBidStatus'])->name('changeBidStatus');
        Route::post('/editBid', [AdminController::class, 'editBid'])->name('editBid');

        Route::get('/post-management', [AdminController::class, 'Post_management'])->name('Post_management');
        Route::post('/change-post-status', [AdminController::class, 'changePostStatus'])->name('changePostStatus');
        Route::post('/delete-post', [AdminController::class, 'deletePost'])->name('deletePost');
        Route::post('/editPost', [AdminController::class, 'editPost'])->name('editPost');

        Route::get('/refer-a-friend', [AdminController::class, 'Refer_a_Friend'])->name('Refer_a_Friend');

        //Admin panel in Terms And Condition Route
        Route::get('/terms-condition', [AdminController::class, 'Terms_Condition'])->name('Terms_Condition');
        Route::post('/add-term-condetion', [AdminController::class, 'addTermCondetion'])->name('addTermCondetion');

        // Admin panel in Privacy Policy Route
        Route::get('/privacy-policy', [AdminController::class, 'Privacy_policy'])->name('Privacy_policy');
        Route::post('/privacy-policy-add', [AdminController::class, 'addPrivacyPolicy'])->name('addPrivacyPolicy');

        Route::post('/addUserCard', [AdminController::class, 'addUserCard'])->name('addUserCard');
        Route::post('/editUser', [AdminController::class, 'editUser'])->name('editUser');
        Route::post('/changeInfluencerStatus', [AdminController::class, 'changeInfluencerStatus'])->name('changeInfluencerStatus');

        Route::get('/admin-logout', [AdminController::class, 'Admin_Logout'])->name('Admin_Logout');
    });
});
