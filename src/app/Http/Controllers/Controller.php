<?php

namespace App\Http\Controllers;

use App\Models\Architecture\WalletTransactionType;
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
            'Icash',
            'Recieved Funds',
            'Transfer Funds',
            'ConnectIPS'
        ];

        View::share('vendors', $vendors);

        $serviceTypes = [
            'LOAD FUNDS',
            'FUND REQUEST',
            'TOPUP',
            'PAYMENT',
            'TBANK',
            'Payments/s',
            'NCHL_LOAD_FUND',
            'BANK-TRANSFER'
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

        $walletVendors = WalletTransactionType::groupBy('vendor')->pluck('vendor')->toArray();
        View::share('walletVendors', $walletVendors);

    }
}
