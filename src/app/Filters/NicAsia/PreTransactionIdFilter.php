<?php

namespace App\Filters\NicAsia;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PreTransactionIdFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        return $builder->where('pre_transaction_id',$value);
    }
}
