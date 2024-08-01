<?php


namespace App\Wallet\Report\Repositories;

use App\Models\TransactionEvent;
use Symfony\Component\Console\Input\Input;
use App\Traits\CollectionPaginate;

class CommissionReportRepository extends AbstractReportRepository
{
    use CollectionPaginate;

        public function getTransactionTypeId($transaction_type){
            $transaction_type_id = TransactionEvent::where('transaction_type',$transaction_type)->pluck('transaction_id');
            return $transaction_type_id;
        }



}
