<?php
namespace App\Filters\UsedUserReferral;

use App\Filters\FiltersAbstract;

class UsedUserReferralFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'referred_from' => ReferredFromFilter::class,
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
