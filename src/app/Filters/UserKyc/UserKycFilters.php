<?php
namespace App\Filters\UserKyc;

use App\Filters\FiltersAbstract;

class UserKycFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'name' => NameFilter::class,
        'number' => NumberFilter::class,
        'email' => EmailFilter::class,
        'status' => StatusFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'change_status' => ChangeStatusFilter::class
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
