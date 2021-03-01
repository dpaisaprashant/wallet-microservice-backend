<?php


namespace App\Wallet\Report\Repositories;


use Illuminate\Http\Request;

abstract class AbstractReportRepository
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
