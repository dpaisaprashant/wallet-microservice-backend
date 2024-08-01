<?php

namespace App\Filters\LinkedAccounts;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class AccountNumberFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }
               
        return $builder->where('account_number','LIKE', "%{$value}%")->get();
      
    }
}
