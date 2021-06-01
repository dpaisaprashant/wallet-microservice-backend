<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepostController extends Controller
{
    public function npay(Request $request)
    {
        return view('admin.repost.npay');
    }
}
