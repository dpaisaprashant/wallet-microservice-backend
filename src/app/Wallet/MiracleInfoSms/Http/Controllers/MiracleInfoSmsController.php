<?php


namespace App\Wallet\MiracleInfoSms\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MiracleInfoSms\MiracleInfoSMS;
use App\Wallet\MiracleInfoSms\ApiRequest\MiracleSmsBalance;
use Illuminate\Http\Request;

class  MiracleInfoSmsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $miracleInfoBalance = new MiracleSmsBalance();
            $balance = $miracleInfoBalance->processRequest();
        }else{
            $balance = null;
        }
        if (empty($request->sort)) {
            $messages = MiracleInfoSMS::latest()->filter($request)->paginate(10);
        } else {
            $messages = MiracleInfoSMS::filter($request)->paginate(10);
        }
        $smsCount = MiracleInfoSMS::count();
        return view('MiracleInfoSms::viewMiracleInfoSms')->with(compact('messages','smsCount','balance'));
    }

}
