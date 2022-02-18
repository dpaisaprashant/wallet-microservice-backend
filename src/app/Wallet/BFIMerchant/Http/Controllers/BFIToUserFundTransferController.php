<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BfiExecutePayment;
use App\Models\BfiToUserFundTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BFIToUserFundTransferController extends Controller{

    public function index(Request $request){

        $status = BfiToUserFundTransfer::groupBy('status')->pluck('status')->toArray();
        View::share('status', $status);

        $bfiToUserFundTransfers = BfiToUserFundTransfer::with('bfiUser')->filter($request)->orderBy('created_at','DESC')->paginate(15);
        $bfiToUserFundTransferTotalCount = BfiToUserFundTransfer::count();
        $bfiToUserFundTransferTotalSum = BfiToUserFundTransfer::pluck('amount')->sum();
        return view('BFIMerchant::BFIUserFundTransfer.viewBFIUserFundTransfer',compact('bfiToUserFundTransfers','bfiToUserFundTransferTotalCount','bfiToUserFundTransferTotalSum'));
    }

    public function checkPayment($id){
        $bfiToUserFundTransfer = BfiToUserFundTransfer::with('bfiUser')->where('id',$id)->first();
        $userDetails = optional(optional(optional($bfiToUserFundTransfer->bfiUser)->bfiMerchant)->merchant)->user;
        return view('BFIMerchant::BFIUserFundTransfer.detailBFIUserFundTransfer',compact('bfiToUserFundTransfer','userDetails'));
    }
}
