<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\FrontendContact;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class ContactController extends Controller
{
    use UploadImage;

    public function index(Request $request)
    {
        $contact = FrontendContact::latest()->first();

        if ($request->isMethod('post')) {

            $data = Arr::except($request->all(), '_token');

            if ($request->hasFile('logo')) {
                $data['logo'] = $this->uploadImage(['logo' => $request->file('logo')], 'logo', 'app/public/uploads/frontend/');
            }

            if (empty($contact)) {
                FrontendContact::create($data);
            }
            FrontendContact::where('id', 1)->update($data);

            return redirect()->route('frontend.contact')->with(compact('contact'));
        }

        return view('admin.frontend.contact.index')->with(compact('contact'));
    }
}
