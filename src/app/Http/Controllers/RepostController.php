<?php

namespace App\Http\Controllers;

use App\Wallet\WalletAPI\Microservice\BfiMicroservice;
use App\Wallet\WalletAPI\Microservice\CoreMicroservice;
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
            try{
                $microservice = new BfiMicroservice();
                $response=$microservice->dispatchBfiRepost($request);
                return redirect()->back()->with('success', 'BFI Repost Successful');
            }catch (\Exception $e){
                return redirect()->back()->with('error', 'BFI Repost Failed. Error Details = '.$e->getMessage());
            }
        }

        $bfiUsers = config('bfi-users');
        return view('admin.repost.bfi')->with(compact('bfiUsers'));
    }

    public function khalti(Request $request)
    {
        if ($request->isMethod('post')) {
            try{
                $microservice = new CoreMicroservice();
                $response=$microservice->dispatchKhaltiRepost($request);
                return redirect()->back()->with('success', 'Khalti Repost Successful');
            }catch (\Exception $e){
                return redirect()->back()->with('error', 'BFI Repost Failed. Error Details = '.$e->getMessage());
            }

        }

//        $khaltiUsers = config('khalti-users');
        return view('admin.repost.khalti');
    }
}
