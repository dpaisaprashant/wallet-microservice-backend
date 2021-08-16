<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllUserAuditResource;
use App\Http\Resources\AllUserAuditResourceCollection;
use App\Http\Resources\ClearanceResource;
use App\Http\Resources\ClearanceTransactionResource;
use App\Http\Resources\DisputeResource;
use App\Http\Resources\DPaisaAudit\NPayResource;
use App\Http\Resources\DPaisaAudit\PayPointResource;
use App\Http\Resources\FundRequestResource;
use App\Http\Resources\FundTransferResource;
use App\Http\Resources\SparrowSMSResource;
use App\Http\Resources\TransactionEventResource;
use App\Http\Resources\UserAudit\AdminUserKYCResource;
use App\Http\Resources\UserAudit\CashBackResource;
use App\Http\Resources\UserAudit\UserActivityResource;
use App\Http\Resources\UserAudit\UserKYCResource;
use App\Http\Resources\UserAudit\UserLoginHistoryResource;
use App\Http\Resources\UserCheckPaymentResource;
use App\Http\Resources\UserLoadTransactionResource;
use App\Http\Resources\UserResource;
use App\Models\AdminUserKYC;
use App\Models\Clearance;
use App\Models\ClearanceTransaction;
use App\Models\Dispute;
use App\Models\FundRequest;
use App\Models\SparrowSMS;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserCheckPayment;
use App\Models\UserKYC;
use App\Models\UserLoadTransaction;
use App\Models\UserLoginHistory;
use App\Models\UserToUserFundTransfer;
use App\Wallet\AuditTrail\AuditTrial;
use App\Wallet\AuditTrail\Behaviors\BAll;
use App\Wallet\Commission\Models\Commission;
use App\Wallet\DPaisaAuditTrail\AllAuditTrail;
use App\Wallet\DPaisaAuditTrail\NPayAuditTrail;
use App\Wallet\DPaisaAuditTrail\PPAuditTrail;
use App\Wallet\Excel\ExportExcelHelper;
use Illuminate\Http\Request;

class ExcelExportController extends Controller
{
    public function completeTransactions(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('complete_transactions')
            ->setGeneratorModel(TransactionEvent::class)
            ->setRequest($request)
            ->setResource(TransactionEventResource::class);
        return $export->exportExcel();
    }

    public function yearlyReport(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('yearly_report')
            ->setGeneratorModel(TransactionEvent::class)
            ->setRequest($request)
            ->setResource(TransactionEventResource::class);

        return $export->exportExcel();
    }

    public function monthlyReport(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('monthly_report')
            ->setGeneratorModel(TransactionEvent::class)
            ->setRequest($request)
            ->setResource(TransactionEventResource::class);

        return $export->exportExcel();
    }

    public function users(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('users')
            ->setGeneratorModel(User::class)
            ->setRequest($request)
            ->setResource(UserResource::class);

        return $export->exportExcel();
    }

    public function fundTransfer(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('fund_transfer')
            ->setGeneratorModel(UserToUserFundTransfer::class)
            ->setRequest($request)
            ->setResource(FundTransferResource::class);

        return $export->exportExcel();
    }

    public function fundRequest(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('fund_request')
            ->setGeneratorModel(FundRequest::class)
            ->setRequest($request)
            ->setResource(FundRequestResource::class);

        return $export->exportExcel();
    }

    public function nPay(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('EBanking')
            ->setGeneratorModel(UserLoadTransaction::class)
            ->setRequest($request)
            ->setResource(UserLoadTransactionResource::class);

        return $export->exportExcel();
    }

    public function payPoint(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('paypoint')
            ->setGeneratorModel(UserCheckPayment::class)
            ->setRequest($request)
            ->setResource(UserCheckPaymentResource::class);

        return $export->exportExcel();
    }

    public function userCompleteTransactions (Request $request)
    {
        $user = User::where('mobile_no', $request->user)->first()->name;

        $export = new ExportExcelHelper();
        $export->setName($user . '_' . 'complete_transactions')
            ->setGeneratorModel(TransactionEvent::class)
            ->setRequest($request)
            ->setResource(TransactionEventResource::class);

        return $export->exportExcel();
    }

    public function userNPay(Request $request)
    {
        $user = User::where('mobile_no', $request->user)->first()->name;

        $export = new ExportExcelHelper();
        $export->setName($user . '_' . 'npay')
            ->setGeneratorModel(UserLoadTransaction::class)
            ->setRequest($request)
            ->setResource(UserLoadTransactionResource::class);

        return $export->exportExcel();
    }

    public function failedNPay(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('failed_EBanking')
            ->setGeneratorModel(UserLoadTransaction::class)
            ->setRequest($request)
            ->setResource(UserLoadTransactionResource::class);

        return $export->exportExcel();
    }

    public function failedPayPoint(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('failed_paypoint')
            ->setGeneratorModel(UserCheckPayment::class)
            ->setRequest($request)
            ->setResource(UserCheckPaymentResource::class);

        return $export->exportExcel();
    }

    public function nPayClearance(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('nPay_clearance')
            ->setGeneratorModel(Clearance::class)
            ->setRequest($request)
            ->setResource(ClearanceResource::class);

        return $export->exportExcel();
    }

    public function payPointClearance(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('payPoint_clearance')
            ->setGeneratorModel(Clearance::class)
            ->setRequest($request)
            ->setResource(ClearanceResource::class);

        return $export->exportExcel();
    }

