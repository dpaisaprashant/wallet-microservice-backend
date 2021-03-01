<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\Dispute;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\DisputeHandler\Resolver\DisputeTransactionTypeResolver;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisputeController extends Controller
{

    private function getAllTransactionsId()
    {
        $userLoadTransactionsId = UserLoadTransaction::pluck('transaction_id')->toArray();
        $useCheckPaymentId = UserTransaction::pluck('refStan')->where('refStan', '!=', 'ERROR')->toArray();
        $nchlBankTransferIds = NchlBankTransfer::pluck('transaction_id')->toArray();
        $nchlLoadTransactionIds = NchlLoadTransaction::pluck('transaction_id')->toArray();

        return array_merge($userLoadTransactionsId, $useCheckPaymentId, $nchlBankTransferIds, $nchlLoadTransactionIds);
    }

    private function getTransactionDetail($request)
    {
        $detail = UserLoadTransaction::with('user', 'commission')->where('transaction_id', $request->transaction_id)->first();

        if (empty($detail))
            $detail = UserTransaction::with('user', 'executeTransaction', 'checkTransaction')->where('refStan', $request->transaction_id)->first();

        if (empty($detail))
            $detail = NchlLoadTransaction::with('user', 'commission')->where('transaction_id', $request->transaction_id)->first();

        if (empty($detail))
            $detail = NchlBankTransfer::with('user', 'commission')->where('transaction_id', $request->transaction_id)->first();

        return $detail;
    }

    public function viewAll(Request $request)
    {
        $disputes = Dispute::with('disputeable', 'disputeHandler')->latest()->filter($request)->paginate(15);
        //dd($disputes);
        return view('admin.dispute.viewDispute')->with(compact('disputes'));
    }

    /**
     * @param Request $request
     * @return View
     *
     * Display transaction data before creating dispute
     */
    public function singleDisputeView(Request $request)
    {
        $transactionIDs = $this->getAllTransactionsId();

        if ($request->isMethod('post')) {

            $detail = $this->getTransactionDetail($request);
            $selectedId = $request->transaction_id;
            return view('admin.dispute.createSingleDispute')->with(compact('transactionIDs', 'detail', 'selectedId'));
        }

        $selectedId = '';

        return view('admin.dispute.createSingleDispute')->with(compact('transactionIDs', 'selectedId'));
    }

    public function createSingleDispute(Request $request)
    {
        $data = $request->all();

        $dispute = new \App\Wallet\DisputeHandler\Dispute();
        $dispute->setTransactionID([$data['transaction_id']])
            ->setDisputeType(Dispute::DISPUTE_TYPE_SINGLE)
            ->setVendorStatus($data['vendor_status'])
            ->setVendorAmount($data['vendor_amount'])
            ->setUserAmount($data['user_amount'] ?? null)
            ->setUserStatus($data['user_status'] ?? null);

        (new DisputeTransactionTypeResolver($dispute, $data['transaction_type']))->resolve();

        DB::beginTransaction();
        if (!$dispute->createDispute()) {
            DB::rollBack();
            dd('error while creating dispute');
        }
        DB::commit();

        return redirect()->route('dispute.detail', Dispute::latest()->first()->id);
        //redirect to dispute handle page

    }

    public function disputeDetail( $id, Request $request)
    {
        $dispute = new \App\Wallet\DisputeHandler\Dispute();
        $dispute->setDisputeId($id);
        $disputeDetail = $dispute->getDisputeDetail();

        if ($disputeDetail->vendor_type == Dispute::VENDOR_TYPE_PAYPOINT) {
            $clearances = Clearance::where('clearance_type', 'payPoint')->latest()->get();
        } else {
            $clearances = Clearance::where('clearance_type', 'nPay')->latest()->get();
        }

        return view('admin.dispute.disputeDetail')->with(compact( 'disputeDetail', 'clearances'));
    }

    public function disputeClearanceDetail( $id, Request $request)
    {
        $dispute = new \App\Wallet\DisputeHandler\Dispute();
        $dispute->setDisputeId($id);
        $disputeDetail = $dispute->getDisputeDetail();

        if ($disputeDetail->vendor_type == Dispute::VENDOR_TYPE_PAYPOINT) {
            $clearances = Clearance::where('clearance_type', 'payPoint')->latest()->get();
        } else {
            $clearances = Clearance::where('clearance_type', 'nPay')->latest()->get();
        }

        return view('admin.dispute.disputeDetailClearance')->with(compact( 'disputeDetail', 'clearances'));
    }

    public function createHandleDispute(Request $request)
    {
        $dispute = new \App\Wallet\DisputeHandler\Dispute();
        $dispute->setDisputeId($request->dispute_id)
            ->setVendorType($request->vendor_type)
            ->setSource($request->problem_source ?? null)
            ->setHandler($request->dispute_handler ?? null)
            ->setDescription($request->description)
            ->setClearanceId($request->clearance_id ?? null);

            DB::beginTransaction();
            if (!$dispute->handleDispute()) {
                DB::rollBack();
                dd('error while handling dispute');
            }
            DB::commit();

        return redirect()->back()->with('Dispute handler created successfully');
    }

    public function acceptDispute(Request $request)
    {
        $dispute = new \App\Wallet\DisputeHandler\Dispute();
        $dispute->setDisputeId($request->dispute_id)->setClearanceId($request->clearance_id);

        DB::beginTransaction();
        if (!$dispute->acceptHandleDispute()) {
            DB::rollBack();
            dd('error while accepting dispute handler');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Dispute accepted successfully');

    }

    public function rejectDispute(Request $request)
    {
        $dispute = new \App\Wallet\DisputeHandler\Dispute();
        $dispute->setDisputeId($request->dispute_id)->setClearanceId($request->clearance_id);

        DB::beginTransaction();
        if (!$dispute->rejectHandleDispute()) {
            DB::rollBack();
            dd('error while rejecting dispute handler');
        }
        DB::commit();

        return redirect()->back()->with('success', 'Dispute rejected successfully');

    }
}
