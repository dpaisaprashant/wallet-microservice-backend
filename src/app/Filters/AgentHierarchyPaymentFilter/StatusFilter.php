<?php

namespace App\Filters\AgentHierarchyPaymentFilter;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract
{

    public function mapping()
    {

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
        return $builder->where('status', $value);
    }
}
