<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Entity;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EventsController extends Controller
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

        if (request('entity')) {
            $entity = Entity::where('name', request('entity'))->first();
            $events = $events->where('entity_id', $entity ? $entity->id : 0);
        }

        return EventResource::collection($events->get());
    }

    /**
     * @param Request $request
     * @param Entity $entity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'entity_id' => "required|max:255",
            'event_picture' => "required|max:255",
            'event_name' => "required|max:255",
            'registration_link' => "required|max:255",
            'description' => "required|max:255",
            'application_start_datetime' => "required|max:255",
            'application_end_datetime' => "required|max:255",
            'latitude' => "required|max:255",
            'longitude' => "required|max:255",
        ]);

        $event = auth()->user()->events()->create($attributes);

        return response([
            'message' => 'Event created successfully',
            'event' => $event
        ], 201);
    }
}
