<?php

namespace App\Filters\UserKyc;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class NumberFilter extends FilterAbstract {


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

        return $builder->whereHas('user', function ($query) use($value) {
            return $query->where('mobile_no', $value);
        });
    }
}
