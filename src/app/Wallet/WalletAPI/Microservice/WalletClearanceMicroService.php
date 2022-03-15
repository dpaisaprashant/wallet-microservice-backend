<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use Illuminate\Http\Request;

class WalletClearanceMicroService
{
    public function dispatchStatementSettlementJobs(Request $request, $date)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_statement_sb")
            ->setRequestParam(['date' => $date]);

        $response = $microservice->processRequest();
        $statementSettlement = json_decode($response, true);
        return $statementSettlement;
    }

    public function dispatchActiveInactiveUserJobs(Request $request, $date)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_active_inactive")
            ->setRequestParam(['as_of_date' => $date]);

        $response = $microservice->processRequest();
        $activeInactive = json_decode($response, true);
        return $activeInactive;
    }
    public function dispatchActiveInactiveUserNewJobs(Request $request, $date)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_active_inactive_new")
            ->setRequestParam(['as_of_date' => $date,'new_report'=>'TRUE']);

        $response = $microservice->processRequest();
        $activeInactive = json_decode($response, true);
        return $activeInactive;
    }

    public function dispatchActiveInactiveUserSlabJobs(Request $request)
    {
        $date = $request->from;
        $slab_from = $request->fromAmount;
        $slab_to = $request->toAmount;

        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_active_inactive_slab")
            ->setRequestParam(['as_of_date' => $date,
                'slab_from' => $slab_from,
                'slab_to' => $slab_to]);

        $response = $microservice->processRequest();

        $activeInactive = json_decode($response, true);
        return $activeInactive;
    }

    public function dispatchReconciliationJobs(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $npsAmount = $request->npsAmount;
        $nchlAmount = $request->nchlAmount;
        $statementAmount = $request->statementAmount;
        $npaySettledAmount = $request->npaySettledAmount;
        $cardSettledAmount = $request->cardSettledAmount;

        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_nrb_reconciliation")
            ->setRequestParam([
                'from' => $from,
                'to' => $to,
                'nps' => $npsAmount,
                'nchl' => $nchlAmount,
                'statement' => $statementAmount,
                'npay_settled' => $npaySettledAmount,
                'card_settled' => $cardSettledAmount,
            ]);

        $response = $microservice->processRequest();
        $activeInactive = json_decode($response, true);
        return $activeInactive;
    }

    public function dispatchAgentPaymentJobs(Request $request)
    {
        $from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));


        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_agent_report_generate")
            ->setRequestParam([
                'fromDate' => $from,
                'toDate' => $to,
            ]);

        $response = $microservice->processRequest();
        $agentPaymentReport = json_decode($response, true);
        return $agentPaymentReport;
    }

    public function dispatchNrbAgentReportJobs(Request $request)
    {
        $from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from_date)));
        $to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to_date)));

        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("nrb_agent_report_generate")
            ->setRequestParam([
                'from' => $from,
                'to' => $to,
            ]);

        $response = $microservice->processRequest();
        $nrbAgentReports = json_decode($response, true);
        return $nrbAgentReports;
    }
}
