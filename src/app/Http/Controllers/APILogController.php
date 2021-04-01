<?php

namespace App\Http\Controllers;

use App\Models\Log\ErrorLog;
use Illuminate\Http\Request;

class APILogController extends Controller
{
    public function all(Request $request)
    {
        $logs = ErrorLog::filter($request)->latest()->paginate(10);

        return view('admin.logs.apiLogs.all')->with(compact('logs'));

    }
}
