<?php


namespace App\Wallet\TransactionClearance\Clearance\contracts;


interface CompareTransactionForClearance
{
    public function compare(array $excelTransactions);
}
