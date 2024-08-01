<?php

namespace App\Filters\SwipeVotingVote;

use App\Filters\FilterAbstract;
use App\Models\BfiExecutePayment;
use Illuminate\Database\Eloquent\Builder;

class EventCodeFilter extends FilterAbstract
{


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

        return $builder->whereHas('participant', function ($query) use ($value){
            return $query->where('event_code',$value);
        });
    }


}
