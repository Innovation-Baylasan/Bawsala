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
            $entities = $entities->search(request('q'));
        }

        if (\request('category')) {
            $category = Category::where('name', \request('category'))->first();
            if ($category) {

                $entities = $entities->where('category_id', $category->id);
            }
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
        return response($entity, 200);
    }
}
