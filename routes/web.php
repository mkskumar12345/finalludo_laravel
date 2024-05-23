<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\ChallangeTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
Route::redirect('/', '/login');
Auth::routes(['register' => false]);
Route::get('send-otp', 'AuthController@otp');
Route::get('verify-otp', 'AuthController@verifyOtp');
Route::get('login', 'AuthController@login')->name('login');
Route::get('loginpost', 'AuthController@loginpost')->name('loginpost');
Route::get('register', 'AuthController@register')->name('register');
Route::get('register-save', 'AuthController@registerPOST')->name('register-save');
Route::get('/support', 'AuthController@support');
Route::get('/test-cron', 'AuthController@testCron');
Route::get('/about-us', 'AuthController@aboutUs');
Route::get('/terms-and-conditions', 'AuthController@termsAndConditions');
Route::get('/privacy-policy', 'AuthController@privacyPolicy');
Route::get('/refund-and-cancellation-policy', 'AuthController@refund');
Route::get('/responsible-gaming', 'AuthController@responsibleGaming');

Route::get('run-cron', function () {
    \Artisan::call('schedule:run');
    echo "Route Cron Done!";
  });
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache cleared successfully!";
});

// bypass url
Route::post('/paymentgateway/kvm/payin', 'CommanController@paymentResponse');

// Route::get('/paymentgateway/kvm/payin', 'CommanController@paymentResponse');

Route::group(['middleware' => ['auth','CheckDeposit']], function () {
    Route::get('/home', 'AuthController@home');
    Route::get('/games/{slug}', 'GameController@index');
    Route::get('cancel-withdrawal/{id}', 'GameController@cancelWithdrawal');
    Route::get('/profile', 'AuthController@profile');
    Route::get('/kyc', 'AuthController@kyc');
    Route::POST('/uploadKycDoc', 'AuthController@uploadKycDoc')->name('uploadKycDoc');

    Route::get('/kyc/{filename}', function ($filename) {
        // Get the file path
        $path = storage_path('app/kyc/' . $filename);
    
        // Check if the file exists
        if (!Storage::exists('kyc/' . $filename)) {
            abort(404);
        }
    
        // Return the file with appropriate headers
        return response()->file($path);
    })->name('kyc.file');

    
    Route::get('/wallet', 'AuthController@wallet');
    Route::GET('/save-room-code', 'CommanController@saveRoomCode');
    Route::get('/game-history', 'AuthController@transactionHistory');
    Route::get('/transaction-history', 'AuthController@transactionHistoryNew');
    Route::get('/add-fund', 'AuthController@addFund');
    Route::get('/withdraw-funds', 'AuthController@withdrawFunds');
    Route::get('/withdraw-funds-live', 'AuthController@withdrawFundsLive');
    Route::get('/game-details/{id}', 'AuthController@showGame');
    Route::get('/refer-earn', 'AuthController@referEarn');
    Route::get('/game-history2', 'AuthController@gameHistory');
    Route::get('/notification', 'AuthController@notification');
    Route::POST('/add-withdrawal', 'AuthController@addWithdrawal');
    Route::POST('/add-withdrawal-live', 'AuthController@addWithdrawalLive');
    Route::GET('/add-money', 'CommanController@addMoney');
    


    Route::GET('/deposit', 'CommanController@deposit');
    Route::POST('/deposit-submit', 'CommanController@depositPOST');
    
    Route::get('/apply-name', 'AuthController@applyReferCode');
    Route::get('/logout', 'AuthController@logout');


    //Game routes
    Route::get('get-challenge-listing',[App\Http\Controllers\Api\GameChallangeApiController::class,'getList']);
    Route::get('challenge-listing',[App\Http\Controllers\Api\GameChallangeApiController::class,'challangeList']);
    Route::get('deny-challenge',[App\Http\Controllers\Api\GameChallangeApiController::class,'denyChallenge']);
    Route::get('delete-challange',[App\Http\Controllers\Api\GameChallangeApiController::class,'deleteChallange']);
    Route::post('create-challange',[App\Http\Controllers\Api\GameChallangeApiController::class,'store']);
    Route::GET('accept-challenge',[App\Http\Controllers\Api\GameChallangeApiController::class,'acceptChallenge']);
    Route::get('challenge-requesting',[App\Http\Controllers\Api\GameChallangeApiController::class,'challengeRequesting']);
    Route::get('cancel-challenge-req',[App\Http\Controllers\Api\GameChallangeApiController::class,'cancelChallengeReq']);
    Route::POST('mark-result',[App\Http\Controllers\Api\GameChallangeApiController::class,'markResult']);
    Route::POST('cancel-challange',[App\Http\Controllers\Api\GameChallangeApiController::class,'cencelChallange']);
    Route::POST('update-profile-img','AuthController@updatePrfileImg');
    Route::GET('update-password','AuthController@updatePassword');


});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/login', 'HomeController@login')->name('home');
    Route::POST('/login-post', 'HomeController@loginPOST')->name('home');
});

Route::group(['prefix' => 'dashboard', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth','isAdmin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    Route::resource('kyc-documents', 'KycDocumentsController');
    Route::get('kyc', 'KycDocumentsController@kyc')->name('kyc');
    Route::post('kyc-documents-upload', 'KycDocumentsController@store')->name('keycDocumentsUpload');
    Route::post('/kyc/{id}/{action}', 'KycDocumentsController@updateStatus')->name('updateStatus');


    
    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::post('money-man', 'UsersController@moneyMan')->name('money-man');

    // Pages
    Route::resource('pages', 'PageController');
    
    // settings
    Route::resource('site-seting','SiteSettingController');

    // challenges
    Route::resource('challanges', 'GameChallangeController');
    Route::get('challange-result','GameChallangeController@resultList')->name('challange-result');
    Route::get('show-result/{id}','GameChallangeController@showReslut')->name('show-result');
    Route::get('challange-cancel/{id}','GameChallangeController@challangeCancel');
    Route::post('mark-winner','GameChallangeController@markWinner')->name('mark-winner');

    //Withdrawal Request
    Route::resource('wihdrawal-request','WithdrawalRequestController');

    // fund request
    Route::resource('fund-request','FundRequestController');

    //challange type
    Route::resource('challange-type','ChallangeTypeController');

});

Route::get('page/{slug}',[App\Http\Controllers\Admin\PageController::class,'showPage']
            )->name('show-page');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return redirect('/')->with('success', trans('messages.success'));
 })->name('clear-cache');

 Route::group(['namespace' => 'Admin'], function () {
// Delete User
Route::get('delete-user/{user}', 'PageController@deleteUser')->name('delete-user');
 });
 
 
 Route::post('/payout/callBackMyPay', 'AuthController@callBackMyPay');

 