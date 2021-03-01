<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Frontend\FrontendProcess;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class ProcessController extends Controller
{
    use UploadImage;

    public function __construct()
    {
        $this->middleware('permission:Frontend process view')->only('index');
        $this->middleware('permission:Frontend process create')->only('create');
        $this->middleware('permission:Frontend process update')->only('update');
        $this->middleware('permission:Frontend process delete')->only('delete');
    }

    public function index()
    {
        $processes = FrontendProcess::orderBy('sequence')->get();
        return view('admin.frontend.process.index')->with(compact('processes'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = Arr::except($request->all(), '_token');

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage(['image' => $request->file('image')], 'image', 'app/public/uploads/frontend/');
            }

            $process = FrontendProcess::create($data);
            return redirect()->route('frontend.process.index')->with('success', $process->title . ' creates successfully');
        }

        return view('admin.frontend.process.create');
    }

    public function update(Request $request, $id)
    {
        $process = FrontendProcess::whereId($id)->firstOrFail();
        if ($request->isMethod('post')) {
            $data = Arr::except($request->all(), '_token');

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadImage(['image' => $request->file('image')], 'image', 'app/public/uploads/frontend/');
            }

            FrontendProcess::whereId($id)->update($data);

            return redirect()->back()->with('success', 'Update successful');
        }

        return view('admin.frontend.process.update')->with(compact('process'));
    }

    public function delete(Request $request)
    {
        $setting = FrontendProcess::where('id', $request->id)->firstOrFail();
        $setting->delete();

        return redirect()->route('frontend.process.index')->with('success', 'Data successfully Deleted');
    }
}
