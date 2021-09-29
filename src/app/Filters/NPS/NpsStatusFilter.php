<?php

namespace App\Filters\NPS;

use App\Filters\FilterAbstract;
use App\Models\NpsLoadTransaction;
use App\Models\TransactionEvent;
use Illuminate\Database\Eloquent\Builder;

class NpsStatusFilter extends FilterAbstract {


    public function mapping()
    {
        return [

        ];
    }

    /**
     * Apply filter.
     *
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value)
    {
        //$value = $this->resolveFilterValue($value);
        if ($value === null) {
            return $builder;
        }

        $transactionEventPreTransactionId = TransactionEvent::where('transaction_type',NpsLoadTransaction::class)->pluck('pre_transaction_id');

        if($value == 'complete'){
            return $builder->whereIn('pre_transaction_id',$transactionEventPreTransactionId);
        }elseif($value == 'pending'){
            return $builder->where('status',NpsLoadTransaction::STATUS_PENDING);
        }elseif($value == 'failed') {
            return $builder->where('status',NpsLoadTransaction::STATUS_FAILED);
        }elseif($value == 'incomplete'){
            return $builder->whereNotIn('pre_transaction_id',$transactionEventPreTransactionId)->where('status','!=',NpsLoadTransaction::STATUS_PENDING);
        }elseif($value == 'all'){
            return $builder->where('id','!=',null);
        }

    }
}
