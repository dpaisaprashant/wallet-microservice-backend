<?php


namespace App\Wallet\NicAsia\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Microservice\PreTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\NicAsia\Repository\NicAsiaCyberSourceRepository;
use Illuminate\Http\Request;

class NICAsiaCyberSourceLoadTransactionController extends Controller{

//NIC ASIA CYBERSOURCE LOAD TRANSACTION
//    public function nicAsiaCyberSourceLoadDetail($id, NicAsiaCyberSourceRepository $repository)
//    {
//        $transaction = $repository->detail($id);
//        return view('admin.transaction.detail.nicAsiaCyberSourceLoadDetail')->with(compact('transaction'));
//    }

//    public function nicAsiaCyberSourceLoad(NicAsiaCyberSourceRepository $repository, Request $request)
//    {
//        if(!empty($_GET)) {
//            $totalNicAisaTransactionCount = $repository->getTotalNicAisaTransactionCount();
//            $totalNicAisaTransactionSum = $repository->getTotalNicAisaTransactionSum();
//            $transactions = $repository->paginatedTransactions();
//            return view('admin.transaction.nicAsiaCyberSourceLoad', compact('transactions', 'totalNicAisaTransactionCount', 'totalNicAisaTransactionSum'));
//        }
//        return view('admin.transaction.nicAsiaCyberSourceLoad');
//    }

public function index(){
    $NicTransactions = NICAsiaCyberSourceLoadTransaction::filter(request())->paginate(10);
    return view('NicAsia::viewNICAsiaCyberSourceLoad')->with(compact('NicTransactions',));
}

}
