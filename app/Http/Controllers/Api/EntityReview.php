<?php

namespace App\Http\Controllers\Api;

use App\Entity;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;

class EntityReview extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * return a single entity
     *
     * @param \App\Entity $entity
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request, Entity $entity)
    {
        $entity->review($request->review, $this->guard()->user());
        return response($entity, 200);
    }
}
