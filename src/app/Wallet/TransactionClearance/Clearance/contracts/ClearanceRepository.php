<?php

namespace App\Wallet\TransactionClearance\Clearance\contracts;

interface ClearanceRepository
{
    public function paginatedTransactions();

    public function transactionsCount();

    public function transactionAmountSum();

    public function transactionFeeSum();
}
