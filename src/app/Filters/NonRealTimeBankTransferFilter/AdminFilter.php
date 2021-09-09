<?php

namespace App\Filters\NonRealTimeBankTransferFilter;

use App\Filters\FilterAbstract;
use App\Models\AdminNonRealTimeBankTransfer;
use App\Models\NonRealTimeBankTransfer;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Admin;

class AdminFilter extends FilterAbstract {


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

        if($value == 'all'){
            return $builder->where('id','!=',null);
        }

        $adminId = Admin::where('name',$value)->pluck('id')->first();

        $transactionIds = AdminNonRealTimeBankTransfer::where('user_id',$adminId)->pluck('transaction_id');
        return $builder->whereIn('transaction_id',$transactionIds);
    }
}
