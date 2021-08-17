<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLoginHistory;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class LockedUserController extends Controller
{

    use CollectionPaginate;

    public function index(Request $request)
    {
        $length = 15;
        //$users = User::with('userLoginHistories')->get();
        $users = User::whereHas('userLoginHistories', function ($query) {
            return $query->where("status", 0)->where("created_at", ">", now()->subMinutes(User::LOCK_MINUTES));
        })->get();


        $users = $users->filter(function (User $value){
            if ($value->isLocked())  {
                return $value;
            }
        });

        $users = $this->collectionPaginate($length, $users, $request);

        return view('admin.user.lockedUser.lockedUsersView')->with(compact('users'));
    }

    public function loginAttempts(Request $request, $id)
    {
        $user = User::with('userLoginHistories')->where('id', $id)->firstOrFail();
        $attempts = $user->userLoginHistories()->latest()->paginate(10);

        return view('admin.user.lockedUser.lockedUsersAttempt')->with(compact('user', 'attempts'));
    }

    public function updateLoginAttempts(Request $request)
    {
        UserLoginHistory::where('id', $request->attempt_id)->update(['status' => 1, 'tmp_enabled' => 1]);
        return redirect()->back();
    }

    public function updateLoginAttemptsBulk(Request $request,$id)
    {
//        $user= UserLoginHistory::latest()->take(6)->update(['status' => 1, 'tmp_enabled' => 1]);

        $user= UserLoginHistory::where("created_at", ">", now()->subMinutes(User::LOCK_MINUTES))->update(['status' => 1, 'tmp_enabled' => 1]);

        return redirect()->back();
    }
}
