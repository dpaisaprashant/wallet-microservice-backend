<?php

namespace App\Http\Controllers;

use App\Events\LoadTestFundEvent;
use App\Models\LoadTestFund;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        $transactions = LoadTestFund::with('user')
            ->whereNotNull('pre_transaction_id')
            ->latest()
            ->paginate(15);

        return view('admin.refund.index')->with(compact('transactions'));
    }

    public function create(Request $request)
    {
        $users = User::latest()->get();
        if ($request->isMethod('post')) {

            $user = User::where('mobile_no', $request->mobile_no)->firstOrFail();
            $preTransaction = PreTransaction::where('pre_transaction_id', $request->pre_transaction_id)->firstOrfail();

            if ($user->id != $preTransaction->user_id) {
                return redirect()->back()->with('error', "Pre transaction and user doesn't match");
            }


            $currentBalance = Wallet::whereUserId($user->id)->first()->getOriginal('balance');
            $data = [
                'pre_transaction_id' => $preTransaction->pre_transaction_id,
                'admin_id' => auth()->user()->id,
                'user_id' => $user->id,
                'description' => $request['description'],
                'before_amount' => $currentBalance,
                //'after_amount' => $currentBalance + ($request['amount'] * 100)
                'after_amount' => $currentBalance + ($preTransaction->getOriginal('amount'))
            ];

            $transaction = LoadTestFund::create($data);
            if (! $transaction) return redirect(route('loadTestFund.index'))->with('error', 'Transaction not created successfully');

            event(new LoadTestFundEvent($transaction));
            return redirect(route('refund.index'))->with('success', 'Transaction created successfully');
        }

        return view('admin.refund.create')->with(compact('users'));
    }
}
