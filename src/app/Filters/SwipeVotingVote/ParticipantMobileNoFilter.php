<?php

namespace App\Filters\SwipeVotingVote;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ParticipantMobileNoFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        return $builder->whereHas('participant', function ($query) use($value) {
            return $query->where('mobile_no', $value);
        });

    }
}
