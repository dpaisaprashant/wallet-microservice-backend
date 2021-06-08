<?php


namespace App\Wallet\Microservice\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveCustomerReportRepository;
use App\Wallet\Report\Repositories\AgentReportRepository;
use App\Wallet\Report\Repositories\NonBankPaymentReportRepository;
use Illuminate\Http\Request;

class PaypointMicroserviceController extends Controller
{
    use CollectionPaginate;

    public function getTransaction(Request $request)
    {

    }
}
