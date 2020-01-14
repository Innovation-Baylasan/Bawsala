<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Entity;
use App\Http\Controllers\Controller;
use App\Profile;
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

        return view('admin.entities.index', compact('entity'));
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
     * @return \Illuminate\Http\RedirectResponse
     *
     *
     */
    public function store()
    {
        $attributes = request()->validate([
            'category_id' => 'required',
            'name' => 'required',
            'avatar' => 'sometimes|required',
            'cover' => 'sometimes|required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $entity = auth()->user()
            ->entities()
            ->create([
                'category_id' => $attributes['category_id'],
                'name' => $attributes['name'],
                'description' => $attributes['description'],
                'latitude' => $attributes['latitude'],
                'longitude' => $attributes['longitude'],
            ]);

        if (isset($attributes['avatar'])) {
            $entity->profile->setAvatar($attributes['avatar']);
        };

        if (isset($attributes['cover'])) {
            $entity->profile->setCover($attributes['cover']);
        }
        if (request()->wantsJson()) {
            return response('uploaded successfully', 200);
        }
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
     * @return \Illuminate\Http\RedirectResponse
     * @param  Entity $entity
     *
     */
    public function update(Request $request, Entity $entity)
    {
        $entity->update(
            request()->validate([
                'user_id' => 'required',
                'category_id' => 'required',
                'name' => 'required',
                'avatar' => 'required',
                'cover' => 'required',
                'description' => 'required',
                'latitude' => 'required',
                'longitude' => 'required'
            ])
        );

        return redirect('/admin/entities')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified entity from storage.
     *
     * @param Entity $entity
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy(Entity $entity)
    {
        $entity->delete();

        return redirect('/admin/entities')->with('success', 'Data deleted successfully');
    }
}
