<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Entity;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;

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
            $entity = Entity::where('id', request('entity'))->first();
            $events = $events->where('entity_id', $entity ? $entity->id : 0);
        }

        return EventResource::collection($events->get());

    }

    /**
     * @param EventRequest $request
     * @return EventResource
     */
    public function store(EventRequest $request)
    {
        $attributes = $request->validated();

        $event = auth()->user()->events()->create($attributes);

        if (($request->has('cover'))) {
            $event->setCover($request->cover, 'image');
        }

        return new EventResource($event);
    }

    /**
     * Remove the specified event from storage.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {

        $this->authorize('delete', $event);

        $event->delete();

        return response([
            'message' => 'Event was deleted'
        ], 200);

    }

}
