<?php

namespace App\Http\Controllers;


class PayPointController extends Controller
{
    public function daily()
    {

        $labels = ["NCELL", "NTC", "Electricity", "World Link", "HONS", "NetTV", "LandLine"];
        $labels = json_encode($labels);

        $sumAmount = [1000, 200, 13000, 1200, 999, 50, 0];
        $sumAmount = json_encode($sumAmount);

        return view('admin.paypoint.daily')->with(compact('labels', 'sumAmount'));
    }

    public function monthly()
    {
        $labels = ["NCELL", "NTC", "Electricity", "World Link", "HONS", "NetTV", "LandLine"];
        $labels = json_encode($labels);

        $sumAmount = [1000, 200, 13000, 1200, 999, 50, 0];
        $sumAmount = json_encode($sumAmount);

        return view('admin.paypoint.monthly')->with(compact('labels', 'sumAmount'));
    }

    public function yearly()
    {

        $labels = ["NCELL", "NTC", "Electricity", "World Link", "HONS", "NetTV", "LandLine"];
        $labels = json_encode($labels);

        $sumAmount = [1000, 200, 13000, 1200, 999, 50, 0];
        $sumAmount = json_encode($sumAmount);

        return view('admin.paypoint.yearly')->with(compact('labels', 'sumAmount'));
    }
}
