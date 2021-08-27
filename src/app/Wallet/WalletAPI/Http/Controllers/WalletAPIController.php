<?php


namespace App\Wallet\WalletAPI\Http\Controllers;


use App\Http\Requests\PaypointCheckPaymentRequest;
use App\Http\Requests\PaypointExecutePaymentRequest;
use App\Http\Requests\PaypointTransactionRequest;
use App\Wallet\Architecture\Builders\WalletTransactionTypeValidationBuilder;
use App\Wallet\Architecture\Traits\DeductBalanceBeforeRequest;
use App\Wallet\Limits\Traits\CheckLimit;
use App\Wallet\Microservice\Response\DebitResponse;
use App\Wallet\Microservice\Services\PaypointPaymentService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletAPIController extends Controller
{


    public function view()
    {
//        $walletAPI =

//        return view('WalletAPI::viewWalletAPI',compact('walletAPI'));
    }






}
