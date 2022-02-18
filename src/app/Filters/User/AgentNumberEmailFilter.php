<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\Agent;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class AgentNumberEmailFilter extends FilterAbstract {


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

        return $builder->where('mobile_no','=',$value)->orWhere('email','=',$value);

    }
}
