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
        $users = User::with('userLoginHistories')->get();
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
}
