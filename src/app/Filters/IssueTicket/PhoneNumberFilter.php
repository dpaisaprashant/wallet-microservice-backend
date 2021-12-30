<?php

namespace App\Filters\IssueTicket;

use App\Filters\FilterAbstract;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Models\IssueTicket;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;

class PhoneNumberFilter extends FilterAbstract
{

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

        $user = User::with('issueTicket')->where('mobile_no',$value)->pluck('id');
//        $ticketUser = $user->issueTicket->pluck('user_id');
        return $builder->whereIn('user_id', $user);
    }
}
