<?php


namespace App\Wallet\WalletRegistration\Http\Controllers;


use App\Models\Merchant\Merchant;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class MerchantRegistrationController extends Controller
{

    public function view()
    {
        $merchants =  Merchant::all();

        return view('WalletRegistration::create-merchant',compact('merchants'));
    }

    public function create(Request $request)
    {
        $formData=$request->all();
        dd($formData['mobile_no']);

//        $blockedIPAlreadyExists = WalletIP::where('ip',$request->get('ip'))->count();
//
//        if($blockedIPAlreadyExists > 0){
//            return redirect()->route('blockedip.view')->with('error','IP already exists in blocked list');
//        }
//
//        $blockedIP = WalletIP::create([
//            'ip' => $request->get('ip'),
//            'description' => $request->get('description'),
//            'blocked_at' => $request->get('blocked_at'),
//            'block_duration' => $request->get('block_duration'),
//            'status' => $request->get('status')
//        ]);

//        return redirect()->route('blockedip.view')->with('success','IP added to block list');

    }


}
