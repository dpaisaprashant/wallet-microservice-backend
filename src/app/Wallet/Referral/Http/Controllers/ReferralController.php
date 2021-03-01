<?php


namespace App\Wallet\Referral\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\UsedUserReferral;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{

    public function referralReport(Request $request)
    {
        $usedReferrals = UsedUserReferral::filter($request)->latest()->get();
        $user = User::where('mobile_no', $request->referred_from)->orWhere('email', $request->referred_from)->first();

        return view('Referral::report.userReferral')->with(compact('usedReferrals', 'user'));
    }
}
