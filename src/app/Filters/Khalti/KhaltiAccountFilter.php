<?php

namespace App\Filters\Khalti;

use App\Filters\FilterAbstract;
use App\Models\Microservice\PreTransaction;
use App\Models\Microservice\RequestInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class KhaltiAccountFilter extends FilterAbstract {


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

        return $builder->where('account',  $value);
    }
}
