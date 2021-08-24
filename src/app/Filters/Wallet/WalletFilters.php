<?php
namespace App\Filters\Wallet;

use App\Filters\FiltersAbstract;
use App\Filters\Transaction\IndividualUserNumber;

class WalletFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'individual_user_number' => IndividualUserNumber::class
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
