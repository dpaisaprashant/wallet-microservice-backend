<?php

namespace App\Filters\UserToBFIFundTransferFilter;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract {

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
        //$value = $this->resolveFilterValue($this->mapping(), $value);
        if ($value === null) {
            return $builder;
        }

        if($value == "SUCCESS"){
            return $builder->where('status' ,'=','SUCCESS');
        }elseif($value == "PROCESSING"){
            return $builder->where('status','=', 'PROCESSING');
        }elseif($value == "ALL"){
            return $builder->where('id','!=',null);
        }

    }
}
