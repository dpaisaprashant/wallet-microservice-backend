<?php


namespace App\Wallet\TransactionClearance\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\TransactionEvent;
use App\Traits\CollectionPaginate;
use App\Wallet\TransactionClearance\Clearance\Resolver\ClearanceTransactionTypeResolver;
use App\Wallet\TransactionEvent\Repository\TransactionEventRepository;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ClearanceController extends Controller
{
    use CollectionPaginate;

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
        $transactionType = $request->transaction_type;
        $fromDate = $request->from;
        $toDate = $request->to;

        $spreadsheet = IOFactory::load($request->file);
        $worksheet = $spreadsheet->getActiveSheet();
        $columns = [
            "linked_id",
            "amount",
            "transaction_fee"
        ];

        $excelTransactions = array_slice($worksheet->toArray(), 1);
        $clearanceTypeResolver = new ClearanceTransactionTypeResolver($transactionType);
        $resolvedTransaction = $clearanceTypeResolver->resolve();
        $transactions = $resolvedTransaction->compare($excelTransactions);


        $comparedTransactions = $transactions["comparedTransactions"] ?? [];
        $excelTransactionsNotFoundInWallet = $transactions["excelTransactionsNotFoundInWallet"] ?? [];
        $walletTransactionsNotFoundInExcel = $transactions["walletTransactionsNotFoundInExcel"] ?? [];
        $transactionName = $resolvedTransaction->transactionName();

        return view("Clearance::clearance.compareTransactionList")
            ->with(compact('comparedTransactions', 'excelTransactionsNotFoundInWallet', 'transactionType',
                'walletTransactionsNotFoundInExcel', 'fromDate', 'toDate', 'transactionName'));

    }
}
