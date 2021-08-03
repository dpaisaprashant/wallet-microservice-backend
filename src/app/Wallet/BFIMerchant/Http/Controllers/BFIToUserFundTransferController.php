<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BfiExecutePayment;
use App\Models\BfiToUserFundTransfer;

class BFIToUserFundTransferController extends Controller{

    public function index(){
        $bfiToUserFundTransfers = BfiToUserFundTransfer::with('bfiUser')->orderBy('created_at','DESC')->paginate(15);
        $bfiToUserFundTransferTotalCount = BfiToUserFundTransfer::count();
        $bfiToUserFundTransferTotalSum = BfiToUserFundTransfer::pluck('amount')->sum();
        return view('BFIMerchant::BFIUserFundTransfer.viewBFIUserFundTransfer',compact('bfiToUserFundTransfers','bfiToUserFundTransferTotalCount','bfiToUserFundTransferTotalSum'));
    }

    public function checkPayment($id){
        $bfiToUserFundTransfer = BfiToUserFundTransfer::where('id',$id)->first();
        return view('BFIMerchant::BFIUserFundTransfer.detailBFIUserFundTransfer',compact('bfiToUserFundTransfer'));
    }
}
