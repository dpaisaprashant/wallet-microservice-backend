<?php

namespace App\Filters\DeviceInfo;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class MobileNoFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        return $builder->whereHas('user', function ($query) use($value) {
            return $query->where('mobile_no', $value);
        });

    }
}
