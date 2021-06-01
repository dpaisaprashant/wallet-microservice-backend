<?php

namespace App\Http\Controllers;

use App\Events\LoadTestFundEvent;
use App\Models\LoadTestFund;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class LoadTestFundController extends Controller
{
    public function index()
    {
        $transactions = LoadTestFund::with('user')->latest()->paginate(15);
        return view('admin.loadTestTransaction.index')->with(compact('transactions'));
    }

    public function create(Request $request)
    {
        $users = User::latest()->get();
        if ($request->isMethod('post')) {

            $currentBalance = Wallet::whereUserId($request->user_id)->first()->getOriginal('balance');
            $data = [
                'pre_transaction_id' => $request->pre_transaction_id,
                'admin_id' => auth()->user()->id,
                'user_id' => $request->user_id,
                'description' => $request['description'],
                'before_amount' => $currentBalance,
                'after_amount' => $currentBalance + ($request['amount'] * 100)
            ];

            $transaction = LoadTestFund::create($data);
            if (! $transaction) return redirect(route('loadTestFund.index'))->with('error', 'Transaction not created successfully');

            event(new LoadTestFundEvent($transaction));
            return redirect(route('loadTestFund.index'))->with('success', 'Transaction created successfully');
        }

        return view('admin.loadTestTransaction.create')->with(compact('users'));
    }
}
