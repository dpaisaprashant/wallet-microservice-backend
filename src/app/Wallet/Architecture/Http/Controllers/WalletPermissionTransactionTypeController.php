<?php

namespace App\Wallet\Architecture\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Merchant\MerchantType;
use App\Models\Permission\UserTypeWalletTransactionTypePermission;
use App\Models\UserType;
use Illuminate\Http\Request;

class WalletPermissionTransactionTypeController extends Controller{

    public function index(){
        $userTypes = UserType::orderBy('created_at','DESC')->get();
        $merchantTypes = MerchantType::orderBy('created_at','DESC')->get();
        $agentTypes = AgentType::orderBy('created_at','DESC')->get();
        $walletPermissionTransactions = UserTypeWalletTransactionTypePermission::orderBy('created_at','DESC')->get();
        $transactionTypes = WalletTransactionType::orderBy('created_at','DESC')->get();
        return view('Architecture::WalletPermissionTransaction.viewWalletPermissionTransaction',compact('walletPermissionTransactions','userTypes','merchantTypes','agentTypes','transactionTypes'));
    }

    public function create(Request $request){
        $userTypes = [];
        $user = $request->user();
        if ($user->hasAnyPermission('Add cashback to user type')) {
            $userTypes["User Type"] = UserType::class;
        }

        if ($user->hasAnyPermission('Add cashback to merchant type')) {
            $userTypes["Merchant Type"] = MerchantType::class;
        }

        if($user->hasAnyPermission('Add cashback to agent type')){
            $userTypes['Agent Type'] = AgentType::class;
        }

        $walletTransactionTypes = WalletTransactionType::orderBy('created_at','DESC')->get();
        return view('Architecture::WalletPermissionTransaction.createWalletPermissionTransaction',compact('userTypes','walletTransactionTypes'));
    }

    public function store(Request $request){
        $walletPermission = new UserTypeWalletTransactionTypePermission();
        $walletPermission->user_type_id = $request->get('user_type_id');
        $walletPermission->user_type = $request->get('user_type');
        $walletPermission->wallet_transaction_type_id = $request->get('wallet_transaction_type_id');

        $userTypeWalletTransactionTypePermissionCount = UserTypeWalletTransactionTypePermission::
            where('user_type_id', '=', $request->get('user_type_id'))
            ->where('user_type','=',$request->get('user_type'))
            ->where('wallet_transaction_type_id','=',$request->get('wallet_transaction_type_id'))
            ->count();



        if($userTypeWalletTransactionTypePermissionCount ){
            return redirect()->route('wallet.permission.transaction.type.view')->with('error','User type wallet transaction type permission already exists');
        }
        $status = $walletPermission->save();
        if($status == true){
            return redirect()->route('wallet.permission.transaction.type.view')->with('success','Wallet permission transaction added successfully');
        }else{
            return redirect()->route('wallet.permission.transaction.type.view')->with('error','Something went wrong!Please try again later');
        }
    }

    public function delete($id){
        $walletPermissionTransactionType = UserTypeWalletTransactionTypePermission::findOrFail($id);
        $status = $walletPermissionTransactionType->delete();
        if($status == true){
            return redirect()->route('wallet.permission.transaction.type.view')->with('success','Wallet permission transaction deleted successfully');
        }else{
            return redirect()->route('wallet.permission.transaction.type.view')->with('error','Something went wrong!Please try again later');
        }
    }

}
