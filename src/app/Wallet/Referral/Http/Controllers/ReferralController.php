<?php


namespace App\Wallet\Referral\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\UsedUserReferral;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReferralController extends Controller
{

    public function referralReport(Request $request)
    {
        //$usedReferrals = UsedUserReferral::filter($request)->latest()->get();
        $user = User::where('mobile_no', $request->referred_from)->orWhere('email', $request->referred_from)->first();
        $usedReferrals = UsedUserReferral::where('referred_from', $user->id)->filter($request)->latest()->get();

        return view('Referral::report.userReferral')->with(compact('usedReferrals', 'user'));
    }

    public function registerUsingReferralUserReport(Request $request)
    {
        $registerUsingReferralUsers = User::wherehas('referralTo')
            ->with(['kyc', 'wallet', 'referralFrom'])
            ->filter($request)
            ->latest()
            ->paginate(25);

        return view('Referral::report.registerUsingReferralUserReport')->with(compact('registerUsingReferralUsers'));
    }
}
