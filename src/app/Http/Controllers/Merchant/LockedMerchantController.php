<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantLoginHistory;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LockedMerchantController extends Controller
{
    use CollectionPaginate;

    public function index(Request $request)
    {
        $length = 15;
        $merchants = Merchant::with('loginAttempts')->get();
        $merchants = $merchants->filter(function (Merchant $value){
            if ($value->isLocked())  {
                return $value;
            }
        });

        $merchants = $this->collectionPaginate($length, $merchants, $request);

        return view('admin.merchant.lockedMerchant.lockedUsersView')->with(compact('merchants'));
    }

    public function loginAttempts(Request $request, $id)
    {
        $merchant = Merchant::with('loginAttempts')->where('id', $id)->firstOrFail();
        $attempts = $merchant->loginAttempts()->latest()->paginate(10);

        return view('admin.merchant.lockedMerchant.lockedUsersAttempt')->with(compact('merchant', 'attempts'));
    }

    public function updateLoginAttempts(Request $request)
    {
        MerchantLoginHistory::where('id', $request->attempt_id)->update(['status' => 1, 'tmp_enabled' => 1]);
        return redirect()->back();
    }
}
