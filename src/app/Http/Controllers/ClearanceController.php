<?php

namespace App\Http\Controllers;

use App\Models\ClearanceTransaction;
use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Models\TransactionEvent;
use App\Models\Clearance;
use App\Models\UserLoadTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClearanceController extends Controller
{
    public function clear(Request $request)
    {

        $date = date('Y-m-d', strtotime(str_replace(',', ' ', $request->date))) ?? null;

        $transactions = TransactionEvent::whereDate('created_at', $date)
            ->where('transaction_type', $request->transaction_type)
            ->with('transactionable')
            ->get();

        //check for duplicate clearance



        $clearance = Clearance::create([
            'admin_id' => auth()->user()->id,
            'total_transaction_count' => $transactions->count(),
            'total_transaction_amount' => $transactions->sum('amount') * 100,
            'total_transaction_commission' => 0.0,
            'transaction_date' => $date,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => Clearance::STATUS_CLEARED,
        ]);

        $clearance->transactions()->saveMany($transactions);


        if ($request->transaction_type == 'App\Models\UserLoadTransaction') {
            return view('admin.clearance.print.npayReport')->with(compact('clearance'));

        } elseif ($request->transaction_type == 'App\Models\UserTransaction') {
            return view('admin.clearance.print.paypointReport')->with(compact('clearance'));
        }

    }

    public function changeStatus($id, Request $request)
    {
        $clearance = Clearance::with('clearanceTransactions')->where('id', $id)->firstOrFail();

        if ($request->isMethod('post')) {

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = Str::random().'.'.$ext;
                $uploadPath = storage_path('app/public/uploads/clearance/');
                $image->move($uploadPath, $imageName);
                $clearance->image = $imageName;

            }

            $clearance->clearance_status = $request->status;
            $clearance->save();

            if ($clearance->clearance_type == 'payPoint') {
                return redirect()->route('clearance.paypointView');
            } else {
                return redirect()->route('clearance.npayView');
            }

        }

        return view('admin.clearance.changeStatus')->with(compact('clearance'));
    }

    public function nPayTransactions(Request $request,  $clearanceId)
    {
        $clearance = Clearance::where('id', $clearanceId)->with('clearanceTransactions', 'admin', 'dispute')->first();
        $clearanceTransactions = ClearanceTransaction::whereClearanceId($clearanceId)->with('clearanceable')->latest()->filter($request)->get();
        $successfulClearanceTransactions = $clearanceTransactions->map(function ($value, $key) {
            if ($value->clearanceable->status == UserLoadTransaction::STATUS_COMPLETED) return $value;
        })->filter();

        $transactionCount = count($clearanceTransactions);
        $transactionAmountSum = $successfulClearanceTransactions->sum(function ($transaction) {
            return $transaction->clearanceable->amount;
        });
        $originalDisputeCount = count($clearance->dispute);
        $handledDisputeCount = Dispute::whereClearanceId($clearanceId)->whereHas('disputeHandler', function ($query) {
            $query->whereDisputeType(Dispute::HANDLER_CLEARANCE);
        })->count();


        $totalTransactionFee = $clearanceTransactions->sum(function ($value) {
            return $value->clearanceable->transaction_fee ?? 0;
        });

        $totalNetAmount = $transactionAmountSum - $totalTransactionFee;

        return view('admin.clearance.npayTransaction')->with(compact('clearance', 'clearanceTransactions',
            'transactionCount','transactionAmountSum',
            'originalDisputeCount', 'handledDisputeCount', 'totalTransactionFee', 'totalNetAmount'));
    }

    public function payPointTransactions(Request $request,  $clearanceId)
    {
        $clearance = Clearance::where('id', $clearanceId)->with('clearanceTransactions', 'admin', 'dispute')->first();
        $clearanceTransactions = ClearanceTransaction::whereClearanceId($clearanceId)->with('clearanceable')->latest()->filter($request)->get();

        $transactionCount = count($clearanceTransactions);
        $transactionAmountSum = $clearanceTransactions->sum(function ($transaction) {
            return $transaction->clearanceable->amount;
        });
        $originalDisputeCount = count($clearance->dispute);
        $handledDisputeCount = Dispute::whereClearanceId($clearanceId)->whereHas('disputeHandler', function ($query) {
            $query->whereDisputeType(Dispute::HANDLER_CLEARANCE);
        })->count();

        $clearance->load(['paypointExcelTransactions']);
        $totalRevenue = $clearance->paypointExcelTransactions()->sum('revenue') / 100;

        return view('admin.clearance.paypointTransaction')->with(compact('clearance', 'clearanceTransactions', 'transactionCount',
            'transactionAmountSum', 'originalDisputeCount', 'handledDisputeCount', 'totalRevenue'));
    }

}
