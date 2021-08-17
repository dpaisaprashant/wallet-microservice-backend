<?php


namespace App\Wallet\Report\Traits;


use App\Wallet\Report\Repositories\AbstractReportRepository;

trait ReconciliationReportGenerator
{

    public function generateReport(AbstractReportRepository $repository)
    {
        return  [
            'Paypoint' => [
                "amount" => $repository->totalPaypointTransactionAmount() / 100,
                "count" => $repository->totalPaypointTransactionCount(),
                "transaction_type" => "debit"
            ],

            'Khalti' => [
                "amount" => $repository->totalKhaltiTransactionAmount() / 100,
                "count" => $repository->totalKhaltiTransactionCount(),
                "transaction_type" => "debit"
            ],

            'NPay' => [
                "amount" => $repository->totalNPayTransactionAmount() / 100,
                "count" => $repository->totalNPayTransactionCount(),
                "transaction_type" => "credit"
            ],

            'CellPay' => [
                "amount" => $repository->totalCellPayAmount() / 100,
                "count" => $repository->totalCellPayCount(),
                "transaction_type" => "Debit"
            ],

            'NPS' => [
                "amount" => $repository->totalNpsTransactionAmount() / 100,
                "count" => $repository->totalNpsTransactionCount(),
                "transaction_type" => "credit"
            ],

            'Cashback' => [
                "amount" => $repository->totalCashbackAmount() / 100,
                "count" => $repository->totalCashbackCount(),
                "transaction_type" => "credit"
            ],

            'Commission' => [
                "amount" => $repository->totalCommissionAmount() / 100,
                "count" => $repository->totalCommissionCount(),
                "transaction_type" => "debit"
            ],

            'TestFund' => [
                "amount" => $repository->totalTestFundsAmount() / 100,
                "count" => $repository->totalTestFundsCount(),
                "transaction_type" => "credit"
            ],

            /*'Refund' => [
                "amount" => $repository->totalRefundAmount() / 100,
                "count" => $repository->totalRefundCount(),
                "transaction_type" => "credit"
            ],*/

            'Referral' => [
                "amount" => $repository->totalReferralAmount() / 100,
                "count" => $repository->totalReferralCount(),
                "transaction_type" => "credit"
            ],

            'User sends fund to bfi' => [
                "amount" => $repository->totaluserSendsFundToBfiAmount() / 100,
                "count" => $repository->totaluserSendsFundToBfiCount(),
                "transaction_type" => "debit"
            ],

            'Bfi receives funds from user' => [
                "amount" => $repository->totalBfiReceiveFundFromUserAmount() / 100,
                "count" => $repository->totalBfiReceiveFundFromUserCount(),
                "transaction_type" => "credit"
            ],

            'Bfi sends fund to user' => [
                "amount" => $repository->totalbfiSendFundToUserAmount()/100,
                "count" => $repository->totalbfiSendFundToUserCount(),
                "transaction_type" => "debit",
            ],

            'User receives fund from bfi' => [
                "amount" => $repository->totalUserReceiveFundFromUserAmount()/100,
                "count" => $repository->totalUserReceiveFundFromUserCount(),
                "transaction_type" => "credit"
            ],

            'ConnectIPS' => [
                "amount" => $repository->totalNchlLoadAmount() / 100,
                "count" => $repository->totalNchlLoadCount(),
                "transaction_type" => "credit"
            ],

            'NIC Asia CyberSource' => [
                "amount" => $repository->totalNicAsiaCyberSourceLoadAmount() / 100,
                "count" => $repository->totalNicAsiaCyberSourceLoadCount(),
                "transaction_type" => "credit"
            ],

            'NCHL Bank Transfer' => [
                "amount" => $repository->totalNchlBankTransferAmount() / 100,
                "count" => $repository->totalNchlBankTransferCount(),
                "transaction_type" => "debit"
            ],

            'NCHL Aggregated Payment' => [
                "amount" => $repository->totalNchlAggregatedPaymentAmount() / 100,
                "count" => $repository->totalNchlAggregatedPaymentCount(),
                "transaction_type" => "debit"
            ],

            'User Send to Merchant Transaction' => [
                "amount" => $repository->totalUserSendToMerchantAmount() / 100,
                "count" => $repository->totalUserSendToMerchantCount(),
                "transaction_type" => "debit"
            ],

            'Merchant Receives From User Transaction' => [
                "amount" => $repository->totalMerchantReceiveFromUserAmount() / 100,
                "count" => $repository->totalMerchantReceiveFromUserCount(),
                "transaction_type" => 'credit',
            ],

            "BFI Credit" => [
                "amount" => $repository->totalBFICreditAmount() / 100,
                "count" => $repository->totalBFICreditCount(),
                "transaction_type" => 'credit',
            ],

            "BFI Debit" => [
                "amount" => $repository->totalBFIDebitAmount() / 100,
                "count" => $repository->totalBFIDebitCount(),
                "transaction_type" => 'debit'
            ],

            'Merchant Ticket Payment' => [
                'amount' => $repository->totalUserToMerchantEventTicketPaymentAmount() / 100,
                'count' => $repository->totalUserToMerchantEventTicketPaymentCount(),
                'transaction_type' => 'debit'
            ],

            "Refund for successful transaction"=>[
                'amount' => $repository->totalRefundAmount()/100,
                'count' => $repository->totalRefundCount(),
                "transaction_type" => 'credit'
            ],

            "Refund for failure transaction"=>[
                "amount" => $repository->totalRefundForFailureAmount()/100,
                "count" => $repository->totalRefundForFailureCount(),
                "transaction_type" => 'credit'
            ],

            'Rounding off' => [
                'amount' => $repository->totalRoundOffAmount(),
                'count' => $repository->totalRoundOffCount(),
                'transaction_type' => 'rounding off'
            ],

          /*  'WalletBalance' => [
                "amount" => $repository->totalWalletBalanceAmount() / 100,
                "count" => $repository->totalWalletBalanceCount() .' number of users',
                "transaction_type" => "balance"
            ],

            'BonusBalance' => [
                "amount" => $repository->totalBonusBalanceAmount() / 100,
                "count" => $repository->totalWalletBalanceCount().' number of users',
                "transaction_type" => "balance"
            ],

            "Total Balance" => [
                "amount" => ($repository->totalWalletBalanceAmount() + $repository->totalBonusBalanceAmount()) / 100 ,
                "count" => $repository->totalWalletBalanceCount().' number of users',
                "transaction_type" => "balance"
            ],*/

            "Ntc direct" => [
                "amount" => $repository->totalNtcDirectAmount() / 100,
                "count" => $repository->totalNtcDirectCount(),
                "transaction_type" => "debit"
            ],

            "Payment Nepal" => [
                "amount" => $repository->totalPaymentNepalAmount() / 100,
                "count" => $repository->totalPaymentNepalCount(),
                "transaction_type" => "credit"
            ],

            "NPS Account Link Load" => [
                "amount" => $repository->totalNPSAccountLinkAmount() / 100,
                "count" => $repository->totalNPSAccountLinkCount(),
                "transaction_type" => "credit"
            ],
        ];
    }
}
