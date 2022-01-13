<?php

namespace App\Http\Controllers;

use App\Events\LoadTestFundEvent;
use App\Models\LoadTestFund;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoadTestFundController extends Controller
{
    public function index()
    {
        $transactions = LoadTestFund::with('user')->latest()->paginate(15);
        return view('admin.loadTestTransaction.index')->with(compact('transactions'));
    }

    public function loadTestDetail($id)
    {
        $transaction = LoadTestFund::with('user')->where('id','=',$id)->first();
        return view('admin.loadTestTransaction.details')->with(compact('transaction'));
    }

    public function create(Request $request)
    {
        $users = User::latest()->get();
        if ($request->isMethod('post')) {

            $currentBalance = Wallet::whereUserId($request->user_id)->first()->balance * 100;

            $for_pre_transaction = [
                'pre_transaction_id' => TransactionIdGenerator::generate(20),
                'user_id' => $request->user_id,
                'amount' => $request['amount'] * 100,
                'description' => "Load Test Fund ",
                'vendor' => 'WALLET',
                'service_type' => 'LOAD TEST FUND',
                'microservice_type' => 'WALLET',
                'transaction_type' => PreTransaction::TRANSACTION_TYPE_CREDIT,
                'url' => '/refund',
                'status' => PreTransaction::STATUS_STARTED,
                'before_balance' => $currentBalance,
                'after_balance' => $currentBalance + ($request['amount'] * 100),
            ];

            $data = [
                'admin_id' => auth()->user()->id,
                'user_id' => $request->user_id,
                'description' => $request['description'],
                'before_amount' => $currentBalance,
                'after_amount' => $currentBalance + ($request['amount'] * 100),
                'self_pre_transaction_id' => $for_pre_transaction['pre_transaction_id'],
            ];

            DB::beginTransaction();
            try {
                $pre_transaction = PreTransaction::create($for_pre_transaction);
                Log::info('started PreTransaction for Load Test Fund',$for_pre_transaction);

                $pre_transaction->update([
                    'status' => PreTransaction::STATUS_SUCCESS
                ]);
                Log::info('pre_transaction Created Successfully');

                $transaction = LoadTestFund::create($data);
                if (! $transaction) return redirect(route('refund.index'))->with('error', 'Transaction not created successfully');
                event(new LoadTestFundEvent($transaction));
                DB::commit();
                return redirect(route('loadTestFund.index'))->with('success', 'Transaction created successfully');
            } catch (\Exception $e) {

                Log::info('pre_transaction Failed');

                Log::info($e);
                DB::rollBack();
                return redirect(route('loadTestFund.index'))->with('error', 'Transaction not created successfully');
            }

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
