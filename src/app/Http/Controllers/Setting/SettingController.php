<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\CybersourceSetting;
use App\Models\NchlSetting;
use App\Models\NpaySetting;
use App\Models\NpsSetting;
use App\Models\PaypointSetting;
use App\Models\Setting;
use App\Wallet\Setting\Traits\UpdateSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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

    public function npsSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        $settings = $this->updatedSettingsCollection($request, NpsSetting::class);
        return view('admin.setting.npsSetting')->with(compact('settings'));
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

    public function notificationSetting(Request $request)
    {
        $settings = $this->updatedSettingsCollection($request);
        return view('admin.setting.notificationSetting')->with(compact('settings'));
    }


    public function redirectSetting(Request $request)
    {

        if (DB::connection('nicasia')->getDatabaseName()) {
            $settings = $this->updatedSettingsCollection($request, CybersourceSetting::class) ?? [];
        }

        if (DB::connection('npay')->getDatabaseName()) {
            $settings = $this->updatedSettingsCollection($request, NpaySetting::class) ?? [];
        }

        if (Schema::connection('nps')) {
            Log::info("connection", [Schema::connection('nps')]);
            $settings = $this->updatedSettingsCollection($request, NpsSetting::class) ?? [];
        }

        if (DB::connection('nchl')->getDatabaseName()) {
            $settings = $this->updatedSettingsCollection($request, NchlSetting::class) ?? [];
        }

        $settings = $this->updatedSettingsCollection($request);

        return view('admin.setting.redirectSetting')->with(compact('settings'));
    }
}
