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

//        dd($builder->get());
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
        }else if($value == 'notfilled'){
            $data = $builder->doesntHave('kyc');
            return $data;
            /*return $builder->leftJoin("user_k_y_c_s", "user_k_y_c_s.user_id", "=", "users.id")
                ->whereNull("user_k_y_c_s.id");*/

        }
        else if($value == 'all'){
            $userIds = UserKYC::pluck('user_id');
            return $builder->whereIn('id',$userIds);
        }


    }
}
