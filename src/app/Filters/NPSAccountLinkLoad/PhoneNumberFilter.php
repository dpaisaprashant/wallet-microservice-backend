<?php

namespace App\Filters\NPSAccountLinkLoad;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use App\Models\NPSAccountLinkLoad;
use App\Models\Microservice\PreTransaction;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PhoneNumberFilter extends FilterAbstract {

    use BelongsToUser;


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


//            $user= User::has('preTransaction')->where('mobile_no',$value)->pluck('id');
//
//            $preTransactions = PreTransaction::where('user_id',$user)->pluck('pre_transaction_id');
//
//            return $builder->whereIn('reference_id', $preTransactions);

        $user = User::with('preTransaction')->where('mobile_no',$value)->first();
        $preTransactionList = $user->preTransaction->pluck('pre_transaction_id');
        return $builder->whereIn('reference_id', $preTransactionList);
        }

    }
