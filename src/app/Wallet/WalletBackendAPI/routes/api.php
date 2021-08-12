<?php
use App\Wallet\WalletBackendAPI\Http\Controllers\WalletBackendAPIController;

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


Route::post('/microservice/nchl/report/byId',[WalletBackendAPIController::class,'byId']);
