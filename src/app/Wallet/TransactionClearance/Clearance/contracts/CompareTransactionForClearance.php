<?php


namespace App\Wallet\TransactionClearance\Clearance\contracts;


interface CompareTransactionForClearance
{
    public function compare(array $excelTransactions);

    public function walletTransactionsWithLinkedId();

    public function clearanceInfo();

    public function transactionName();
}
