<?php

namespace App\Filters\NicAsia;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Status extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        return $builder->where('status',$value);
    }
}
