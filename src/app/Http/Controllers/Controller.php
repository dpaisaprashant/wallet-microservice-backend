<?php

namespace App\Http\Controllers;

use App\Models\Architecture\WalletTransactionType;
use App\Models\BfiExecutePayment;
use App\Models\BfiGatewayDebitExecutePayment;
use App\Models\BfiToUserFundTransfer;
use App\Models\FundRequest;
use App\Models\KhaltiUserTransaction;
use App\Models\Merchant\Merchant;
use App\Models\MerchantTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\NeaTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\NpsLoadTransaction;
use App\Models\TicketSale;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserLoadTransaction;
use App\Models\UserMerchantEventTicketPayment;
use App\Models\UserToBfiFundTransfer;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;

use App\Models\NepalQrTransaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $vendors = [
            'NTC',
            'NTC_TOPUP',
            'NCELL',
            'WORLDLINK',
            'VIANET',
            'SMARTSELL',
            'SUBISU',
            'WEBSURFER',
            'TBANK',
            'Dpaisa',
            'Recieved Funds',
            'Transfer Funds',
            'ConnectIPS',
            'CARD FUND LOAD',

        ];

        View::share('vendors', $vendors);

        $serviceTypes = [
            'LOAD FUNDS',
            'LOAD',
            'CARD_LOAD',
            'FUND REQUEST',
            'TOPUP',
            'PREPAID',
            'POSTPAID',
            'PAYMENT',
            'TBANK',
            'Payments/s',
            //'NCHL_LOAD_FUND',
            'BANK-TRANSFER',
            'CASHBACK',
            'AGENT_CASHBACK',
            'COMMISSION',
            'REFERRAL',
        ];

        View::share('serviceTypes', $serviceTypes);

        $paypointVendors = [
            'NTC_TOPUP',
            'NCELL',
            'VIANET',
            'SUBISU',
            'WEBSURFER',
            'SMARTCELL_TOPUP'
        ];

        View::share('paypointVendors', $paypointVendors);

        //$walletVendors = WalletTransactionType::groupBy('vendor')->pluck('vendor')->toArray();

        $walletVendors = (new WalletTransactionType())->getCachedWalletVendors();
        View::share('walletVendors', $walletVendors);

        $walletServiceTypes = (new TransactionEvent())->getCachedWalletServiceTypes();
        View::share('walletServiceTypes', $walletServiceTypes);

        $transactionTypes = [
            UserTransaction::class => "PAYPOINT",
            KhaltiUserTransaction::class => "KHALTI",
            UserLoadTransaction::class => "NPAY",
            NpsLoadTransaction::class => "NPS",
            NeaTransaction::class => "NEA",
            NchlLoadTransaction::class => "NCHL LOAD",
            NchlAggregatedPayment::class => "NCHL AGGREGATED PAYMENT",
            NchlBankTransfer::class => "BANK TRANSFER",
            NICAsiaCyberSourceLoadTransaction::class => "CARD LOAD",
            UserToUserFundTransfer::class => "USER TO USER FUND TRANSFER",
            FundRequest::class => "USER TO USER FUND REQUEST",
            MerchantTransaction::class => "USER TO MERCHANT FUND TRANSFER",
            UserMerchantEventTicketPayment::class => "EVENT TICKET PAYMENT",
            NPSAccountLinkLoad::class => "ACCOUNT LINK LOAD",
            BfiToUserFundTransfer::class => "BFI TO USER FUND TRANSFER",
            UserToBfiFundTransfer::class => "USER TO BFI FUND TRANSFER",
            BfiExecutePayment::class => "USER CREDIT BY BFI",
            BfiGatewayDebitExecutePayment::class => "USER DEBIT BY BFI",
            TicketSale::class => "TICKET SALE",
            NepalQrTransaction::class => "NEPALQR PAYMENT"
];

        $userTypes = [
            User::class => 'USER',
            Merchant::class => 'MERCHANT'
        ];


        View::share('userTypes', $userTypes);
        View::share('transactionTypes', $transactionTypes);
    }
}
