<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class UserEventsController extends Controller
{
    /**
     * index,store,show,destroy,create,update,edit
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

        $events = auth()->user()->events();

        return EventResource::collection($events->get());

    }
}
