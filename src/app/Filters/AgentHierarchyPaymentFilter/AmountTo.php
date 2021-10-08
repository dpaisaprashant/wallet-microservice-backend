<?php

namespace App\Filters\AgentHierarchyPaymentFilter;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class AmountTo extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        return $builder->where('amount','<=',(float)($value*100));
    }
}
