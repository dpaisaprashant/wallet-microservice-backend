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

        //return FundRequest::with('toUser', 'fromUser', 'commission')->latest()->filter($this->request)->paginate($this->length);

        $transactions = LoadTestFund::with('user')->latest()->filter(\request())->paginate(15);
        return view('admin.loadTestTransaction.index')->with(compact('transactions'));
    }

    public function create(Request $request)
    {
        $users = User::latest()->get();
        if ($request->isMethod('post')) {

            $currentBalance = Wallet::whereUserId($request->user_id)->first()->balance * 100;
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

    public function paypointIndex()
    {
        $transactions = LoadTestFund::with('user')
            ->where('description', 'Paypoint Load')
            ->latest()->paginate(15);
        return view('admin.loadTestTransaction.paypoint.index')->with(compact('transactions'));
    }


    public function paypointLoadCreate(Request $request)
    {
        $user = User::where('id', 1356)->firstorFail();
        if ($request->isMethod('post')) {
            $currentBalance = Wallet::whereUserId($user->id)->first()->balance * 100;
            $data = [
                'pre_transaction_id' => $request->pre_transaction_id,
                'admin_id' => auth()->user()->id,
                'user_id' => $user->id,
                'description' => 'Paypoint Load',
                'before_amount' => $currentBalance,
                'after_amount' => $currentBalance + ($request['amount'] * 100)
            ];

            $transaction = LoadTestFund::create($data);
            if (! $transaction) return redirect(route('loadTestFund.index'))->with('error', 'Transaction not created successfully');

            event(new LoadTestFundEvent($transaction));
            return redirect(route('paypoint.loadTestFund.index'))->with('success', 'Transaction created successfully');
        }

        return view('admin.loadTestTransaction.paypoint.create')->with(compact('user'));
    }
}
