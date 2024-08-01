<?php
namespace App\Filters\WalletTransactionType;

use App\Filters\FiltersAbstract;
use App\Filters\Transaction\IndividualUserNumber;

class WalletTransactionTypeFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'vendorName' => vendorNameFilter::class,
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
