<?php

namespace App\Filters\PreTransaction;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class TransactionTypeFilter extends FilterAbstract {


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

        return $builder->whereHas('transactionEvent', fn($query) => $query->where('transaction_type', $value));
    }
}
