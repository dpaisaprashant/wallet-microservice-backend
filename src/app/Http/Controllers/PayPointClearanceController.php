<?php

namespace App\Http\Controllers;

use App\Events\SendOTPCodeEvent;
use App\Models\Admin;
use App\Models\AdminOTP;
use App\Models\Clearance;
use App\Models\UserTransaction;
use App\Wallet\Clearance\Repository\PayPointClearanceRepository;
use App\Wallet\DateConverterHelper;
use Illuminate\Http\Request;

class PayPointClearanceController extends Controller
{

    private $repository;

    public function __construct(PayPointClearanceRepository $repository)
    {
        $this->repository = $repository;
    }


    public function paypointClearanceOTP(Request $request)
    {
        $date = $request->date;
        return redirect()->route('clearance.paypoint.transactions', $date);
        /*if ($request->isMethod('post')) {

            if (! $this->repository->isValidOTP() )
            {
                return redirect()->back()->with('error', 'Invalid OTP');
            }
            return redirect()->route('clearance.paypoint.transactions', $date);
        }
        event(new SendOTPCodeEvent(Admin::findOrFail(auth()->user()->id)));
        return view('admin.clearance.paypoint.paypointOTP')->with(compact('date'));*/
    }

    public function paypoint(Request $request)
    {
        return view('admin.clearance.paypoint.paypoint');
    }

    public function paypointTransactions($date = null)
    {
        $date = DateConverterHelper::convertToYMDRange($date);

        $transactions = $this->repository->transactionsInDateRange($date);

        $dateRangeHasClearance = $this->repository->checkClearanceInDateRange($date);

        if ($dateRangeHasClearance) {
            return redirect()->route('clearance.paypoint')->with('error', 'Clearance in that date range is already created');
        }

        if (count($transactions) == 0) {
            return redirect()->route('clearance.paypoint')->with('error', 'No transactions found for ' . $date['from'] . ' to ' . $date['to'] );
        }

        return view('admin.clearance.paypoint.paypointReport')->with(compact('transactions', 'date'));
    }

    public function paypointView()
    {
        $clearances = $this->repository->paginatedClearanceList();
        return view('admin.clearance.paypoint.paypointView')->with(compact('clearances'));
    }

    public function generateReport($clearanceId)
    {
        $clearance = \App\Models\Clearance::with('clearanceTransactions', 'admin')->where('id', $clearanceId)->firstOrFail();
        $transactions = $this->repository->transactionsInClearance($clearance);

        return view('admin.clearance.print.paypointReport')->with(compact('clearance', 'transactions'));

    }
}
