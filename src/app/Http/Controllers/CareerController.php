<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.career.job');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.career.add_job');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request ->validate([
            'name' => 'required',
        ]);
        Type::create($validated);
        return redirect('admin/blog/type')
        ->with('success','Post created successfully.');
    }


    public function show(Type $type)
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
        $type = Type::find($id);
        return view('admin/blog/edit_type', compact('type'));
        // return redirect()->back()
        //   ->with('success', 'Post edited successfully');
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
        $validated = $request ->validate([
            'name' => 'required',
        ]);
        Type::where('id', $id)->update($validated);
        // $types->update();
        return redirect('admin/blog/type')
          ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $type = Type::find($id);
        $type->delete();
        return redirect()->back()
          ->with('success', 'Post deleted successfully');
    }
}

