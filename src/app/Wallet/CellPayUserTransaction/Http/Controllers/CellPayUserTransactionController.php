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
    $cellPayUserTransactions = CellPayUserTransaction::with('preTransaction')->filter(request())->latest()->paginate(10);

    return view('CellPayUserTransaction::viewCellPayUserTransactions')->with(compact('cellPayUserTransactions','service_types','vendors',));
}

}
