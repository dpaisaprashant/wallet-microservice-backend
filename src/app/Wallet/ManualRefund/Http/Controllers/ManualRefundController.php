<?php

namespace App\Wallet\ManualRefund\Http\Controllers;

use App\Models\TransactionEvent;
use Illuminate\Http\Request;

class ManualRefundController extends \App\Http\Controllers\Controller
{
    public function ManualRefund(Request $request){
        $transaction_types = TransactionEvent::distinct('transaction_type')->get('transaction_type');
        return view('ManualRefund::manual_refund')->with(compact('transaction_types'));
    }
}
