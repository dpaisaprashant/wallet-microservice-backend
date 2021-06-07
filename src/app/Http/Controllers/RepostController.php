<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepostController extends Controller
{
    public function npay(Request $request)
    {
        $url = config('app.core_url') . '/api/delivery-url';
        return view('admin.repost.npay')->with(compact('url'));
    }

    public function nps(Request $request)
    {
        $url = config('app.core_url') . '/api/nps/delivery-url';
        return view('admin.repost.npay')->with(compact('url'));
    }

    public function connectIPS(Request $request)
    {
        $url = config('app.core_url') . '/api/connect-ips-success';
        return view('admin.repost.npay')->with(compact('url'));
    }
}
