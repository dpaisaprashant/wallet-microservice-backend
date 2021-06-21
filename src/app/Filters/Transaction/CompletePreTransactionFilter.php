<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class CompletePreTransactionFilter extends FilterAbstract {


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
        if ($value === null) {
            return $builder;
        }
        return $builder->where('pre_transaction_id', $value);
    }
}