    public function clearanceTransaction(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('clearance_transactions')
            ->setGeneratorModel(ClearanceTransaction::class)
            ->setRequest($request)
            ->setResource(ClearanceTransactionResource::class);

        return $export->exportExcel();
    }


    public function disputes(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('disputes')
            ->setGeneratorModel(Dispute::class)
            ->setRequest($request)
            ->setResource(DisputeResource::class);

        return $export->exportExcel();
    }

    public function sparrowSMS(Request $request)
    {
        $export = new ExportExcelHelper();
        $export->setName('sparrow_sms')
            ->setGeneratorModel(SparrowSMS::class)
            ->setRequest($request)
            ->setResource(SparrowSMSResource::class);

        return $export->exportExcel();
    }

    private function transformAuditData($collection, $userId)
    {
        return $collection->transform(function($value, $key) use ($userId) {
            if ($value instanceof AdminUserKYC)
            {
                return new AdminUserKYCResource($value);
            } elseif ($value instanceof UserLoginHistory)
            {
                return new UserLoginHistoryResource($value);
            } elseif ($value instanceof UserToUserFundTransfer)
            {
                return (new \App\Http\Resources\UserAudit\FundTransferResource($value))->setUserId($userId);
            } elseif ($value instanceof FundRequest)
            {
                return (new \App\Http\Resources\UserAudit\FundRequestResource($value))->setUserId($userId);
            } elseif ($value instanceof Commission && $value->module == Commission::MODULE_CASHBACK)
            {
                return new CashBackResource($value);
            } elseif ($value instanceof UserCheckPayment)
            {
                return new \App\Http\Resources\UserAudit\UserCheckPaymentResource($value);
            } elseif ($value instanceof UserLoadTransaction)
            {
                return new \App\Http\Resources\UserAudit\UserLoadTransactionResource($value);
            } elseif ($value instanceof UserKYC)
            {
                return new UserKYCResource($value);
            } elseif ($value instanceof UserActivity)
            {
                return new UserActivityResource($value);
            }
        });
    }

    private function transformSuccessfulAuditData($collection, $userId)
    {
        return $collection->transform(function($value, $key) use ($userId) {
            if ($value instanceof AdminUserKYC)
            {
                return new AdminUserKYCResource($value);
            } elseif ($value instanceof UserLoginHistory)
            {
                return new UserLoginHistoryResource($value);
            } elseif ($value instanceof UserToUserFundTransfer)
            {
                return (new \App\Http\Resources\UserAudit\FundTransferResource($value))->setUserId($userId);
            } elseif ($value instanceof FundRequest)
            {
                return (new \App\Http\Resources\UserAudit\FundRequestResource($value))->setUserId($userId);
            } elseif ($value instanceof Commission && $value->module == Commission::MODULE_CASHBACK)
            {
                return new CashBackResource($value);
            } elseif ($value instanceof UserCheckPayment && !empty($value->userTransaction))
            {
                return new \App\Http\Resources\UserAudit\UserCheckPaymentResource($value);
            } elseif ($value instanceof UserLoadTransaction && $value->status == 'COMPLETED')
            {
                return new \App\Http\Resources\UserAudit\UserLoadTransactionResource($value);
            } elseif ($value instanceof UserKYC)
            {
                return new UserKYCResource($value);
            } elseif ($value instanceof UserActivity)
            {
                return new UserActivityResource($value);
            }
        });
    }

    public function userAllAuditTrail(Request $request, $userId)
    {
        $IBehaviour = new BAll();
        $auditTrial = new AuditTrial($IBehaviour);
        $user = User::where('id', $userId)->firstOrFail();
        $collection = $auditTrial->setRequest($request)->createTrial($user);

        $collection = $this->transformAuditData($collection, $userId);
        //$collection = $this->transformSuccessfulAuditData($collection, $userId);

        $export = new ExportExcelHelper();
        $export->setName($user->name . '_audit_trail')
            ->setMixGeneratorModels($collection->filter())
            ->setRequest($request);

        return $export->exportExcelCollection();
    }

    public function dpaisaAllAuditTrail(Request $request)
    {
        $auditTrail = new AllAuditTrail();
        $collection = $auditTrail->createTrail();

        $collection->transform(function ($value){

            if ($value instanceof UserCheckPayment)
            {
                return new PayPointResource($value);
            } elseif ($value instanceof UserLoadTransaction)
            {
                return new NPayResource($value);
            }
        });

        $export = new ExportExcelHelper();
        $export->setName('ICash_all_audit_trail')
            ->setMixGeneratorModels($collection->filter())
            ->setRequest($request);

        return $export->exportExcelCollection();
    }

    public function dpaisaNPayAuditTrail(Request $request)
    {
        $auditTrail = new NPayAuditTrail();
        $collection = $auditTrail->createTrail();

        $collection->transform(function ($value){
            return new NPayResource($value);
        });

        $export = new ExportExcelHelper();
        $export->setName('npay_audit_trail')
            ->setMixGeneratorModels($collection->filter())
            ->setRequest($request);

        return $export->exportExcelCollection();
    }

    public function dpaisaPPAuditTrail(Request $request)
    {
        $auditTrail = new PPAuditTrail();
        $collection = $auditTrail->createTrail();

        $collection->transform(function ($value){
            return new PayPointResource($value);
        });

        $export = new ExportExcelHelper();
        $export->setName('paypoint_audit_trail')
            ->setMixGeneratorModels($collection->filter())
            ->setRequest($request);

        return $export->exportExcelCollection();
    }

}
