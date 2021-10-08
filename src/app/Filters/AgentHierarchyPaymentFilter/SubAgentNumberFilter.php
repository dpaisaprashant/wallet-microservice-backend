<?php

namespace App\Filters\AgentHierarchyPaymentFilter;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class SubAgentNumberFilter extends FilterAbstract {


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

        return $builder->with('subAgent')->whereHas('subAgent', function ($query) use ($value) {
            return $query->where('mobile_no', $value);
        });
    }
}
