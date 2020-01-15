<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Entity;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class EntitiesEventsController extends Controller
{
    //
    /**
     * return all events of different categories paginated in 15
     * per page
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $events = new Event();

        if (request('q')) {
            $events = $events->search(request('q'))->take(7);
        }

        if (\request('entity')) {
            $entity = Entity::where('name', \request('entity'))->first();
            $events = $events->where('entity_id', $entity ? $entity->id : 0);
        }

        return EventResource::collection($events->get());
    }
}
