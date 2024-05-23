<?php
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles -- Testing
    Route::apiResource('roles', 'RolesApiController');

    // Users API Changes 
    Route::apiResource('users', 'UsersApiController');
});
Route::post('login',[App\Http\Controllers\Api\Api\AuthController::class,'login']);
Route::get('loginpost',[App\Http\Controllers\Api\Api\AuthController::class,'loginpost']);
Route::post('sign-up',[App\Http\Controllers\Api\Api\AuthController::class,'registerPOST']);

Route::middleware('auth:api')->group(function () {
    Route::GET('my-profile',[App\Http\Controllers\Api\Api\AuthController::class,'myProfile']);
    Route::POST('update-password',[App\Http\Controllers\Api\Api\AuthController::class,'updatePassword']);
    Route::get('battles-list',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'challangeList']);
    Route::get('cancel-challenge-req',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'cancelChallengeReq']);
    Route::POST('request-game',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'challengeRequesting']);
    Route::get('deny-challenge',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'denyChallenge']);
    Route::GET('accept-challenge',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'acceptChallenge']);
    Route::POST('create-challenge',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'store']);
    Route::POST('delete-challange',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'deleteChallange']);
    Route::GET('transaction-history',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'transactionHistory']);
    Route::GET('challange-details',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'challangeDetails']);
    Route::POST('submit-result',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'markResult']);
    Route::POST('cencel-challange',[App\Http\Controllers\Api\Api\GameChallangeApiController::class,'cencelChallange']);


    // Route::post('create-update-challange',[App\Http\Controllers\Api\GameChallangeApiController::class,'store']);
    // Route::get('challange-type-list',[App\Http\Controllers\Api\GameChallangeApiController::class,'challangeTypeList']);
    // Route::get('delete-challange/{id}',[App\Http\Controllers\Api\GameChallangeApiController::class,'deleteChallange']);
    // Route::post('user-update',[App\Http\Controllers\Api\PlayerApiController::class,'updateUser']);
    // Route::post('accept-challange',[App\Http\Controllers\Api\GameChallangeApiController::class,'acceptChallange']);
    // Route::get('challange-history',[App\Http\Controllers\Api\GameChallangeApiController::class,'challangeHistory']);
    // Route::post('add-money',[App\Http\Controllers\Api\TransactionApiController::class,'addMoney']);
    // Route::get('transaction-history/{type}',[App\Http\Controllers\Api\TransactionApiController::class,'transactionHistory']);
    // Route::post('withdrawal-money',[App\Http\Controllers\Api\TransactionApiController::class,'withdrawalMoney']);
    // Route::post('mark-result',[App\Http\Controllers\Api\GameChallangeApiController::class,'markResult']);
    // // Route::post('cencel-challange',[App\Http\Controllers\Api\GameChallangeApiController::class,'cencelChallange']);
    // Route::get('single-challange/{challange_id}',[App\Http\Controllers\Api\GameChallangeApiController::class,'singleChallange']);
    // Route::get('withdrawal-history',[App\Http\Controllers\Api\TransactionApiController::class,'withdrawalHistory']);
});
// Route::post('otp-varify',[App\Http\Controllers\Api\AuthController::class,'verifyOtp']);
// Route::post('user-login',[App\Http\Controllers\Api\AuthController::class,'userLogin']);
// Route::post('reset-password',[App\Http\Controllers\Api\AuthController::class,'resetPassword']);
// Route::post('varify-id-reset-password',[App\Http\Controllers\Api\AuthController::class,'varifyId']);
Route::get('site-settings',[App\Http\Controllers\Api\AuthController::class,'siteSetting']);