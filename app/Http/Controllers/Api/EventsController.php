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
            'entity_id' => ['required', 'string', 'max:255'],
            'event_picture' => ['required', 'string', 'max:255'],
            'event_name' => ['required', 'string', 'max:255'],
            'registration_link' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'application_start_datetime' => ['required', 'string', 'max:255'],
            'application_end_datetime' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'string', 'max:255'],
        ]);

        $event = Event::create([
            'creator_id' => auth()->user()->id,
            'entity_id' => $attributes['entity_id'],
            'event_picture' => $attributes['event_picture'],
            'event_name' => $attributes['event_name'],
            'registration_link' => $attributes['registration_link'],
            'description' => $attributes['description'],
            'application_start_datetime' => $attributes['application_start_datetime'],
            'application_end_datetime' => $attributes['application_end_datetime'],
            'latitude' => $attributes['latitude'],
            'longitude' => $attributes['longitude'],
        ]);

        return response([
            'message' => 'Event created successfully',
            'event' => $event
        ], 201);
    }
}
