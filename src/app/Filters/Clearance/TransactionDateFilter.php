<?php

namespace App\Filters\Clearance;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class TransactionDateFilter extends FilterAbstract {


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

        return $builder->whereDate('transaction_date', '=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value))));

    }
}
