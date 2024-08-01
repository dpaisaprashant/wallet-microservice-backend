<?php

namespace App\Filters\IssueTicket;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class IssueDescriptionFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        return $builder->where('issue_description','LIKE', "%{$value}%");
    }
}
