<?php

namespace App\Filters\SwipeVotingVote;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ParticipantNameFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        return $builder->whereHas('participant', function ($query) use($value) {
            return $query->where('name', $value);
        });

    }
}
