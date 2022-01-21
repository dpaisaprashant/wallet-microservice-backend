<?php

namespace App\Http\Controllers;

use App\Models\FundWithdraw;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\CreateSelfPreTransactionForLoadTestFund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FundWithdrawController extends Controller
{
    use CreateSelfPreTransactionForLoadTestFund;
    public function index(){
        $withdrawn_funds = FundWithdraw::paginate(10);
        return view('admin.FundWithdraw.index_fund_withdraws')->with(compact('withdrawn_funds'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $withdrawnFund = FundWithdraw::where('withdraw_pre_transaction_id','=',$request->withdraw_pre_transaction_id)->count();
            if ($withdrawnFund > 0){
                return back()->with('error','The Fund Has Already Been Created For This Transaction');
            }else{
                $withdrawn_pre_transaction = PreTransaction::where('pre_transaction_id','=',$request->withdraw_pre_transaction_id)->first();

                if (empty($request['amount'])) $request['amount'] = 0;
                if (empty($request['bonus_amount'])) $request['bonus_amount'] = 0;

                $amount = (int)$withdrawn_pre_transaction->amount;
                $total = $request->amount + $request->bonus_amount;



                if ($total != $amount){
                    return back()->with('error','The Amount Entered is invalid');
                }else{
                    $user = User::where('id','=',$withdrawn_pre_transaction->user_id)->first();
                    $currentBalance = Wallet::whereUserId($user->id)->first()->balance * 100;
                    $currentBonusBalance = Wallet::whereUserId($user->id)->first()->bonus_balance * 100;
                    $description = "Fund Withdrawn For: ". $withdrawn_pre_transaction->pre_transaction_id;
                    $service_type = "FUND WITHDRAW";
                    $for_pre_transaction = $this->createPreTransaction($request,$service_type,$description,$currentBalance,$currentBonusBalance,$withdrawn_pre_transaction,$total,$user);

                    $data = [
                          'pre_transaction_id' => $for_pre_transaction['pre_transaction_id'],
                          'withdraw_pre_transaction_id' => $request->withdraw_pre_transaction_id,
                          'transaction_event_id' => $withdrawn_pre_transaction->transactionEvent->id ?? null,
                          'before_balance' => $currentBalance,
                          'after_balance' => $currentBalance + ($request['amount'] * 100),
                          'before_bonus_balance' => $currentBonusBalance,
                          'after_bonus_balance' => $currentBonusBalance + ($request['bonus_amount'] * 100),
                          'description' => $description,
                    ];
                    DB::beginTransaction();
                    try {
                        $pre_transaction = PreTransaction::create($for_pre_transaction);
                        Log::info('started PreTransaction for Fund Withdraw',$for_pre_transaction);

                        $pre_transaction->update([
                            'status' => PreTransaction::STATUS_SUCCESS
                        ]);
                        Log::info('pre_transaction Created Successfully');

                        $transaction = FundWithdraw::create($data);
                        if (! $transaction) return redirect(route('refund.index'))->with('error', 'Transaction not created successfully');

//                                    event(new LoadTestFundEvent($transaction));
                        DB::commit();
                        return redirect(route('refund.index'))->with('success', 'Transaction created successfully');
                    } catch (\Exception $e) {
                        $pre_transaction->update([
                            'status' => PreTransaction::STATUS_FAILED
                        ]);
                        Log::info('pre_transaction Failed');
                        Log::info($e);
                        DB::rollBack();
                        return redirect(route('refund.index'))->with('error', 'Transaction not created successfully');
                    }
                }
            }
        }
        return view('admin.FundWithdraw.create_fund_withdraw');
    }
}
