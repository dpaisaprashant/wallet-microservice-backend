<?php

namespace App\Wallet\WalletAPI\Http\Controllers;

use App\Events\CreditTransactionCompleteEvent;
use App\Http\Requests\NCHL\NchlProcessLoadRequest;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\Architecture\Builders\WalletTransactionTypeValidationBuilder;
use App\Wallet\Limits\Traits\CheckLimit;
use App\Wallet\WalletAPI\BackendWalletAPIJSONAbstract;
use App\Wallet\WalletAPI\PreTransactionMicroservice;
use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\Microservice\Response\CreditResponse;
use App\Wallet\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class NCHLController extends Controller
{
//    use ApiResponder;

    public function byId(Request $request,$id)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("NCHL_LOAD")
            ->setDescription("Nchl process load transaction")
            ->setVendor("NCHL_LOAD")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/report/by-id")
//            ->setRequestParam($requestParamArr['cipsBatchDetail']);
            ->setRequestParam(['batch_id'=>$id]);
        $response = $microservice->processRequest();
        $nchlAPI= json_decode($response, true);
        return view('WalletAPI::viewWalletAPI',compact('nchlAPI'));

    }




}
