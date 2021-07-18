<?php


namespace App\Wallet\Architecture\Http\Controllers;

use App\Http\Controllers\Controller;

class WalletServiceController extends Controller{

    public function index(){
        return view('Architecture::WalletService.viewWalletService');
    }
}
