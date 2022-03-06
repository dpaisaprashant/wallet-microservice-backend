<?php

namespace App\Http\Controllers;

use App\Models\MagnusCooperativeTransaction;
use App\Models\MagnusDeposit;
use App\Models\MagnusWithdraw;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use Illuminate\Http\Request;


class MerchantLedgerController extends Controller
{

    public function index(Request $request){
        $merchants = User::with('merchant')->has('merchant')->where('mobile_no','=','9813103122')->get();
            $ledgers = TransactionEvent::where('user_id','=',$request->merchant)->whereIn('transaction_type',[MagnusDeposit::class,MagnusWithdraw::class])->with('uniquePreTransaction','user')->filter($request)->latest()->paginate(10);

            $ledgers->transform(function ($value) {
               $otherTransactionEventForMagnusTransaction = TransactionEvent::whereIn("transaction_type", [MagnusDeposit::class,MagnusWithdraw::class])
                   ->where("transaction_id", $value->transaction_id)
                   ->where("pre_transaction_id","!=", $value->pre_transaction_id)
                   ->with("user")
                   ->first();

               if ($otherTransactionEventForMagnusTransaction) {
                   $value->account_mobile_no = $otherTransactionEventForMagnusTransaction->user->mobile_no;
                   $value->account_id = $otherTransactionEventForMagnusTransaction->user_id;
               }

               $json_response = $value->uniquePreTransaction->json_response;
               $json_response = json_decode($json_response,true);
               $tx_id = $json_response['trxnId'];
               $value->tx_id = $tx_id;
               return $value;
            });

            return view('admin.merchant-ledger.merchant_ledger_index')->with(compact('merchants','ledgers'));
    }

    public function detail($id){
        $transaction = TransactionEvent::where('id','=',$id)->with('preTransaction','uniquePreTransaction','user')->first();
        $user = $otherTransactionEventForMagnusTransaction = TransactionEvent::whereIn("transaction_type", [MagnusDeposit::class,MagnusWithdraw::class])
            ->where("transaction_id", $transaction->transaction_id)
            ->where("pre_transaction_id","!=", $transaction->pre_transaction_id)
            ->with("user")
            ->first();
        $user_mobile = $user->user->mobile_no;
        $merchant_name = $transaction->user->name;
        $pre_transaction = $transaction->uniquePreTransaction;
        $json_request = json_decode($pre_transaction->json_request,true);
        $json_response = json_decode($pre_transaction->json_response, true);
        return view('admin.merchant-ledger.detail')->with(compact('pre_transaction','json_request','json_response','merchant_name','user_mobile','transaction'));
    }

}
