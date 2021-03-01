<?php

namespace App\Filters\ReimburseTransaction;

use App\Filters\FiltersAbstract;

class ReimburseTransaction extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [

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
