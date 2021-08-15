<?php


namespace App\Wallet\WalletApi\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Wallet\WalletApi\RequestMicroService;
use Illuminate\Http\Request;


class WalletApiController extends Controller{

    public function NCHLAPIResponse (Request $request, $id){
        $microservice = new RequestMicroService($request,$id);
        $microservice->setUrl("nginx_nchl/api/microservice/nchl/report/by-id");
        $response = $microservice->processRequest();
//        dd($response);
        return view('WalletApi::APIResponseView',compact('response'));
    }
}
