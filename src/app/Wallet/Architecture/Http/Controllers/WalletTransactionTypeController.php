<?php


namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Architecture\WalletTransactionType;
use Illuminate\Http\Request;

class WalletTransactionTypeController extends Controller
{
    public function vendorTransactions(Request $request, $vendorName)
    {
        $walletTransactionTypes = WalletTransactionType::where('vendor', $vendorName)->get();
        return view('Architecture::walletTransactionTypes')->with(compact('walletTransactionTypes', 'vendorName'));
    }
}
