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
            $total = $request->amount + $request->bonus_amount;


            if ($user->id != $preTransaction->user_id) {
                return redirect()->back()->with('error', "Pre transaction and user doesn't match");
            }

            if ($total != (int)$preTransaction->amount){
                return back()->with('error','Invalid Amount Details Have Been Entered');
            }

            $currentBalance = Wallet::whereUserId($user->id)->first()->balance * 100;
            $currentBonusBalance = Wallet::whereUserId($user->id)->first()->bonus_balance * 100;

            if (empty($request['amount'])) $request['amount'] = 0;
            if (empty($request['bonus_amount'])) $request['bonus_amount'] = 0;

            Log::info("before_balance: " . $currentBalance);
            Log::info("after_balance: " . ($currentBalance + ($request['amount'] * 100)));

            $for_pre_transaction = [
                'pre_transaction_id' => TransactionIdGenerator::generate(20),
                'user_id' => $user->id,
                'amount' => $total * 100,
                'description' => "refund transaction for: ". $preTransaction->pre_transaction_id,
                'vendor' => 'WALLET',
                'service_type' => 'WALLET',
                'microservice_type' => 'WALLET',
                'transaction_type' => 'credit',
                'url' => '/refund',
                'status' => 'STARTED',
                'before_balance' => $currentBalance,
                'after_balance' => $currentBalance + ($request['amount'] * 100),
                'before_bonus_balance' => $currentBonusBalance,
                'after_bonus_balance' => $currentBonusBalance + ($request['bonus_amount'] * 100),
            ];

            $data = [
                'pre_transaction_id' => $preTransaction->pre_transaction_id,
                'admin_id' => auth()->user()->id,
                'user_id' => $user->id,
                'description' => $request['description'],
                'before_amount' => $currentBalance,
                'after_amount' => $currentBalance + ($request['amount'] * 100),
                //'after_amount' => $currentBalance + ($preTransaction->getOriginal('amount')),
                'before_bonus_balance' => $currentBonusBalance,
                'after_bonus_balance' => $currentBonusBalance + ($request['bonus_amount'] * 100),
                'self_pre_transaction_id' => $for_pre_transaction['pre_transaction_id'],
            ];

            DB::beginTransaction();
            try {
                $pre_transaction = PreTransaction::create($for_pre_transaction);
                Log::info('started PreTransaction for Refund Settlement',$for_pre_transaction);
                if ($preTransaction){
                    $pre_transaction->update([
                        'status' => PreTransaction::STATUS_SUCCESS
                    ]);
                    Log::info('pre_transaction Created Successfully');
                }
                $transaction = LoadTestFund::create($data);
                if (! $transaction) return redirect(route('refund.index'))->with('error', 'Transaction not created successfully');

                event(new LoadTestFundEvent($transaction));
                DB::commit();
                return redirect(route('refund.index'))->with('success', 'Transaction created successfully');
            } catch (\Exception $e) {
                if (! $preTransaction){
                    $pre_transaction->update([
                        'status' => 'FAILED'
                    ]);
                    Log::info('pre_transaction Failed');
                }
                Log::info($e);
                DB::rollBack();
                return redirect(route('refund.index'))->with('error', 'Transaction not created successfully');
            }

        }

        return view('admin.refund.create')->with(compact('users'));
    }
}
