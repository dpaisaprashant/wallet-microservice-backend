<?php

namespace App\Filters\AdminAlteredAgent;

use App\Filters\FilterAbstract;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserKYC;
use Illuminate\Database\Eloquent\Builder;

class AdminActionFilter extends FilterAbstract {


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
        if ($value == "Created"){
            return $builder->whereNull('agent_before');
        }else{
            return $builder->whereNotNull('agent_before');
        }
    }
}
