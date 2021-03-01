<?php

namespace App\Filters\UserTransaction;

use App\Filters\FilterAbstract;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class VendorFilter extends FilterAbstract {


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

        return $builder->whereHas('userTransaction', function ($query) use ($value) {
           return $query->where('vendor', $value);
        });

    }
}
