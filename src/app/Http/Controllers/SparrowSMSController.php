<?php

namespace App\Http\Controllers;

use App\Models\SparrowSMS;
use Illuminate\Http\Request;

class SparrowSMSController extends Controller
{
    public function index(Request $request)
    {
        if (empty($request->sort)) {
            $messages = SparrowSMS::latest()->filter($request)->get();
        } else {
            $messages = SparrowSMS::filter($request)->get();
        }

        return view('admin.sparrow.view')->with(compact('messages'));
    }

    public function detail(Request $request)
    {

        $smsCount = SparrowSMS::count();

        return view('admin.sparrow.detail')->with(compact('smsCount'));
    }
}
