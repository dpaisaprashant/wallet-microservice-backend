<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BFI\BFIUser;
use App\Models\Merchant\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserToBfiFundTransfer;


class UserToBFIFundTransferController extends Controller{

    public function index(Request $request){
        $userToBfiFundTransfers = UserToBfiFundTransfer::filter(request())->with('bfiUser')->orderBy('created_at','DESC')->paginate(15);
        $userToBfiFundTransferTotalCount = UserToBfiFundTransfer::count();
        $userToBfiFundTransferTotalAmount = UserToBfiFundTransfer::pluck('amount')->sum();
        return view('BFIMerchant::UserToBFIFundTransfer.viewUserToBFIFundTransfer',compact('userToBfiFundTransfers','userToBfiFundTransferTotalCount','userToBfiFundTransferTotalAmount'));
    }

    public function checkPayment($id){
        $userToBfiFundTransferCheckPaymentDetails = UserToBfiFundTransfer::with('bfiCheckPayment','bfiUser')->findOrFail($id);
//        $userId = $userToBfiFundTransferCheckPaymentDetails->user_id;
//        $userToBfiMerchant = BFIUser::with('bfiMerchant')->findOrFail($userId);
//        $merchantId = $userToBfiMerchant->bfiMerchant->merchant_id;
//        $merchantDetails = Merchant::find($merchantId);
//        $userDetails = User::where('id',$merchantDetails->user_id)->first();

        $walletUser = $userToBfiFundTransferCheckPaymentDetails->user()->first();
        $userDetails = optional(optional(optional($userToBfiFundTransferCheckPaymentDetails->bfiUser)->bfiMerchant)->merchant)->user;


        return view('BFIMerchant::UserToBFIFundTransfer.detailsUserToBFIFundTransfer',compact('userToBfiFundTransferCheckPaymentDetails','userDetails'));
    }
}
