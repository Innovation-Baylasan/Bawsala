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
     * Display a listing of the entities.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function index()
    {

        $entity = Entity::latest()->paginate(10);

        // dd($data);

        return view('admin.entities.index', compact('entity'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new entity.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {

        $categories = Category::all();
        $users = User::all();

        return view('admin.entities.create', compact('categories', 'users'));

    }

    /**
     * Store a newly created entity in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function store()
    {
        $attributes = request()->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);


        $entity = Entity::create($attributes);
        $entity->profile->create();
        return redirect('/admin/entities')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified entity.
     *
     * @param  Entity $entity
     * @return \Illuminate\Http\Response
     *
     */
    public function show(Entity $entity)
    {

        return View('admin.entities.show', compact('entity'));

    }

    /**
     * Show the form for editing the specified entity.
     *
     * @param  Entity $entity
     * @return \Illuminate\Http\Response
     *
     */
    public function edit(Entity $entity)
    {

        $categories = Category::all();
        $users = User::all();

        return view('admin.entities.edit', compact('entity', 'categories', 'users'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @param  Entity $entity
     *
     */
    public function update(Request $request, Entity $entity)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
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

        $entity->update($form_data);

        return redirect('/admin/entities')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified entity from storage.
     *
     * @param Entity $entity
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Entity $entity)
    {

        $entity->delete();

        return redirect('/admin/entities')
            ->with('success', 'Data deleted successfully');
    }
}
