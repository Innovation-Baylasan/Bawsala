<?php

namespace App\Http\Controllers\Api;

use App\Entity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntitiesController extends Controller
{
    /**
     * return all entities of different categories paginated in 15
     * per page
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entity::paginate(15);

        return response($entities, 200);
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


    /**
     * return entity search option
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function find(Request $request) {
        $entities = Entity::search($request->search)->get();
        return response($entities, 200);
    }
}
