<?php

namespace App\Http\Controllers;


use App\Models\Khalti\Khalti_service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KhaltiServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $jobs = Job::all();
        return view('admin.khalti.khalti_services');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // return view('admin.career.add_job');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'label' => 'required',
                'image' => 'required',
                'service' => 'required',
                'step' => 'required',
                'forms' => 'nullable',

            ],
            [
                'label.required' => 'Label is required',
                'image.required' => 'Image is required',
                'service.required' => 'Wallet service is required',
                'step.required' => 'Two step is required',
            ]
        );

        $services = new Khalti_service;
        $services->label = $request->label;
        $services->image = $request->image;
        $services->service = json_encode(array_map('trim', explode(',', $request->input('service'))));
        $services->step = $request->step;
        // dd($request->forms);
        $services->forms = $request->forms ? json_encode($request->forms) : null;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $services->image = $imageName;
        }

        $services->save();

        return redirect('admin/khalti/khalti_services')
            ->with('success', 'New service is added');
    }


    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $jobs = Job::find($id);
        // return view('admin.career.edit_job', compact('jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'title' => 'required',
        //     'opening' => 'required',
        //     'domain' => 'required',
        //     'location' => 'required',
        //     'salary' => 'required',
        //     'description' => 'required',
        //     'specification' => 'required',
        // ]);
        // Job::find($id)->update($validated);
        // return redirect('admin/career/job');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $services = Khalti_service::find($id);
        $services->delete();
        return redirect()->back();
    }
}
