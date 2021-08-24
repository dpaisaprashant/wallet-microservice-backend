<?php

namespace App\Filters\Khalti;

use App\Filters\FiltersAbstract;

class KhaltiFilters extends FiltersAbstract
{

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'vendor' => VendorKhaltiFilter::class,
        'user' => UserKhaltiFilter::class,
        'from' => FromKhaltiFilter::class,
        'to' => ToKhaltiFilter::class,
        'reference_no' => KhaltiReferenceFilter::class,
        'from_amount' => FromAmountKhaltiFilter::class,
        'to_amount' => ToAmountKhaltiFilter::class,
        'account' => KhaltiAccountFilter::class,
    ];

    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping()
    {
        $map = [
            'sort' => [
                'date' => 'created_at',
                'amount' => 'amount'
            ]
        ];

        return $map;
    }
}
