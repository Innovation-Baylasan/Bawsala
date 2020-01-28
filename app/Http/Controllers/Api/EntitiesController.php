<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Entity;
use App\Filters\EntitiesFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;

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

        $entities = Entity::filter($filters)->get();

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


    public function myEntities() {

        $entities = auth()->user()->entities();

        return EntityResource::collection($entities->get());

    }


}
