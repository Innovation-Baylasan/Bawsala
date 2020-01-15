<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Entity;
use App\Http\Controllers\Controller;
use App\Http\Requests\EntityRequest;
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

        return view('admin.entities.create', compact('categories'));

    }

    /**
     * Store a newly created entity in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     *
     */
    public function store(EntityRequest $entityRequest)
    {
        $attributes = $entityRequest->validated();

        $entity = auth()->user()
            ->entities()
            ->create([
                'category_id' => $attributes['category_id'],
                'name' => $attributes['name'],
                'description' => $attributes['description'],
                'latitude' => $attributes['latitude'],
                'longitude' => $attributes['longitude'],
            ]);


        if ($entityRequest->has('tags')) {
            $entity->tagMany($entityRequest->tags);
        }
        if (isset($attributes['avatar'])) {
            $entity->profile->setAvatar($attributes['avatar']);
        };

        if (isset($attributes['cover'])) {
            $entity->profile->setCover($attributes['cover']);
        }


        session()->flash('success', 'Entity created successfully');

        return response(null, 200);

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
    public function update(EntityRequest $request, Entity $entity)
    {
        $attributes = $request->validated();

        $entity->update([
            'category_id' => $attributes['category_id'],
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'latitude' => $attributes['latitude'],
            'longitude' => $attributes['longitude'],
        ]);
        $entity->tags()->detach();

        if ($request->has('tags')) {
            $entity->tagMany($request->tags);
        }

        if (isset($attributes['avatar']) && ($entity->avatar != $attributes['avatar'])) {
            $entity->profile->setAvatar($attributes['avatar']);
        };

        if (isset($attributes['cover']) && ($entity->cover != $attributes['cover'])) {
            $entity->profile->setCover($attributes['cover']);
        }

        session()->flash('message', 'Entity updated successfully');

        return response(null, 200);
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

        return redirect('/admin/entities')->with('message', 'Data deleted successfully');
    }
}
