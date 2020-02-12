<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Entity;
use App\Filters\EntitiesFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Entity $entity)
    {
        return response([
            'data' => $entity
        ], 200);
    }


    public function myEntities()
    {

        $entities = auth()->user()->entities();

        return EntityResource::collection($entities->get());

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'category_id' => "required|max:255",
            'name' => "required|max:255",
            'description' => "required|max:255",
            'latitude' => "required|max:255",
            'longitude' => "required|max:255",
        ]);

        $entity = auth()->user()->entities()->create($attributes);

        return EntityResource::collection($entity);
    }

}
