<?php

namespace App\Filters\UserTransaction;

use App\Filters\FilterAbstract;
use App\Models\UserExecutePayment;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class UserTransactionPreTransactionFilter extends FilterAbstract {


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

        return $builder->where('pre_transaction_id',$value);
    }
}
