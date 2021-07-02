<?php


namespace App\Wallet\TransactionClearance\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\TransactionEvent;
use App\Wallet\TransactionEvent\Repository\TransactionEventRepository;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ClearanceController extends Controller
{
    public function clearanceTransactions(Request $request, TransactionEventRepository $repository)
    {
        $transactions  = [];
        $totalTransactionCount = 0;
        $totalTransactionAmountSum = 0;
        $totalTransactionFeeSum = 0;
        if (isset($_GET)) {
            $transactions = $repository->paginatedTransactions();
            $totalTransactionCount = $repository->transactionsCount();
            $totalTransactionAmountSum = $repository->transactionAmountSum();
            $totalTransactionFeeSum = $repository->transactionFeeSum();
        }

        return view("Clearance::clearance.transactionList")->with(compact('transactions', 'totalTransactionCount',
                                                                        'totalTransactionAmountSum', 'totalTransactionFeeSum'));
    }

    public function clearanceGenerate(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file);
        $worksheet = $spreadsheet->getActiveSheet();
        $columns = [
            "linked_id",
            "amount",
            "transaction_fee"
        ];


        $excelTransactions = [];
        $walletTransactions = [];

    }
}
