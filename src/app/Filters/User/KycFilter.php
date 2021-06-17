<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\UserKYC;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class KycFilter extends FilterAbstract {

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
        }else if($value == 'verified'){
            $userIds = UserKYC::where(function ($query) use ($value) {
                $query->where('accept', 1);
            })->pluck('user_id');
            return $builder->whereIn('id' ,$userIds);
        }else if($value == 'unverified'){
            $userIds = UserKYC::where(function ($query) use ($value) {
                $query->where('accept', 0);
            })->pluck('user_id');
            return $builder->whereIn('id' ,$userIds);
        }else if($value == 'pending'){
            $userIds = UserKYC::where(function ($query) use ($value) {
                $query->where('accept',null);
            })->pluck('user_id');
            return $builder->whereIn('id' ,$userIds);
        }else if($value == 'all'){
            $userIds = UserKYC::pluck('user_id');
            return $builder->whereIn('id',$userIds);
        }


        return $builder->whereDate('created_at', '>=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value))));
    }
}
