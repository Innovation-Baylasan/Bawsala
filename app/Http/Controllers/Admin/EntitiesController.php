<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Entity;
use App\Http\Controllers\Controller;
use App\User;
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
        $categories = Category::all();
        $users = User::all();

        return view('admin.entities.create', compact('categories','users'));
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
            'user_id' =>'required',
            'category_id' =>'required',
            'name' => 'required',
            'description' => 'required',
            'location' => 'required'
        ]);

        $form_data = array(
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
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

        $categories = Category::all();
        $users = User::all();

        return view('admin.entities.edit', compact('data','categories', 'users'));

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
            'user_id' =>'required',
            'category_id' =>'required',
            'name' => 'required',
            'description' => 'required',
            'location' => 'required'
        ]);

        $form_data = array(
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
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
