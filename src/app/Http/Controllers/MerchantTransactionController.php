<?php

namespace App\Http\Controllers;

use App\Models\MerchantTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class MerchantTransactionController extends Controller
{
    public function index(){
        $transactions = MerchantTransaction::filter(request())->with('transactions','user','merchant')->paginate(10);
        return view('admin.merchantTransaction.merchantTransactionIndex')->with(compact('transactions'));
    }

    public function detail($id){
        $transaction = MerchantTransaction::where('id',$id)->with('transactions','user','merchant')->first();
        return view('admin.merchantTransaction.merchantTransactionDetail')->with(compact('transaction'));
    }
}
