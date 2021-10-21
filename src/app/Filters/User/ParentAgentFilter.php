<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\Agent;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
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
        //$value = $this->resolveFilterValue($value);
        if ($value === null) {
            return $builder;
        }

        $parentAgents = User::where('name','like','%'.$value.'%')->pluck('id');
        return $builder->where(function ($query) use ($parentAgents,$value){
            $query->whereHas('agent',function ($query) use ($parentAgents){
                $query->whereIn('code_used_id',$parentAgents);
            });
        });

    }
}
