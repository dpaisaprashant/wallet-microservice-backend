<?php

namespace App\Http\Controllers;

use App\Events\SendOTPCodeEvent;
use App\Models\Admin;
use App\Models\AdminOTP;
use App\Models\Clearance;
use App\Models\UserLoadTransaction;
use App\Wallet\Clearance\Repository\NPayClearanceRepository;
use App\Wallet\DateConverterHelper;
use Illuminate\Http\Request;

class NPayClearanceController extends Controller
{

    private $repository;

    public function __construct(NPayClearanceRepository $repository)
    {
        $this->repository = $repository;
    }


    public function npayClearanceOTP(Request $request)
    {
        $date =($request->date);
        return redirect()->route('clearance.npay.transactions', $date);
        /*if ($request->isMethod('post'))
        {
            if ( !$this->repository->isValidOTP() )
            {
                return redirect()->back()->with('error', 'Invalid OTP');
            }
            return redirect()->route('clearance.npay.transactions', $date);
        }
        event(new SendOTPCodeEvent(Admin::findOrFail(auth()->user()->id)));
        return view('admin.clearance.npay.npayOTP')->with(compact('date'));*/
    }

    public function npay(Request $request)
    {
        return view('admin.clearance.npay.npay');
    }

    public function npayTransactions($date = null)
    {
        $date = DateConverterHelper::convertToYMDRange($date);
        $transactions = $this->repository->transactionsInDateRange($date);

        $dateRangeHasClearance = $this->repository->checkClearanceInDateRange($date);

        if ( $dateRangeHasClearance) {
            return redirect()->route('clearance.npay')->with('error', 'Clearance in that date range is already created');
        }

        if (count($transactions) == 0) {
            return redirect()->route('clearance.npay')->with('error', 'No transactions found for ' . $date['to'] . ' - ' . $date['from']);
        }

        $successfulTransactions = $transactions->map(function ($value, $key) {
            if ($value->status == 'COMPLETED') return $value;
        })->filter();

        $unsuccessfulTransactions = $transactions->map(function ($value, $key) {
            if ($value->status != 'COMPLETE') return $value;
        })->filter();

        return view('admin.clearance.npay.npayReport')->with(compact('transactions', 'date', 'successfulTransactions', 'unsuccessfulTransactions'));
    }

    public function npayView()
    {
        $clearances = $this->repository->paginatedClearanceList();
        return view('admin.clearance.npay.npayView')->with(compact('clearances'));
    }

    public function generateReport($clearanceId)
    {
        $clearance = \App\Models\Clearance::with('clearanceTransactions', 'admin')
            ->where('id', $clearanceId)
            ->firstOrFail();

        $transactions = $this->repository->transactionsInClearance($clearance);

        $successfulTransactions = $transactions->map(function ($value, $key) {
            if ($value->status == 'COMPLETED') return $value;
        })->filter();

        $unsuccessfulTransactions = $transactions->map(function ($value, $key) {
            if ($value->status != 'COMPLETED') return $value;
        })->filter();

        return view('admin.clearance.print.npayReport')
            ->with(compact('clearance', 'transactions', 'successfulTransactions', 'unsuccessfulTransactions'));

    }
}
