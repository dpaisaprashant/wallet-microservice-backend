<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\IssueTicket\Http\Controllers\IssueTicketController;


Route::group(['prefix' => 'admin/transaction/', 'middleware' => ['web','auth']], function () {

    //View Load Wallet
    Route::get('issue-ticket', [IssueTicketController::class, 'view'])->name('issue.ticket.view')->middleware('permission:View issue ticket');
    Route::get('create-issue-ticket', [IssueTicketController::class, 'create'])->name('issue.ticket.create')->middleware('permission:Create issue ticket');
    Route::post('create-issue-ticket', [IssueTicketController::class, 'store'])->name('issue.ticket.store')->middleware('permission:Create issue ticket');
    Route::get('edit-issue-ticket/{id}', [IssueTicketController::class, 'edit'])->name('issue.ticket.edit')->middleware('permission:Edit issue ticket');
    Route::put('update-issue-ticket/{id}', [IssueTicketController::class, 'update'])->name('issue.ticket.update')->middleware('permission:Edit issue ticket');
    Route::post('delete-issue-ticket/{id}', [IssueTicketController::class, 'delete'])->name('issue.ticket.delete')->middleware('permission:Delete issue ticket');


    //Excel Export
//    Route::get('excel/nps-load-wallet', [PhpSpreadSheetController::class, 'NPSAccountLinkLoad'])->name('npsaccountlinkload.excel')->middleware('permission:Generate load wallet excel');;
    //View Report Page

});
