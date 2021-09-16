<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

abstract class AbstractClearanceCompareStrategy implements CompareTransactionForClearance
{
    abstract public function walletTransactionsWithLinkedId();
    abstract public function clearanceInfo();
    abstract public function transactionName();

    public function compare(array $excelTransactions)
    {
        //0 => linked_id,
        //1 => amount,
        //2 =>fee

        $walletTransactions = $this->walletTransactionsWithLinkedId();


        $comparedTransactions = [];
        $excelTransactionsNotFoundInWallet = [];
        $walletTransactionsNotFoundInExcel = [];
        $unmatchedAmounts = [];
        $unmatchedTransactionFees=[];


        foreach ($excelTransactions as $excelTransaction) {

            //Excel Transaction not found in microservice
            //$microserviceTransaction = UserTransaction::where('refStan', $excelTransaction[0])->first();
            $microserviceTransactionArr = $walletTransactions->filter(function ($walletTransaction) use ($excelTransaction) {
                if (trim(iconv("UTF-8","ISO-8859-1",$excelTransaction[0])," \t\n\r\0\x0B\xA0") == trim(iconv("UTF-8","ISO-8859-1",$walletTransaction->linked_id)," \t\n\r\0\x0B\xA0")) {
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
//            for unmatched Transaction fees
            if (!($excelTransaction[2] == $microserviceTransaction->fee ?? 0)) {
                $unmatchedTransactionFees[$microserviceTransaction->linked_id] = [
                    "excel" => [
                        "linked_id" => $excelTransaction[0],
                        "transaction_fee" => $excelTransaction[2]
                    ],
                    "wallet" => [
                        "linked_id" => $microserviceTransaction->linked_id,
                        "transaction_fee" => $microserviceTransaction->fee ?? 0,
                        "pre_transaction_id" => $microserviceTransaction->pre_transaction_id
                    ]
                ];
            }
// for unmatched Amounts
            if (!($excelTransaction[1] == $microserviceTransaction->getOriginal("amount"))) {
                $unmatchedAmounts[$microserviceTransaction->linked_id] = [
                    "excel" => [
                        "linked_id" => $excelTransaction[0],
                        "amount" => $excelTransaction[1],
                    ],
                    "wallet" => [
                        "linked_id" => $microserviceTransaction->linked_id,
                        "amount" => $microserviceTransaction->getOriginal("amount"),
                        "pre_transaction_id" => $microserviceTransaction->pre_transaction_id
                    ]
                ];
            }
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
            "walletTransactionsNotFoundInExcel" => $walletTransactionsNotFoundInExcel,
            "unmatchedAmounts" => $unmatchedAmounts,
            "unmatchedTransactionFees" => $unmatchedTransactionFees,
        ];
    }
}
