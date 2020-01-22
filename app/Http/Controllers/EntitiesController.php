<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entity;
use App\Http\Requests\EntityRequest;

class EntitiesController extends Controller
{
    public function create()
    {
        $this->authorize('create', Entity::class);

        $categories = Category::all();

        return view('entities.create', compact('categories'));
    }

    public function store(EntityRequest $request)
    {
        $attributes = $request->validated();

        $attributes['user_id'] = auth()->id();

        $entity = auth()->user()
            ->mainEntity()
            ->subEntities()
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


        session()->flash('message', 'your entity has been created successfully');

        return response(null, 200);
    }
}
