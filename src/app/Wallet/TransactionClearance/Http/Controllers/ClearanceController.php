<?php


namespace App\Wallet\TransactionClearance\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
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
        $info = "";
        if (!empty($_GET)) {
            $transactions = $repository->paginatedTransactions();
            $totalTransactionCount = $repository->transactionsCount();
            $totalTransactionAmountSum = $repository->transactionAmountSum();
            $totalTransactionFeeSum = $repository->transactionFeeSum();

            $transactionType = $request->transaction_type;
            $clearanceTypeResolver = (new ClearanceTransactionTypeResolver($transactionType))->resolve();
            if (method_exists($clearanceTypeResolver, "clearanceInfo")) {
                $info = $clearanceTypeResolver->clearanceInfo();
            }
        }

        return view("Clearance::clearance.transactionList")->with(compact('transactions', 'totalTransactionCount',
                                                                        'totalTransactionAmountSum', 'totalTransactionFeeSum', 'info'));
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
        $unmatchedAmounts = $transactions["unmatchedAmounts"] ?? [];
        $unmatchedTransactionFees = $transactions["unmatchedTransactionFees"] ?? [];
        $excelTransactionsNotFoundInWallet = $transactions["excelTransactionsNotFoundInWallet"] ?? [];
        $walletTransactionsNotFoundInExcel = $transactions["walletTransactionsNotFoundInExcel"] ?? [];
        $transactionName = $resolvedTransaction->transactionName();

        return view("Clearance::clearance.compareTransactionList")
            ->with(compact('comparedTransactions', 'excelTransactionsNotFoundInWallet', 'transactionType',
                'walletTransactionsNotFoundInExcel', 'fromDate', 'toDate', 'transactionName','unmatchedTransactionFees','unmatchedAmounts'));

    }
}
