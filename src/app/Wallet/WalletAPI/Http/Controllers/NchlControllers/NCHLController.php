<?php

namespace App\Wallet\WalletAPI\Http\Controllers\NchlControllers;

use App\Wallet\WalletAPI\Microservice\NchlMicroservice;
use App\Wallet\WalletAPI\Repositories\NchlApiValidationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class NCHLController extends Controller
{
    public function byId(Request $request, $id)
    {
        $nchlMicroservice = new NchlMicroservice();
        $nchlAPI = $nchlMicroservice->getNchlAPI($request, $id);

        return view('WalletAPI::NchlBankTransfer/viewWalletAPI', compact('nchlAPI'));
    }

    public function byDate(Request $request)
    {
        $dateFrom=$request->dateFrom;
        $dateTo=$request->dateTo;
        $nchlMicroservice = new NchlMicroservice();
        $nchlAPI = $nchlMicroservice->getNchlAPIByDate($request, $dateFrom, $dateTo);

        return view('WalletAPI::NchlBankTransfer/viewWalletAPICompare', compact('nchlAPI'));
    }

    public function compareTransactions(Request $request, NchlBankTransferRepository $repo)
    {
        $repository = new NchlApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions($request, $repo);


        return view('WalletAPI::NchlBankTransfer/viewWalletAPICompare', compact('disputedTransactions'));

    }

}
