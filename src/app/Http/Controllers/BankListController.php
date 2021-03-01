<?php

namespace App\Http\Controllers;


class BankListController extends Controller
{
    public function bankList()
    {
        return view('admin.bankList.view');
    }

    public function profile()
    {
        return view('admin.bankList.profile');
    }
}
