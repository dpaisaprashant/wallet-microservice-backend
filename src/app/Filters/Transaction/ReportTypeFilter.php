<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReportTypeFilter extends FilterAbstract {


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
        if($value == 'user-only'){
            return $builder
                ->select('transaction_type',DB::raw('SUM(amount/100) as total'),'account_type')
                ->whereHas('user')->where(function ($query){
                   return $query->doesntHave('agent')->orWhereHas('agent',function($query){
                       return $query->where('status','!=',Agent::STATUS_ACCEPTED);
                   });
                })
                ->groupBy('transaction_type','account_type');
        }elseif($value == 'agent'){
            return $builder
                ->select('transaction_type',DB::raw('SUM(amount/100) as total'),'account_type')
                ->whereHas('agent',function ($query){
                    return $query->where('status','=',Agent::STATUS_ACCEPTED);
                })
                ->groupBy('transaction_type','account_type');
        }elseif($value == 'all'){
            return $builder
                ->select('transaction_type',DB::raw('SUM(amount/100) as total'),'account_type')
                ->groupBy('transaction_type','account_type');
        }
    }
}
