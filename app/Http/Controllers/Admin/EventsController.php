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

        $event = Event::latest()->paginate(5);

        // dd($event);

        return view('admin.events.index', compact('event'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {

        $request->validate([
            'entity_id' => 'required',
            'cover' => 'image|max:2048',
            'title'  => 'required',
            'description'  => 'required',
            'due_date'  => 'required'
        ]);

        $cover = $request->file('cover');
        $new_cover_name = rand() . '.' . $cover->getClientOriginalExtension();
        $cover->move(public_path('images').'/events/covers', $new_cover_name);

        $form_data = array(
            'entity_id' => $request->entity_id,
            'cover' => $new_cover_name,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
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
     * @param  \Illuminate\Http\Request  $request
     * @param  Event  event
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, Event $event)
    {
        $cover_name = $request->old_cover;
        $cover = $request->file('cover');
        if ($cover != '')
        {
            $request->validate([
                'cover' => 'image|max:2048'
            ]);
            $cover_name = rand().'.'.$cover->getClientOriginalExtension();
            $cover->move(public_path('images').'/events/covers', $cover_name);
        }

        $request->validate([
            'entity_id' => 'required',
            'cover' => 'image|max:2048',
            'title'  => 'required',
            'description'  => 'required',
            'due_date'  => 'required'
        ]);

        $form_data = array(
            'entity_id' => $request->entity_id,
            'cover' => $cover_name,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
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
