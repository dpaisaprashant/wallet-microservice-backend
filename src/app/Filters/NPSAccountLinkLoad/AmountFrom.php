<?php

namespace App\Filters\NPSAccountLinkLoad;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class AmountFrom extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }
               
        return $builder->whereRaw('CAST(`amount` AS SIGNED) >= ?', [(int)($value)]);
      
    }
}
