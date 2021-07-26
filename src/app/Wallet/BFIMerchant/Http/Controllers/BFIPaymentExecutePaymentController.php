<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\BFI\BFIUser;
use App\Models\BfiExecutePayment;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantBFI;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class BFIPaymentExecutePaymentController extends Controller{

  public function index(){
      $bfiExecutePayments = BfiExecutePayment::with('bfiUser')->orderBy('created_at','DESC')->paginate(15);
      $decoded_response_from_wallet = json_decode($bfiExecutePayments[0]->response_from_wallet,true);
//      dd($decoded_response_from_wallet);
      return view('BFIMerchant::BFIExecutePayment.viewBFIExecutePayment',compact('bfiExecutePayments'));
  }
}
