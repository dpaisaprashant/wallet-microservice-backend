<?php


use Illuminate\Support\Facades\Route;
use App\Wallet\Scheme\Http\Controllers\SchemeController;
Route::group(['prefix' => 'admin/scheme', 'middleware' => ['web','auth']], function () {

    Route::get('/view-scheme-data',[SchemeController::class,'index'])->name('scheme.index');
    Route::get('/create-scheme-data',[SchemeController::class,'create'])->name('scheme.create');
    Route::post('/create-scheme-data',[SchemeController::class,'store'])->name('scheme.store');
    Route::post('/delete-scheme-data/{id}',[SchemeController::class,'delete'])->name('scheme.delete');
    Route::get('/edit-scheme-data/{id}',[SchemeController::class,'edit'])->name('scheme.edit');
    Route::post('/edit-scheme-data/{id}',[SchemeController::class,'update'])->name('scheme.update');

});
