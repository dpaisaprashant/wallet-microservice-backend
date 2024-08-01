<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\BFI\BFIUser;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantBFI;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class BFIMerchantController extends Controller{

    public function index(){
        $merchantBFIs = MerchantBFI::with('merchant','bfiUser')->orderBy('created_at','DESC')->get();
        return view('BFIMerchant::viewBfiMerchant',compact('merchantBFIs'));
    }

    public function create(){
        $bfi = BFIUser::orderBy('created_at','DESC')->get();
        $merchant = Merchant::orderBy('created_at','DESC')->get();
        return view('BFIMerchant::createBfiMerchant',compact('merchant','bfi'));
    }

    public function store(Request $request){
        $bfiAlreadyExists = MerchantBFI::where('bfi_id',$request->get('bfi_id'))->count();
        $merchantIdAlreadyExists = MerchantBFI::where('merchant_id',$request->get('merchant_id'))->count();
        if($merchantIdAlreadyExists > 0){
            return redirect()->route('bfi.view')->with('error','Merchant name already exists');
        }
        if($bfiAlreadyExists > 0){
            return redirect()->route('bfi.view')->with('error','BFI name already exists');
        }
        $status = MerchantBFI::create([
            'merchant_id' => $request->get('merchant_id'),
            'bfi_id' => $request->get('bfi_id')
        ]);

        return redirect()->route('bfi.view')->with('success','BFI Merchant added successfully');
    }

    public function delete($id){
        $bfiMerchant = MerchantBFI::findOrFail($id);
        $status = $bfiMerchant->delete();

        return redirect()->route('bfi.view')->with('success','BFI Merchant deleted successfully');
    }
}
