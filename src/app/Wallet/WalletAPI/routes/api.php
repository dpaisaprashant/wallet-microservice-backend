<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth Requiring middlewares
Route::group(['middleware' => 'user-status'], function () {

    //Microservice
    Route::post("microservice/request-info", "MicroserviceController@requestInfo");
    Route::post("microservice/pre-transaction", "MicroserviceController@preTransaction");

    //Load Microservice
    Route::post("microservice/load-transaction", "MicroserviceLoadTransactionController@preTransaction");

    //Check User
    Route::post("check-user", "UserController@checkUser");
    //Route::get("current-user-info", "UserController@currentUserInfo");

    Route::get("transaction-vendors", "UserController@transactionVendors");

    //Referrals
    Route::post("apply-referral-code", "UserReferralController@applyReferral")->middleware('referral-status');



});
?>
