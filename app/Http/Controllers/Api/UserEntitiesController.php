<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use App\Http\Resources\EventResource;

class UserEntitiesController extends Controller
{

    /**
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

        $events = auth()->user()->entities();

        return EntityResource::collection($events->get());

    }

}
