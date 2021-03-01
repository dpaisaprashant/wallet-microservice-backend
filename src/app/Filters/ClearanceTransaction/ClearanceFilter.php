<?php

namespace App\Filters\ClearanceTransaction;

use App\Filters\FilterAbstract;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class ClearanceFilter extends FilterAbstract {


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

        return $builder->where('clearance_id', $value);
    }
}
