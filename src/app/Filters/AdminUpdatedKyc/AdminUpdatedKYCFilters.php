<?php
namespace App\Filters\AdminUpdatedKyc;

use App\Filters\FiltersAbstract;

class AdminUpdatedKYCFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'admin_name' => AdminNameFilter::class,
        'user_number' => UserNumFilter::class,
        'admin_action' => AdminActionFilter::class,
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
