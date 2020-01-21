<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Entity;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;

class EntitiesController extends Controller
{
    /**
     * return all entities of different categories paginated in 15
     * per page
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $entities = new Entity();

        if (request('q')) {
            $entities = $entities->search(request('q'))->take(7);
        }

        if (\request('category')) {
            $category = Category::where('name', \request('category'))->first();
            $entities = $entities->where('category_id', $category ? $category->id : 0);
        }
        if (($latitude = request('@lat')) && ($longitude = request('@long'))) {
            $entities = $entities->nearby($latitude, $longitude,
                request('radios') ?: '100', request('unit') ?: 'km'
            );
        }

        return EntityResource::collection($entities->get());
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
}
