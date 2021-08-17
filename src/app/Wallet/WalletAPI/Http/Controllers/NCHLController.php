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
use App\Wallet\WalletAPI\Repositories\NchlApiValidationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use Carbon\Carbon;


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
