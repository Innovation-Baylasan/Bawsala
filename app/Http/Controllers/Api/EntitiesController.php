<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Entity;
use App\Filters\EntitiesFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\EntityRequest;
use App\Http\Resources\EntityResource;
use Illuminate\Http\Request;

class EntitiesController extends Controller
{
    /**
     * return all entities of different categories paginated in 15
     * per page
     *
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
     * return a single entity
     *
     * @param \App\Entity $entity
     *
     * @return EntityResource
     */
    public function show(Entity $entity)
    {
        return new EntityResource($entity);
    }


    /**
     *
     * @return EntityResource
     */
    public function store(EntityRequest $request)
    {
        $attributes = $request->validated();

        $attributes['user_id'] = auth()->id();

        $entity = auth()->user()
            ->mainEntity()
            ->create(collect($attributes)->except(['cover', 'avatar'])->toArray());

        if ($request->has('tags')) {
            $entity->tagMany(array_unique($request->tags));
        }
        if (isset($attributes['avatar'])) {
            $entity->profile->setAvatar($attributes['avatar'], null);
        };

        if (isset($attributes['cover'])) {
            $entity->profile->setCover($attributes['cover'], null);
        }

        return new EntityResource($entity);
    }

}
