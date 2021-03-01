<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class TransactionPaymentFilter extends FilterAbstract {


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

        $value = explode(';' , $value);

        //query to handle user with 0 transactions do not show as that row has no relation with userTransactionError
        if ($value[0] == 0 || $value[1] == 0) {

            $usersWithTransaction = TransactionEvent::groupBy('user_id')->pluck('user_id')->all();

            return $builder->where(function ($query) use ($usersWithTransaction, $value){
                $query->whereNotIn('id', $usersWithTransaction)
                    ->orWhereHas('userTransactionEvents', function ($query) use ($value) {
                        $query->groupBy('user_id')->havingRaw('SUM(amount) >= ' .  (float)($value[0] * 100) .' AND SUM(amount) <= '. (float)($value[1] * 100));
                    });
            });
        }

        return $builder->whereHas('userTransactionEvents', function ($query) use ($value) {
            $query->groupBy('user_id')->havingRaw('SUM(amount) >= ' .  (float)($value[0] * 100) .' AND SUM(amount) <= '. (float)($value[1] * 100));
        });

    }
}
