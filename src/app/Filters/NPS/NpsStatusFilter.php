<?php

namespace App\Filters\NPS;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class NpsStatusFilter extends FilterAbstract {


    public function mapping()
    {
        return [

        ];
    }

    /**
     * Apply filter.
     *
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value)
    {
        //$value = $this->resolveFilterValue($value);
        if ($value === null) {
            return $builder;
        }
        if($value == 'completed'){
            return $builder->where('status','COMPLETED');
        }elseif($value == 'validated'){
            return $builder->where('status','VALIDATED');
        }else{
            return $builder->where('status','!=',null);
        }

    }
}
