<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function view()
    {
        return view('admin.termsAndCondition.view');
    }

    public function edit(Request $request)
    {

        if ($request->isMethod('post'))
        {
            dd($request->all());
        }

        return view('admin.termsAndCondition.edit');
    }
}
