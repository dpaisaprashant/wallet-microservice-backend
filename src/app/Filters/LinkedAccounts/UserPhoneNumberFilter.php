<?php

namespace App\Filters\LinkedAccounts;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use App\Models\LinkedAccount;
use App\Models\Microservice\PreTransaction;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserPhoneNumberFilter extends FilterAbstract {

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

        $user = User::with('preTransaction')->where('mobile_no',$value)->first();
        $linkedUser = $user->preTransaction->pluck('user_id');
        return $builder->whereIn('user_id', $linkedUser);
        }

    }
