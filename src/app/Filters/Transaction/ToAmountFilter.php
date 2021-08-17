<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ToAmountFilter extends FilterAbstract {


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

        //return $builder->where('amount', '<=', (float)($value * 100));
        return $builder->whereRaw('CAST(`amount` AS SIGNED) <= ?', [(int)($value * 100)]);

    }
}
