<?php

namespace App\Wallet\Report\Http\Controllers;

use App\Models\UserRegisteredByUser;

class UserRegisteredByUserController extends \App\Http\Controllers\Controller
{
    public function report(){
        $users_registered_by_users = UserRegisteredByUser::with('user','UserWhoRegistered')->get();
        $total_count = [];
        foreach($users_registered_by_users as $users_registered_by_user){
            $count = UserRegisteredByUser::with('user','UserWhoRegistered')->where('registered_by_id','=',$users_registered_by_user->registered_by_id)->count();
            $total_count[$users_registered_by_user->registered_by_id] = $count;
        }
        return view("WalletReport::userRegisteredUsers.report")->with(compact('users_registered_by_users','total_count'));
    }
}
