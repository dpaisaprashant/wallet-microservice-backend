<?php

namespace App\Filters\NPS;

use App\Filters\FilterAbstract;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class NpsUIDFilter extends FilterAbstract {


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
//        dd($builder->first());
        $preTransactionIds = TransactionEvent::where('uid',$value)->pluck('pre_transaction_id');
//        $preTransaction = PreTransaction::where('user_id',$transactionEvents)->pluck('pre_transaction_id');

        return $builder->whereIn('pre_transaction_id',$preTransactionIds);
    }
}
