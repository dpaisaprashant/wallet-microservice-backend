<?php

namespace App\Http\Controllers\Setting;

use App\Models\NchlAggregatedPaymentAppId;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NchlAggregatedPaymentIdSettingController extends Controller
{
    public function index()
    {
        $settings = NchlAggregatedPaymentAppId::orderBy('service_id')->get();
        return view('admin.setting.nchl.aggregatedService.appIdList')->with(compact('settings'));
    }

    public function create(Request $request)
    {
        NchlAggregatedPaymentAppId::updateOrCreate(
            ['app_id' => $request->app_id],
            [
                'service_name' => $request->service_name,
                'service_id' => $request->service_id,
                'app_group_id' => $request->app_group_id,
                'app_name' => $request->app_name
            ]
        );

        return redirect()->route('settings.nchl.aggregatedService.list')->with('success', 'App Id created successfully');
    }

    public function delete()
    {

    }
}
