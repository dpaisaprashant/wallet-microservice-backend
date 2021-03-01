<?php

namespace App\Http\Controllers;

use App\Models\BackendLog;
use Illuminate\Http\Request;

class BackendLogController extends Controller
{
    public function all(Request $request)
    {
        $length = 10;
        $logs = BackendLog::with('subject', 'causer')->latest()->filter($request)->paginate($length);

        return view('admin.logs.backendLogs.all')->with(compact('logs'));
    }
}
