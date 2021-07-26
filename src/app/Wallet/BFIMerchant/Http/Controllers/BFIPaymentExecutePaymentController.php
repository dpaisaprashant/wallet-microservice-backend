<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Models\BfiExecutePayment;


class BFIPaymentExecutePaymentController extends Controller{

  public function index(){
      $bfiExecutePayments = BfiExecutePayment::with('bfiUser')->orderBy('created_at','DESC')->paginate(15);
      $bfiExecutePaymentsTotalCount = BfiExecutePayment::count();
      $bfiExecutePaymentsTotalAmount = BfiExecutePayment::pluck('amount')->sum();
      return view('BFIMerchant::BFIExecutePayment.viewBFIExecutePayment',compact('bfiExecutePayments','bfiExecutePaymentsTotalCount','bfiExecutePaymentsTotalAmount'));
  }
}
