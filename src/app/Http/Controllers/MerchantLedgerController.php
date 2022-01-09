<?php

namespace App\Http\Controllers;

use App\Models\User;

class MerchantLedgerController extends Controller
{

    public function index(){
        $merchants = User::with('merchant')->has('merchant')->get();
        return view('admin.merchant-ledger.merchant_ledger_index')->with(compact('merchants'));
    }

}
