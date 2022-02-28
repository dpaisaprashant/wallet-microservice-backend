<?php


namespace App\Filters\User;


use App\Filters\FilterAbstract;
use App\Models\Merchant\Merchant;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class LockedUsersFilter extends FilterAbstract
{
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
    public function filter(Builder $builder, $value){

        if ($value === null) {
            return $builder;
        }

//        $users = User::whereHas('userLoginHistories', function ($query) {
//            return $query->where("status", 0)->where("created_at", ">", now()->subMinutes(User::LOCK_MINUTES));
//        })->get();
//
//
//        $users = $users->filter(function (User $value){
//            if ($value->isLocked())  {
//                return $value;
//            }
//        });
        return $builder->whereHas('userLoginHistories',function ($query){
           return $query->where("status",0)->where("created_at",">",now()->subMinutes(User::LOCK_MINUTES), function ($query){
               if ($query->isLocked()){
                   return $query;
               }
           });
        });
    }
}
