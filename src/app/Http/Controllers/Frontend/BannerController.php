<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\FrontendBanner;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class BannerController extends Controller
{
    use UploadImage;

    public function index()
    {
        $banners = FrontendBanner::latest()->get();
        return view('admin.frontend.banner.index')->with(compact('banners'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = Arr::except($request->all(), '_token');

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage(['image' => $request->file('image')], 'image', 'app/public/uploads/frontend/');
            }

            if ($request->hasFile('mobile_image')) {
                $data['mobile_image'] = $this->uploadImage(['mobile_image' => $request->file('mobile_image')], 'mobile_image', 'app/public/uploads/frontend/');
            }

            $process = FrontendBanner::create($data);
            return redirect()->route('frontend.banner.index')->with('success', $process->title . ' creates successfully');
        }

        return view('admin.frontend.banner.create');
    }

    public function update(Request $request, $id)
    {
        $banner = FrontendBanner::whereId($id)->firstOrFail();
        if ($request->isMethod('post')) {
            $data = Arr::except($request->all(), '_token');

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage(['image' => $request->file('image')], 'image', 'app/public/uploads/frontend/');
            }

            if ($request->hasFile('mobile_image')) {
                $data['mobile_image'] = $this->uploadImage(['mobile_image' => $request->file('mobile_image')], 'mobile_image', 'app/public/uploads/frontend/');
            }

            FrontendBanner::whereId($id)->update($data);

            return redirect()->back()->with('success', "Update Successful");
        }
        return view('admin.frontend.banner.update')->with(compact('banner'));
    }

    public function delete(Request $request)
    {
        $setting = FrontendBanner::where('id', $request->id)->firstOrFail();
        $setting->delete();

        return redirect()->route('frontend.banner.index')->with('success', 'Data successfully Deleted');
    }
}
