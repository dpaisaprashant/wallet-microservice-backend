<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\CybersourceSetting;
use App\Models\NchlSetting;
use App\Models\NpaySetting;
use App\Models\PaypointSetting;
use App\Models\Setting;
use App\Wallet\Setting\Traits\UpdateSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use UpdateSetting;

    public function generalSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.generalSetting')->with(compact('settings'));
    }

    public function npaySetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        $settings = $this->updatedSettingsCollection($request, NpaySetting::class);
        return view('admin.setting.npaySetting')->with(compact('settings'));
    }

    public function paypointCommissionSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.paypointCommissionSetting')->with(compact('settings'));
    }

    public function paypointSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request, PaypointSetting::class);
        return view('admin.setting.paypointSetting')->with(compact('settings'));
    }

    public function limitSetting(Request $request)
    {
        //dd($request->all());
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.limitSetting')->with(compact('settings'));
    }

    public function cashBackSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.cashbackSetting')->with(compact('settings'));
    }

    public function transactionFeeSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.transactionFee')->with(compact('settings'));
    }

    public function KYCSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.KYCSetting')->with(compact('settings'));
    }

    public function OTPSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.OTPSetting')->with(compact('settings'));
    }

    public function nchlLoadSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request, NchlSetting::class);
        return view('admin.setting.nchl.loadTransactionSetting')->with(compact('settings'));
    }

    public function nchlBankTransferSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request, Setting::class);
        $settings = $this->updatedSettingsCollection($request, NchlSetting::class);
        return view('admin.setting.nchl.bankTransferSetting')->with(compact('settings'));
    }

    public function nchlAggregatedPaymentSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.nchl.aggregatedPaymentSetting')->with(compact('settings'));
    }

    public function referral(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.referralSetting')->with(compact('settings'));
    }

    public function bonusSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.bonusSetting')->with(compact('settings'));
    }

    public function merchantSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.merchant.merchantSetting')->with(compact('settings'));
    }

    public function nicAsiaCyberSource(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        $settings = $this->updatedSettingsCollection($request, CybersourceSetting::class);
        return view('admin.setting.nicAsiaCyberSourceSetting')->with(compact('settings'));
    }
}
