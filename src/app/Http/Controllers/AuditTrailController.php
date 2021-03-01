<?php

namespace App\Http\Controllers;

use App\Traits\CollectionPaginate;
use App\Wallet\DPaisaAuditTrail\AllAuditTrail;
use App\Wallet\DPaisaAuditTrail\NchlBankTransferAuditTrail;
use App\Wallet\DPaisaAuditTrail\NchlLoadTransactionAuditTrail;
use App\Wallet\DPaisaAuditTrail\NPayAuditTrail;
use App\Wallet\DPaisaAuditTrail\PPAuditTrail;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    use CollectionPaginate;

    private function allAudits($request) {
        $auditTrial = new AllAuditTrail();
        return $this->collectionPaginate(200, $auditTrial->createTrail(), $request);
    }

    private function nPayAudits($request) {

        $auditTrial = new NPayAuditTrail();
        return $this->collectionPaginate(200, $auditTrial->createTrail(), $request) ;
    }

    private function payPointAudits($request) {
        $auditTrial = new PPAuditTrail();
        return $this->collectionPaginate(200, $auditTrial->createTrail(), $request) ;
    }

    private function nchlLoadTransactionAudits($request)
    {
        $auditTrial = new NchlLoadTransactionAuditTrail();
        return $this->collectionPaginate(22, $auditTrial->createTrail(), $request);
    }

    private function nchlBankTransferAudits($request)
    {
        $auditTrial = new NchlBankTransferAuditTrail();
        return $this->collectionPaginate(22, $auditTrial->createTrail(), $request);
    }

    public function all(Request $request)
    {
        $events = $this->allAudits($request);

        return view('admin.auditTrial.allTransaction')->with(compact('events'));
    }

    public function nPay(Request $request)
    {
        $events = $this->nPayAudits($request);
        return view('admin.auditTrial.nPay')->with(compact('events'));
    }

    public function payPoint(Request $request)
    {
        $events = $this->payPointAudits($request);
        return view('admin.auditTrial.payPoint')->with(compact('events'));
    }

    public function nchlLoadTransaction(Request $request)
    {
        $events = $this->nchlLoadTransactionAudits($request);
        return view('admin.auditTrial.nchlLoadTransaction')->with(compact('events'));
    }

    public function nchlBankTransfer(Request $request)
    {
        $events = $this->nchlBankTransferAudits($request);
        return view('admin.auditTrial.nchlBankTransfer')->with(compact('events'));
    }

}
