<?php

namespace App\Http\Controllers\Admin;

use App\Entity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Entity::latest()->paginate(5);

        // dd($data);

        return view('admin.entities.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.entities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required'
        ]);

        $form_data = array(
            'user_id' => 1,
            'category_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location
        );

        Entity::create($form_data);

        return redirect('/admin/entities')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Entity::findOrFail($id);

        return View('admin.entities.show', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Entity::findOrFail($id);

        return view('admin.entities.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required'
        ]);

        $form_data = array(
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location
        );

        Entity::whereId($id)->update($form_data);

        return redirect('/admin/entities')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Entity::findOrFail($id);
        $data->delete();

        return redirect('/admin/entities')
            ->with('success', 'Data deleted successfully');
    }
}
