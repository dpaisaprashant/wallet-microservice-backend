<?php
namespace App\Filters\Transaction;

use App\Filters\FiltersAbstract;

class TransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'uid' => UIDFilter::class,
        'transaction_id' => IdFilter::class,
        'account' => AccountFilter::class,
        'user' => UserFilter::class,
        'user_id' => UserIdFilter::class,
        'transaction_type' => TransactionTypeFilter::class,
        'vendor' => VendorFilter::class,
        'service' => ServiceFilter::class,
        //'amount' => AmountFilter::class,
        'from_amount' => FromAmountFilter::class,
        'to_amount' => ToAmountFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'date_year' => YearFilter::class,
        'date_month' => MonthFilter::class,
        'debit' => DebitCreditFilter::class,
        'debit_range' => DebitFilter::class,
        'sort' => SortFilter::class,
        'till' => TillFilter::class,
        'pre_transaction_id' => CompletePreTransactionFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [
            'sort' => [
                'date' => 'created_at',
                'amount' => 'amount'
            ]
        ];

        return  $map;
    }
}
