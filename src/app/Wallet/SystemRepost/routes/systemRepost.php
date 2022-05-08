<?php

use App\Wallet\SystemRepost\Http\Controllers\SystemRefundController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {
   Route::match(['get', 'post'],'/system-repost',[SystemRefundController::class,'viewSystemRepost'])->name('view.system.repost'); //todo: add middleware

   Route::post('/system-repost-create',[SystemRefundController::class,'microserviceRepost'])->name('create.system.repost');
});
