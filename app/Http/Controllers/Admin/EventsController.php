<?php

namespace App\Http\Controllers\Admin;

use App\Entity;
use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::latest()->paginate(5);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entities = Entity::all();
        return view('admin.events.create', compact('entities'));
    }

    /**
     * Store a newly created event in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'entity_id' => 'required',
            'picture' => 'required',
            'name' => 'required',
            'link' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'title' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'confirm' => 'required|numeric',
        ]);

        $form_data = array(
            'creator_id' => auth()->user()->id,
            'entity_id' => $attributes['entity_id'],
            'picture' => $attributes['picture'],
            'name' => $attributes['name'],
            'link' => $attributes['link'],
            'description' => $attributes['description'],
            'start_date' => $attributes['start_date'],
            'end_date' => $attributes['end_date'],
            'latitude' => $attributes['latitude'],
            'longitude' => $attributes['longitude'],
            'confirm' => $attributes['confirm'],
        );

        Event::create($form_data);

        return redirect('/admin/events')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified event.
     *
     * @param  Event  event
     * @return \Illuminate\Http\Response
     *
     */
    public function show(Event $event)
    {

        return View('admin.events.show', compact('event'));

    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  Event  event
     * @return \Illuminate\Http\Response
     *
     */
    public function edit(Event $event)
    {

        $entities = Entity::all();

        return view('admin.events.edit', compact('event', 'entities'));

    }

    /**
     * Update the specified event in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Event  event
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, Event $event)
    {
        $attributes = $request->validate([
            'entity_id' => 'required',
            'picture' => 'required',
            'name' => 'required',
            'link' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'title' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'confirm' => 'required|numeric',
        ]);

        $form_data = array(
            'creator_id' => auth()->user()->id,
            'entity_id' => $attributes['entity_id'],
            'picture' => $attributes['picture'],
            'name' => $attributes['name'],
            'link' => $attributes['link'],
            'description' => $attributes['description'],
            'start_date' => $attributes['start_date'],
            'end_date' => $attributes['end_date'],
            'latitude' => $attributes['latitude'],
            'longitude' => $attributes['longitude'],
            'confirm' => $attributes['confirm'],
        );

        $event->update($form_data);

        return redirect('/admin/events')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     *
     * @param Event  event
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Event $event)
    {

        $event->delete();

        return redirect('/admin/events')
            ->with('success', 'Data deleted successfully');

    }
}
