<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\FrontendHeader;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class HeaderController extends Controller
{
    use UploadImage;

    public function __construct()
    {
        $this->middleware('permission:Frontend header view|Frontend header update|Frontend header create');
    }

    public function index(Request $request)
    {
        $header = FrontendHeader::latest()->first();

        if ($request->isMethod('post')) {

            $data = Arr::except($request->all(), '_token');

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage(['image' => $request->file('image')], 'image', 'app/public/uploads/frontend/');
            }

            if ($request->hasFile('google_image')) {
                $data['google_image'] = $this->uploadImage(['google_image' => $request->file('google_image')], 'google_image', 'app/public/uploads/frontend/');
            }

            if ($request->hasFile('apple_image')) {
                $data['apple_image'] = $this->uploadImage(['apple_image' => $request->file('apple_image')], 'apple_image', 'app/public/uploads/frontend/');
            }

            if (empty($header)) {
                FrontendHeader::create($data);
            }
            FrontendHeader::where('id', 1)->update($data);

            return redirect()->route('frontend.header')->with(compact('header'));
        }

        return view('admin.frontend.header.index')->with(compact('header'));
    }

}
