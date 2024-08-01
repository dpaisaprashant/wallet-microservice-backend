<?php

namespace App\Filters\RequestInfo;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ServiceTypeFilter extends FilterAbstract {


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


        return $builder->where('service_type', $value);
    }
}
