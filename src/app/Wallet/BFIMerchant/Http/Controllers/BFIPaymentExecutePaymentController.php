<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Models\BfiExecutePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class BFIPaymentExecutePaymentController extends Controller{

  public function index(Request $request){
      $status = BfiExecutePayment::groupBy('status')->pluck('status')->toArray();
      View::share('status', $status);

      $bfiExecutePayments = BfiExecutePayment::with('bfiUser')->orderBy('created_at','DESC')->filter($request)->paginate(15);
      $bfiExecutePaymentsTotalCount = BfiExecutePayment::count();
      $bfiExecutePaymentsTotalAmount = BfiExecutePayment::pluck('amount')->sum();
      return view('BFIMerchant::BFIExecutePayment.viewBFIExecutePayment',compact('bfiExecutePayments','bfiExecutePaymentsTotalCount','bfiExecutePaymentsTotalAmount'));
  }
}
