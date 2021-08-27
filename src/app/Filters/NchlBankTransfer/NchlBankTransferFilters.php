<?php

namespace App\Filters\NchlBankTransfer;

use App\Filters\FiltersAbstract;

class NchlBankTransferFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'amount' => AmountFilter::class,
        'bank' => BankFilter::class,
        'credit_status' => CreditStatusFilter::class,
        'debit_status' => DebitStatusFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'transaction_id' => IdFilter::class,
        'sort' => SortFilter::class,
        'user' => UserFilter::class,
        'pre_transaction_id' => NchlBankTransferPreTransactionFilter::class,
        'api_credit_status' => CompareApiStatusFilter::class,
    ];

    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [

        ];

        return  $map;
    }
}
