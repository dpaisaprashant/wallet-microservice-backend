<?php

namespace App\Http\Controllers;

use App\Models\MiracleInfoSMS;
use Illuminate\Http\Request;

class  MiracleInfoSMSController extends Controller
{
    public function index(Request $request)
    {
        if (empty($request->sort)) {
            $messages = MiracleInfoSMS::latest()->filter($request)->paginate(10);
        } else {
            $messages = MiracleInfoSMS::filter($request)->paginate(10);
        }
        $smsCount = MiracleInfoSMS::count();
        return view('admin.miracle_info.ViewMiracleInfoSms')->with(compact('messages','smsCount'));
    }

}
