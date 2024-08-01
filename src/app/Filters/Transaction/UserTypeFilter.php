<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Builder;

class UserTypeFilter extends FilterAbstract {


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
        if($value == 'user'){

            return $builder->whereHas('user',function ($query){
                return $query->whereHas('userType')->where(function ($query){
                   return $query->doesntHave('agent')->orWhereHas('agent',function($query){
                           return $query->where('status','!=',Agent::STATUS_ACCEPTED);
                   });
                });

            });
        }elseif($value == 'merchant'){
            return $builder->whereHas('user',function ($query){
                return $query->whereHas('merchant');
            });
        }elseif($value == 'agent'){

            return $builder->whereHas('user',function ($query){
                return $query->whereHas('agent',function($query){
                    return $query->where('status','ACCEPTED');
                });
            });
        }elseif($value == 'all'){
            return $builder->where('id','!=',null);
        }
    }
}
