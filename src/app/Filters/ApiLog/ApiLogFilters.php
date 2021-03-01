<?php
namespace App\Filters\ApiLog;

use App\Filters\FiltersAbstract;

class ApiLogFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'user' => UserFilter::class,
        'refStan' => RefStanFilter::class,
        'check_payment_id' => CheckPaymentIdFilter::class,
        'execute_payment_id' => ExecutePaymentIdFilter::class,
        'transaction_id' => TransactionIdFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
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
