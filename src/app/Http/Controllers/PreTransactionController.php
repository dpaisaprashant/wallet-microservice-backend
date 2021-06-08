<?php

namespace App\Http\Controllers;


use App\Wallet\PreTransaction\Repository\PreTransactionRepository;

class PreTransactionController extends Controller
{
    public function problematicPayment(PreTransactionRepository $repository)
    {
        $transactions = $repository->paginatedProblematicPayments();
        dd($transactions);
    }
}
