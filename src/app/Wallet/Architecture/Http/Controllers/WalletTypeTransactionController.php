<?php

namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Architecture\WalletTransactionType;
class WalletTypeTransactionController extends Controller{

    public function index(){
        $walletTransactionTypes = WalletTransactionType::orderBy('created_at','DESC')->get();
        return view('Architecture::TransactionType.viewTransactionType',compact('walletTransactionTypes'));
    }

    public function create(){
        return view('Architecture::TransactionType.createTransactionType');
    }

    public function store(Request $request){


        if($request->get('service_enabled') == "Enabled"){
            $service_enabled = 1;
        }else{
            $service_enabled = 0;
        }

        if($request->get('validate_balance') == "True"){
            $validate_balance = 1;
        }else{
            $validate_balance = 0;
        }

        if($request->get('validate_kyc') == "True"){
            $validate_kyc = 1;
        }else{
            $validate_kyc = 0;
        }

        if($request->get('validate_limit') == "True"){
            $validate_limit = 1;
        }else{
            $validate_limit = 0;
        }

        $WalletTypeTransactionCount = WalletTransactionType::where('transaction_type','=',$request->get('transaction_type'))
            ->where('user_type','=',$request->get('user_type'))
            ->where('vendor','=',$request->get('vendor'))
            ->where('transaction_category','=',$request->get('transaction_category'))
            ->where('service_type','=',$request->get('service_type'))
            ->where('service','=',$request->get('service'))
            ->where('service_enabled', '=', $service_enabled)
            ->where('validate_balance', '=', $validate_balance)
            ->where('validate_kyc', '=', $validate_kyc)
            ->where('validate_limit', '=', $validate_limit)
            ->where('limit_type', '=', $request->get('limit_type'))
            ->where('microservice', '=', $request->get('microservice'))
            ->where('payment_type', '=', $request->get('payment_type'))
            ->count();


        if($WalletTypeTransactionCount > 0){
            return redirect()->route('wallet.transaction.type.view')->with('error','Wallet transaction type already exists');
        }



        $walletTransactionType = new WalletTransactionType();
        $walletTransactionType->transaction_type = $request->get('transaction_type');
        $walletTransactionType->user_type = $request->get('user_type');
        $walletTransactionType->vendor = $request->get('vendor');
        $walletTransactionType->transaction_category = $request->get('transaction_category');
        $walletTransactionType->service_type = $request->get('service_type');
        $walletTransactionType->service = $request->get('service');
        $walletTransactionType->service_enabled = $service_enabled;
        $walletTransactionType->validate_balance = $validate_balance;
        $walletTransactionType->validate_kyc = $validate_kyc;
        $walletTransactionType->validate_limit = $validate_limit;
        $walletTransactionType->limit_type = $request->get('limit_type');
        $walletTransactionType->microservice = $request->get('microservice');
        $walletTransactionType->payment_type = $request->get('payment_type');

        $status = $walletTransactionType->save();

        if($status == true){
            return redirect()->route('wallet.transaction.type.view')->with('success', 'Wallet transaction type created successfully');
        }else{
            return redirect()->route('wallet.transaction.type.view')->with('error', 'Something went wrong!Please try again later');
        }


    }

    public function edit($id){
        $singleWalletTransaction = WalletTransactionType::findOrFail($id);
        return view('Architecture::TransactionType.editTransactionType',compact('singleWalletTransaction'));
    }

    public function update(Request $request,$id){
        $singleWalletTransaction = WalletTransactionType::findOrFail($id);
        $singleWalletTransaction->transaction_type = $request->get('transaction_type');
        $singleWalletTransaction->user_type = $request->get('user_type');
        $singleWalletTransaction->vendor = $request->get('vendor');
        $singleWalletTransaction->transaction_category = $request->get('transaction_category');
        $singleWalletTransaction->service_type = $request->get('service_type');
        $singleWalletTransaction->service = $request->get('service');
        $singleWalletTransaction->service_enabled = $request->get('service_enabled');
        $singleWalletTransaction->validate_balance = $request->get('validate_balance');
        $singleWalletTransaction->validate_kyc = $request->get('validate_kyc');
        $singleWalletTransaction->validate_limit = $request->get('validate_limit');
        $singleWalletTransaction->limit_type = $request->get('limit_type');
        $singleWalletTransaction->microservice = $request->get('microservice');
        $singleWalletTransaction->payment_type = $request->get('payment_type');
        $status = $singleWalletTransaction->save();

        if($status == true){
            return redirect()->route('wallet.transaction.type.view')->with('success', 'Wallet transaction type updated successfully');
        }else{
            return redirect()->route('wallet.transaction.type.view')->with('error', 'Something went wrong!Please try again later');
        }
    }

    public function delete($id){
        $singleWalletTransaction = WalletTransactionType::findOrFail($id);
        $status = $singleWalletTransaction->delete();
        if($status == true) {
            return redirect()->route('wallet.transaction.type.view')->with('success', 'Wallet transaction type deleted successfully');
        }else{
            return redirect()->route('wallet.transaction.type.view')->with('error', 'Something went wrong!Please try again later');
        }
    }
}
