<?php


namespace App\Wallet\Report\Repositories;


use App\Models\TransactionEvent;
use Symfony\Component\Console\Input\Input;
use App\Traits\CollectionPaginate;

class WalletEndBalanceRepository extends AbstractReportRepository
{
    use CollectionPaginate;

    public function getWalletEndBalance($date){
        if($date != null) {
            $getWalletEndBalance = \DB::connection('dpaisa')->select("SELECT transaction_events.*,mobile_no as number
            FROM(SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at FROM transaction_events
            GROUP BY user_id HAVING created_at <= '$date') AS latest_transaction
                JOIN transaction_events ON transaction_events.created_at = latest_transaction.created_at
                JOIN users ON users.id = transaction_events.user_id
                                  AND transaction_events.id = latest_transaction.id
                                  AND transaction_events.user_id = latest_transaction.user_id");

            return $this->collectionPaginate(50,collect($getWalletEndBalance),request(),'wallet-end-balance');
        }
        return false;
    }

    public function getTotalWalletEndBalanceAmount($date){
        if($date != null) {
            $getWalletEndBalance = \DB::connection('dpaisa')->select("SELECT  transaction_events.*
                FROM(SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
                FROM transaction_events GROUP BY user_id HAVING created_at <= '$date') AS latest_transaction
                JOIN transaction_events
                ON transaction_events.created_at = latest_transaction.created_at
           AND transaction_events.id = latest_transaction.id
           AND transaction_events.user_id = latest_transaction.user_id");

            return collect($getWalletEndBalance);
        }
        return false;
    }

}
