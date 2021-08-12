<?php


namespace App\Wallet\WalletBackendAPI\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\BFI\BFIUser;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantBFI;
use App\Traits\CollectionPaginate;
use App\Wallet\WalletBackendAPI\Microservices\RequestMicroService;
use Illuminate\Http\Request;

class WalletBackendAPIController extends Controller{

    public function byId(Request $request,$id){
        $microservice = new RequestMicroService($request,$id);
        $microservice
            ->setUrl("nginx_nchl/api/microservice/nchl/report/by-id");
        $response = $microservice->processRequest();

        return view('admin.transaction.nchlBankTransfer.apiResponse',compact('response'));
    }

}
