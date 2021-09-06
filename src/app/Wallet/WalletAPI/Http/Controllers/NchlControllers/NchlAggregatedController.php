<?php

namespace App\Wallet\WalletAPI\Http\Controllers\NchlControllers;

use App\Wallet\NCHL\Repository\NchlAggregatedPaymentRepository;
use App\Wallet\WalletAPI\Microservice\NchlAggregatedMicroservice;
use App\Wallet\WalletAPI\Repositories\NchlAggregatedApiValidationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class NchlAggregatedController extends Controller
{
    public function byId(Request $request, $id)
    {
        $nchlAggregatedMicroservice = new NchlAggregatedMicroservice();
        $nchlAggregatedAPI = $nchlAggregatedMicroservice->getNchlAggregatedAPI($request, $id);

        return view('WalletAPI::NchlAggregatedTransfer/viewWalletAPI', compact('nchlAggregatedAPI'));
    }

    public function compareTransactions(Request $request, NchlAggregatedPaymentRepository $repo)
    {
        $repository = new NchlAggregatedApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions($request, $repo);


        return view('WalletAPI::NchlAggregatedTransfer/viewWalletAPICompare', compact('disputedTransactions'));

    }

}
