<?php

namespace App\Http\Controllers;


use App\Wallet\PreTransaction\Repository\PreTransactionRepository;
use App\Traits\CollectionPaginate;
use App\Http\Controllers\Controller;
use App\Models\PreTransaction;
use Illuminate\Http\Request;


class PreTransactionController extends Controller
{
    public function problematicPayment(PreTransactionRepository $repository)
    {
        $transactions = $repository->paginatedProblematicPayments();
        dd($transactions);
    }

    public function index()
    {
        $preTransactions = PreTransaction::paginate(10);
        return view('admin.preTransaction.preTransactionView')->with(compact('preTransactions'));
    }

}
