<?php


namespace App\Wallet\CellPayUserTransaction\Http\Controllers;

use App\Models\CellPayUserTransaction;
use App\Http\Controllers\Controller;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class CellPayUserTransactionController extends Controller{

public function index(){
    $service_types = CellPayUserTransaction::groupBy('service_type')->pluck('service_type');
    $vendors = CellPayUserTransaction::groupBy('vendor')->pluck('vendor');
    $cellPayUserTransactions = CellPayUserTransaction::filter(request())->paginate(10);
    $usersUnique = User::has('preTransaction')->groupBy('mobile_no')->select('id','mobile_no')->get();
    $users =  User::select('id','mobile_no')->get();
    $preTransactions = PreTransaction::select('user_id','pre_transaction_id')->get();
    return view('CellPayUserTransaction::viewCellPayUserTransactions')->with(compact('cellPayUserTransactions','service_types','vendors','users','preTransactions','usersUnique',));
}

}
