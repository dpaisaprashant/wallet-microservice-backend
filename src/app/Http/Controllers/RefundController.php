<?php

namespace App\Http\Controllers;

use App\Events\LoadTestFundEvent;
use App\Models\LoadTestFund;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RefundController extends Controller
{
    use CollectionPaginate;

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
        //$users = User::latest()->get();
        $users = [];
        if ($request->isMethod('post')) {

            $user = User::where('mobile_no', $request->mobile_no)->firstOrFail();
            $preTransaction = PreTransaction::where('pre_transaction_id', $request->pre_transaction_id)->firstOrfail();

            if ($user->id != $preTransaction->user_id) {
                return redirect()->back()->with('error', "Pre transaction and user doesn't match");
            }

            $currentBalance = Wallet::whereUserId($user->id)->first()->balance * 100;
            $currentBonusBalance = Wallet::whereUserId($user->id)->first()->bonus_balance * 100;

            if (empty($request['amount'])) $request['amount'] = 0;
            if (empty($request['bonus_amount'])) $request['bonus_amount'] = 0;

            if ($request['amount'] < 0 || $request['bonus_amount'] < 0 ) {
                return  redirect()->back()->with("error", "Amount cannot be less than 0");
            }

            if($preTransaction->amount != ($request['amount'] + $request['bonus_amount'])) {
                return  redirect()->back()->with("error", "Refunded amount and pre transaction amount do not match");
            }

            Log::info("before_balance: " . $currentBalance);
            Log::info("after_balance: " . ($currentBalance + ($request['amount'] * 100)));

            $data = [
                'pre_transaction_id' => $preTransaction->pre_transaction_id,
                'admin_id' => auth()->user()->id,
                'user_id' => $user->id,
                'description' => $request['description'],
                'before_amount' => $currentBalance,
                'after_amount' => $currentBalance + ($request['amount'] * 100),
                //'after_amount' => $currentBalance + ($preTransaction->getOriginal('amount')),
                'before_bonus_balance' => $currentBonusBalance,
                'after_bonus_balance' => $currentBonusBalance + ($request['bonus_amount'] * 100)
            ];

            DB::beginTransaction();
            try {
                $transaction = LoadTestFund::create($data);
                if (! $transaction) return redirect(route('refund.index'))->with('error', 'Transaction not created successfully');

                event(new LoadTestFundEvent($transaction));
                DB::commit();
                return redirect(route('refund.index'))->with('success', 'Transaction created successfully');
            } catch (\Exception $e) {
                Log::info($e);
                DB::rollBack();
                return redirect(route('refund.index'))->with('error', 'Transaction not created successfully');
            }

        }

        return view('admin.refund.create')->with(compact('users'));
    }


    //Server Error Refund
    public function serverErrorToRefund()
    {
        $disputedPreTransactions = PreTransaction::with("user")
            ->where("json_response", "like", "%Server error:%")
            ->where("microservice_type", "PAYPOINT")
            ->whereDate("created_at", "!=", "2021-09-17")
            ->whereNotIn("pre_transaction_id", function ($query) {
                $query->from("load_test_funds")
                    ->select("pre_transaction_id")
                    ->whereNotNull("pre_transaction_id");
            })->latest()->paginate(25);

        return view('admin.refund.serverError.toRefund')->with(compact('disputedPreTransactions'));
    }
}
