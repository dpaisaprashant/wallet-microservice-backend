<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\Report\Repositories\MismatchedUserBalanceRepository;
use Illuminate\Http\Request;

class MismatchedUserBalanceController extends Controller
{
    public function report(Request $request)
    {
        $repository = new MismatchedUserBalanceRepository($request);
        $users = $repository->getMismatchedBalanceUser();
        return view('WalletReport::MismatchedUserBalance/report')->with(compact('users'));
    }

}
