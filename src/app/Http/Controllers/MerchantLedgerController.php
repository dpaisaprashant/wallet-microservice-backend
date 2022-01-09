<?php

namespace App\Http\Controllers;

use App\Models\MagnusCooperativeTransaction;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use Illuminate\Http\Request;


class MerchantLedgerController extends Controller
{

    public function index(Request $request){
        $merchants = User::with('merchant')->has('merchant')->where('mobile_no','=','9813103122')->get();
            $ledgers = TransactionEvent::where('user_id','=',$request->merchant)->where('transaction_type','=',MagnusCooperativeTransaction::class)->with('uniquePreTransaction','user')->filter($request)->latest()->paginate(10);

            $ledgers->transform(function ($value) {
               $otherTransactionEventFotMagnusTransaction = TransactionEvent::where("transaction_type", MagnusCooperativeTransaction::class)
                   ->where("transaction_id", $value->transaction_id)
                   ->where("pre_transaction_id","!=", $value->pre_transaction_id)
                   ->with("user")
                   ->first();

               if ($otherTransactionEventFotMagnusTransaction) {
                   $value->account_mobile_no = $otherTransactionEventFotMagnusTransaction->user->mobile_no;
                   $value->account_id = $otherTransactionEventFotMagnusTransaction->user_id;
               }

               return $value;
            });

            return view('admin.merchant-ledger.merchant_ledger_index')->with(compact('merchants','ledgers'));
    }

}
