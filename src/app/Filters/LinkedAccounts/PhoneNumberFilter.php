<?php

namespace App\Filters\LinkedAccounts;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PhoneNumberFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }
               
        return $builder->where('mobile_number','LIKE', "%{$value}%")->get();
      
    }
}
