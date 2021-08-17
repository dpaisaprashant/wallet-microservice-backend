<?php

namespace App\Wallet\Microservice\Http\Controllers;

use App\Models\User;
use App\Wallet\PreTransaction\Repository\PreTransactionRepository;
use App\Traits\CollectionPaginate;
use App\Http\Controllers\Controller;
use App\Models\Microservice\PreTransaction;
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
//        if (!empty($_GET)){
            $vendors = PreTransaction::groupBy('vendor')->pluck('vendor');
            $service_types = PreTransaction::groupBy('service_type')->pluck('service_type');
            $microservice_types = PreTransaction::groupBy('microservice_type')->pluck('microservice_type');
            $transaction_types = PreTransaction::groupBy('transaction_type')->pluck('transaction_type');
            $preTransactions = PreTransaction::filter(request())->latest()->paginate(10);

            return view('Microservice::preTransactions.preTransactionView')->with(
                compact(
                    'preTransactions',
                    'vendors',
                    'service_types',
                    'microservice_types',
                    'transaction_types',
                )
            );
//        }
//        $preTransactions = PreTransaction::paginate(10);
//        return view('admin.preTransaction.preTransactionView')->with(compact('preTransactions'));
    }

}
