<?php

namespace App\Wallet\WalletAPI\Http\Controllers\PaypointController;

use App\Wallet\WalletAPI\Microservice\PaypointMicroservice;
use App\Wallet\WalletAPI\Repositories\PaypointApiValidationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wallet\PayPoint\Repository\PayPointRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class PaypointController extends Controller
{
    public function byId(Request $request, $id, PayPointRepository $repo)
    {
        $paypointTransaction = $repo->detailUsingRefStan($id);

        $paypointMicroservice = new PaypointMicroservice();
        $paypointAPI = $paypointMicroservice->getPaypointAPI($request, $id);

        return view('WalletAPI::PaypointAPI/viewWalletAPI', compact('paypointAPI','paypointTransaction'));
    }

    public function compareTransactions(Request $request, PayPointRepository $repo)
    {
        $repository = new PaypointApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions($request, $repo);
        return view('WalletAPI::PaypointAPI/viewWalletAPICompare', compact('disputedTransactions'));

    }

}
