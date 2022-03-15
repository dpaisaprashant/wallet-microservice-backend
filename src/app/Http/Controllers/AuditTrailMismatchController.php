<?php

namespace App\Http\Controllers;

use App\Models\AuditTrailMismatch;
use App\Traits\CollectionPaginate;
use App\Wallet\DPaisaAuditTrail\AllAuditTrail;
use App\Wallet\DPaisaAuditTrail\NchlBankTransferAuditTrail;
use App\Wallet\DPaisaAuditTrail\NchlLoadTransactionAuditTrail;
use App\Wallet\DPaisaAuditTrail\NPayAuditTrail;
use App\Wallet\DPaisaAuditTrail\PPAuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditTrailMismatchController extends Controller
{
    use CollectionPaginate;

    public function auditTrailMismatch()
    {
//        $auditTrailMismatches = DB::connection('clearance')->table('audit_trial_mismatch')->get();
        $auditTrailMismatches = AuditTrailMismatch::all();

        return view('WalletReport::auditTrailMismatch.audit-trail-mismatch-report', compact('auditTrailMismatches'));
    }

}
