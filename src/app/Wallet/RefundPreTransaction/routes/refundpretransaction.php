<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\RefundPreTransaction\Http\Controllers\RefundPreTransactionController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //PreTransaction CRUD
    Route::get('refund/pretransactions', [RefundPreTransactionController::class, 'view'])->name('refund.pretransaction.view')->middleware('permission:Refund view pretransaction');
    Route::get('refund/create-pretransaction', [RefundPreTransactionController::class, 'create'])->name('refund.pretransaction.create')->middleware('permission:Refund create pretransaction');
    Route::post('refund/create-pretransaction', [RefundPreTransactionController::class, 'store'])->name('refund.pretransaction.store')->middleware('permission:Refund create pretransaction');
    Route::get('refund/edit-pretransaction/{id}', [RefundPreTransactionController::class, 'edit'])->name('refund.pretransaction.edit')->middleware('permission:Refund edit pretransaction');
    Route::put('refund/edit-pretransaction/{id}', [RefundPreTransactionController::class, 'update'])->name('refund.pretransaction.update')->middleware('permission:Refund edit pretransaction');
//    Route::post('refund/delete-pretransaction/{id}', [RefundPreTransactionController::class, 'delete'])->name('refund.pretransaction.delete')->middleware('permission:Delete refund pretransaction');

});
