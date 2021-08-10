<?php


namespace App\Wallet\Report\Repositories;


use App\Models\CellPayUserTransaction;
use App\Models\KhaltiUserTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

abstract class AbstractReportRepository
{
    protected $request;
    public $billPayment = [];
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->billPayment = [
            UserTransaction::class,
            NchlAggregatedPayment::class,
            KhaltiUserTransaction::class,
            CellPayUserTransaction::class
        ];
    }

}
