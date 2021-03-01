<?php

namespace App\Http\Controllers;

use App\Events\NpayToDpaisaTransactionExcelUpload;
use App\Events\PaypointToDpaisaTransactionExcelUpload;
use App\Wallet\Clearance\Clearance;
use App\Wallet\Clearance\Behaviors\BNpay;
use App\Wallet\Clearance\Behaviors\BPayPoint;
use App\Wallet\Clearance\Repository\NPayClearanceRepository;
use App\Wallet\Clearance\Repository\PayPointClearanceRepository;
use App\Wallet\DateConverterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function foo\func;


class ClearController extends Controller
{

    private function getDateRange($request)
    {
        $dateFrom = DateConverterHelper::convertToYMD($request->dateFrom);
        $dateTo = DateConverterHelper::convertToYMD($request->dateTo);
        return ['from' => $dateFrom, 'to' => $dateTo];
    }

    private function checkOldClearance($repository, $date, $type)
    {
        $dateRangeHasClearance = $repository->checkClearanceInDateRange($date);

        if ( $dateRangeHasClearance) {
            return redirect()->back()->with('error', 'Select date to view report');
        }

        if ($clearance = $repository->clearanceEqualToDate($date)) {
            return view('admin.clearance.print.'.strtolower($type).'Report')->with(compact('clearance'));
        }
    }


    public function nPay(Request $request, NPayClearanceRepository $repository)
    {
        $date = $this->getDateRange($request);
        $this->checkOldClearance($repository, $date, 'nPay');

        $IClearanceBehavior = new BNpay();
        $clearanceType = "nPay";

        //check excel file
        $third_party_transaction_list = event(new NpayToDpaisaTransactionExcelUpload($request->file));

        DB::beginTransaction();
        $clearance = new Clearance($IClearanceBehavior);

        if (!$clearance->checkDateOfUploadedFile($third_party_transaction_list[0], $date)) {
            dd('Wrong excel file uploaded');
        }


        try {
            $clearanceId = $clearance->createClearance($date, $clearanceType);
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error while creating transaction');
        }

        //get third party list through event
        try {
            $clearance->uploadTransaction($third_party_transaction_list[0], $clearanceId);
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error while uploading excel transaction to database');
        }


        if($clearance->isClearanceCorrect($clearanceId)){
            DB::commit();
            return redirect()->route('npay.generateClearanceReport', $clearanceId);

        }else{
            // Create Dispute
            $disputedTransactionList = $clearance->getDisputedTransactionList($clearanceId);

            $dispute = new \App\Wallet\DisputeHandler\Dispute();
            $dispute->setDisputeType(\App\Models\Dispute::DISPUTE_TYPE_CLEARANCE)
                ->setVendorType(\App\Models\Dispute::VENDOR_TYPE_NPAY)
                ->setClearanceId($clearanceId);

            $dispute->createClearanceDispute($disputedTransactionList);

            return redirect(route('npay.clearance.transactions', $clearanceId));

        }

    }


    public function payPoint(Request $request, PayPointClearanceRepository $repository)
    {
        $date = $this->getDateRange($request);
        $this->checkOldClearance($repository, $date, 'payPoint');

        $IClearanceBehavior = new BPayPoint();
        $clearanceType = "payPoint";

        //check excel file
        $third_party_transaction_list = event(new PaypointToDpaisaTransactionExcelUpload($request->file));

        //Create new object of clearance class (called ????)
        DB::beginTransaction();
        $clearance = new Clearance($IClearanceBehavior);

        if (!$clearance->checkDateOfUploadedFile($third_party_transaction_list[0], $date)) {
            dd('Wrong excel file uploaded');
        }

        try {
            $clearanceId = $clearance->createClearance($date, $clearanceType);
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error while creating clearance', $e);
        }

        //event
        $clearance->uploadTransaction($third_party_transaction_list[0], $clearanceId);


        if($clearance->isClearanceCorrect($clearanceId)){

            DB::commit();
            return redirect()->route('paypoint.generateClearanceReport', $clearanceId);

        }else{
            // Create Dispute
            $disputedTransactionList = $clearance->getDisputedTransactionList($clearanceId);

            $dispute = new \App\Wallet\DisputeHandler\Dispute();
            $dispute->setDisputeType(\App\Models\Dispute::DISPUTE_TYPE_CLEARANCE)
                ->setVendorType(\App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
                ->setClearanceId($clearanceId);

            $dispute->createClearanceDispute($disputedTransactionList);

            return redirect(route('paypoint.clearance.transactions', $clearanceId));
        }

    }

}
