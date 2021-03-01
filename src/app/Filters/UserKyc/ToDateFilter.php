<?php

namespace App\Filters\UserKyc;

use App\Filters\FilterAbstract;
use App\Models\AdminUserKYC;
use Illuminate\Database\Eloquent\Builder;

class ToDateFilter extends FilterAbstract {


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

        $ids = AdminUserKYC::where('admin_id', auth()->user()->id)->whereDate('updated_at','<=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value))))->pluck('kyc_id');


        return  $builder->whereIn('user_k_y_c_s.id', $ids);

    }
}
