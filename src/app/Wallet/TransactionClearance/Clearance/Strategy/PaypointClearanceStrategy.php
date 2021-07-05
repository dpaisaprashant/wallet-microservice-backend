<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class PaypointClearanceStrategy implements CompareTransactionForClearance
{
    const TRANSACTION_TYPE = UserTransaction::class;

    public function transactionName()
    {
        return "paypoint";
    }

    public function compare(array $excelTransactions)
    {
        //0 => linked_id,
        //1 => amount,
        //2 =>fee

        $walletTransactions = TransactionEvent::whereTransactionType(self::TRANSACTION_TYPE)
            ->with('transactionable')
            ->filter(request())
            ->get()
            ->transform(function ($value) {
                $value->linked_id = $value->transactionable->refStan;
                return $value;
            });


        $comparedTransactions = [];
        $excelTransactionsNotFoundInWallet = [];
        $walletTransactionsNotFoundInExcel = [];


        foreach ($excelTransactions as $excelTransaction) {

            //Excel Transaction not found in microservice
            //$microserviceTransaction = UserTransaction::where('refStan', $excelTransaction[0])->first();
            $microserviceTransactionArr = $walletTransactions->filter(function ($walletTransaction) use ($excelTransaction) {
                if ($excelTransaction[0] == $walletTransaction->linked_id) {
                    return $walletTransaction;
                }
            });

            if (count($microserviceTransactionArr) == 0 || empty($microserviceTransactionArr)) {
                $excelTransactionsNotFoundInWallet[$excelTransaction[0]] = [
                    "linked_id" => $excelTransaction[0],
                    "amount" => $excelTransaction[1],
                    "transaction_fee" => $excelTransaction[2]
                ];
                continue;
            }

            //$microserviceTransactionArr length is always 1
            $microserviceTransaction = null;
            foreach ($microserviceTransactionArr as $microserviceTransactionSingle) {
                $microserviceTransaction = $microserviceTransactionSingle;
            }

            if (empty($microserviceTransaction->linked_id)) {
                dd($microserviceTransaction);
            }

            $comparedTransactions[$microserviceTransaction->linked_id] = [
                "excel" => [
                    "linked_id" => $excelTransaction[0],
                    "amount" => $excelTransaction[1],
                    "transaction_fee" => $excelTransaction[2]
                ],
                "wallet" => [
                    "linked_id" => $microserviceTransaction->linked_id,
                    "amount" => $microserviceTransaction->getOriginal("amount"),
                    "transaction_fee" => $microserviceTransaction->fee ?? 0,
                    "pre_transaction_id" => $microserviceTransaction->pre_transaction_id
                ]
            ];
        }

        foreach ($walletTransactions as $transaction) {
            if (! array_key_exists($transaction->linked_id, $comparedTransactions)) {
                $walletTransactionsNotFoundInExcel[$transaction->linked_id] = [
                    "linked_id" => $transaction->linked_id,
                    "amount" => $transaction->getOriginal("amount"),
                    "transaction_fee" => $transaction->fee ?? 0,
                    "pre_transaction_id" => $transaction->pre_transaction_id
                ];
            }
        }

        return [
            "comparedTransactions" => $comparedTransactions,
            "excelTransactionsNotFoundInWallet" => $excelTransactionsNotFoundInWallet,
            "walletTransactionsNotFoundInExcel" => $walletTransactionsNotFoundInExcel
        ];
    }
}
