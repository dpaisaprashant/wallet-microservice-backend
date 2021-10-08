<?php

namespace App\Filters\AgentHierarchyPaymentFilter;

use App\Filters\FilterAbstract;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class ParentAgentFilter extends FilterAbstract {


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

        return $builder->with('parentAgent')->whereHas('parentAgent', function ($query) use ($value) {
            return $query->where('name', 'LIKE', "%{$value}%");
        });
    }
}
