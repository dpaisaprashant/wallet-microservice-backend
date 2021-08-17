<?php

namespace App\Wallet\WalletAPI\Http\Controllers;

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
        $repository = new NchlApiValidationRepository();
        $nchlAPI = $repository->getNchlAPI($request, $id);

        return view('WalletAPI::viewWalletAPI', compact('nchlAPI'));
    }

    public function compareTransactions(Request $request, NchlBankTransferRepository $repo)
    {
        $repository = new NchlApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions($request, $repo);


        return view('WalletAPI::viewWalletAPICompare', compact('disputedTransactions'));

    }

}
