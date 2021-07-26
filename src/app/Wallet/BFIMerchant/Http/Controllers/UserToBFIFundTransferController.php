<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserToBfiFundTransfer;


class UserToBFIFundTransferController extends Controller{

    public function index(){
        $userToBfiFundTransfers = UserToBfiFundTransfer::with('bfiUser')->orderBy('created_at','DESC')->paginate(15);
        $userToBfiFundTransferTotalCount = UserToBfiFundTransfer::count();
        $userToBfiFundTransferTotalAmount = UserToBfiFundTransfer::pluck('amount')->sum();
        return view('BFIMerchant::UserToBFIFundTransfer.viewUserToBFIFundTransfer',compact('userToBfiFundTransfers','userToBfiFundTransferTotalCount','userToBfiFundTransferTotalAmount'));
    }
}
