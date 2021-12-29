<?php

namespace App\Wallet\TransactionClearance\Clearance\contracts;

interface ClearanceRepositoryContract
{
    public function paginatedTransactions();

    public function transactionsCount();

    public function transactionAmountSum();

    public function transactionFeeSum();
}
