<?php

namespace App\Wallet\SystemRepost\Http\Controllers;

use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\SystemRepost\Repost\PerformSystemRepost;
use App\Wallet\SystemRepost\Repost\Resolver\BackendSystemRepostResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SystemRefundController extends \App\Http\Controllers\Controller
{
    public function viewSystemRepost(Request $request){
        $transaction_types = TransactionEvent::distinct('transaction_type')->get('transaction_type');
        return view('SystemRepost::system_repost')->with(compact('transaction_types'));
    }

    public function microserviceRepost(Request $request){

        // checking if the entered mobile_no is valid
        $user = User::with('wallet')->where('mobile_no','=',$request->mobile_no)->first();

        if (! $user){
            return back()->with("error","Entered Mobile Number is not Valid");
        }

        $updateBalance = 0;
        $updateTimeStamp = 0;
        if ($request->update_balance){
            $updateBalance = 1;
        }
        if ($request->update_timestamp){
            $updateTimeStamp = 1;
        }

        // checking if pre_transaction_id is valid
        $preTransaction = PreTransaction::with('user')->where('pre_transaction_id','=',$request->pre_transaction_id)->first();
        if (! $preTransaction){
            return back()->with("error",'Invalid Pre Transaction Id Entered');
        }

        // checking if the pre_transaction and user are valid
        if ($user->id != $preTransaction->user_id){
            return back()->with("error","The Pre Transaction Does not Belong to the Entered User");
        }

//        checking if transaction_event for the given pre_transaction_id already exists
//        $transaction_event = TransactionEvent::where('pre_transaction_id','=',$request->pre_transaction_id)->first();
//        if ($transaction_event){
//            return back()->with("error","Transaction Event for the given pre-transaction id already exists");
//        }

        $transactionType = $request->transaction_type;

        Log::info("1. request from frontend for {$transactionType}");

        $resolver = new BackendSystemRepostResolver($preTransaction,$transactionType);
        $systemRepost = $resolver->resolve();
        if ($systemRepost instanceof PerformSystemRepost ) {
            $systemRepost->repost();
        }
    }

}
