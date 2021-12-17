<?php


namespace App\Wallet\Report\Repositories;


use App\Models\CellPayUserTransaction;
use App\Models\KhaltiUserTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlLoadTransaction;
use App\Models\NeaTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\PaymentNepalLoadTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

abstract class AbstractReportRepository
{
    protected $request;
    public $billPayment = [];
    public $cashIn = [];
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->billPayment = [
            UserTransaction::class,
            NchlAggregatedPayment::class,
            KhaltiUserTransaction::class,
            CellPayUserTransaction::class,
            NeaTransaction::class
        ];

        $this->cashIn = [
            UserLoadTransaction::class,
            NchlLoadTransaction::class,
            NICAsiaCyberSourceLoadTransaction::class,
            NPSAccountLinkLoad::class,
            PaymentNepalLoadTransaction::class,
        ];
    }

}
