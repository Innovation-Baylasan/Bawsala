<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entity;
use App\Filters\EntitiesFilter;
use App\Http\Requests\EntityRequest;
use App\Http\Resources\EntityResource;

class EntitiesController extends Controller
{
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
