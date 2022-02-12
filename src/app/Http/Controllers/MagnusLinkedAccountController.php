<?php

namespace App\Http\Controllers;

use App\Models\MagnusLinkedAccount;

class MagnusLinkedAccountController extends Controller
{
    public function index(){
//                    $preTransactions = PreTransaction::filter(request())->latest()->paginate(10);
        $linked_accounts = MagnusLinkedAccount::filter(request())->with('user')->paginate(10);
        return view('admin.magnusLinkedAccount.magnus_linked_accounts_index')->with(compact('linked_accounts'));
    }
}
