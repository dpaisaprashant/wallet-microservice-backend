<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PreTransactionFromDateFilter extends FilterAbstract {


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

        return $builder->whereHas("preTransaction", function ($query) use ($value) {
            return $query->whereDate('created_at', '>=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value))));
        });
    }
}
