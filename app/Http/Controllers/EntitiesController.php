<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entity;
use App\Filters\EntitiesFilter;
use App\Http\Requests\EntityRequest;
use App\Http\Resources\EntityResource;

class EntitiesController extends Controller
{
    /**
     * @param EntitiesFilter $filters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(EntitiesFilter $filters)
    {
        if (\request()->has('q')) {
            $entities = Entity::search(request('q') ?: '')
                ->query([$filters, 'apply'])
                ->take(request('take') ?: 5)->get();
        } else {
            $entities = Entity::filter($filters)->get();
        }

        return EntityResource::collection($entities);
    }

    /**
     * @param Entity $entity
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Entity $entity)
    {
        $entity = $entity->load('reviews');

        return view('profile', compact('entity'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('entities.create', compact('categories'));
    }

    /**
     * @param EntityRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(EntityRequest $request)
    {
        $attributes = $request->validated();

        $attributes['user_id'] = auth()->id();

        $entity = auth()->user()
            ->mainEntity()
            ->create($attributes);

        if ($request->has('tags')) {
            $entity->tagMany($request->tags);
        }
        if (isset($attributes['avatar'])) {
            $entity->profile->setAvatar($attributes['avatar']);
        };

        if (isset($attributes['cover'])) {
            $entity->profile->setCover($attributes['cover']);
        }


        session()->flash('message', 'Your entity has been created successfully, it\'s need to be verified then it will be visible');

        return response(null, 200);
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

        $entity->update($attributes);

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

}
