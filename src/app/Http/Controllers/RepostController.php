<?php

namespace App\Http\Controllers;

use App\Wallet\WalletAPI\Microservice\BfiMicroservice;
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
        return view('admin.repost.nps')->with(compact('url'));
    }

    public function connectIPS(Request $request)
    {
        $url = config('app.core_url') . '/api/connect-ips-success';
        return view('admin.repost.connectIPS')->with(compact('url'));
    }

    public function BFI(Request $request)
    {
        if ($request->isMethod('post')) {
            $microservice = new BfiMicroservice();
            $response=$microservice->dispatchBfiRepost($request);
            return redirect()->back()->with('success', 'BFI Repost Successful');
        }

        $bfiUsers = config('bfi-users');
        return view('admin.repost.bfi')->with(compact('bfiUsers'));
    }
}
