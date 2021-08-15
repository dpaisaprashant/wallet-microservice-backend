<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\TransactionEvent;
use App\Models\User;
use Illuminate\Http\Request;

class MismatchedUserBalanceController extends Controller
{
    public function report(){

        $users = User::with('latestUserTransactionEvent','wallet')->get();
//        dd($users);
        return view('WalletReport::MismatchedUserBalance/report')->with(compact('users'));
    }

}
