<?php

namespace App\Wallet\ManualRefund\Http\Controllers;

use App\Models\TransactionEvent;
use Illuminate\Http\Request;

class ManualRefundController extends \App\Http\Controllers\Controller
{
    public function ViewManualRefund(Request $request){
        $transaction_types = TransactionEvent::distinct('transaction_type')->get('transaction_type');
        return view('ManualRefund::manual_refund')->with(compact('transaction_types'));
    }

    public function CreateManualRefund(Request $request){
//        todo: number 1
        // based on the transaction type, check in the database of that microservice if
        // the pre_transaction_id exists in the  transactions table of the microservice's database
//        if the pre_transaction_id is not present in the relevant microservice's database, then redirect back to the refund page with an error
        // todo: number 2
//        if the pre_transaction exists, then, check in the core wallet: transaction_events table if the transaction_event exists?
//        if the transaction_events exists, then redirect back with error.
// todo: number 3
   // if the transaction-event does not exist, then,
        // check in the respective microservice's database if the transactio status is success or not
        // if the status is not success in the respective microservice, then redirect with error
//        todo: number 4
        //if the status in the respective microservice is success, then, it can be inserted into manual_refund table.
        // if the status in the respective microservice is success, then create a transaction-event with the relevant information.
// todo: number 5
        //update the balance if the checkbox for it has been marked
        //  update the timestamp if the checkbox for it has been marked

    }

}
