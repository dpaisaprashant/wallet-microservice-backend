<?php

namespace App\Filters\Khalti;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ToAmountKhaltiFilter extends FilterAbstract {


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
        return $builder->whereRaw('CAST(`amount` AS SIGNED) <= ?', [(int)($value)]);
    }
}
