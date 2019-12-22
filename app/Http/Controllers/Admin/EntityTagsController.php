<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Entity;
use App\EntityTag;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class EntityTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $entityTag = EntityTag::latest()->paginate(5);

        // dd($entityTag);

        return view('admin.entity_tags.index', compact('entityTag'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $entities = Entity::all();

        return view('admin.entity_tags.create', compact('tags','entities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'entity_id' =>'required',
            'tag_id' =>'required'
        ]);

        $form_data = array(
            'entity_id' => $request->entity_id,
            'tag_id' => $request->tag_id
        );

        EntityTag::create($form_data);

        return redirect('/admin/entity_tags')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified entityTag.
     *
     * @param  EntityTag  $entityTag
     * @return \Illuminate\Http\Response
     */
    public function show(EntityTag $entityTag)
    {

        return View('admin.entity_tags.show', compact('entityTag'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  EntityTag  $entityTag
     * @return \Illuminate\Http\Response
     */
    public function edit(EntityTag $entityTag)
    {

        $tags = Tag::all();
        $entities = Entity::all();

        return view('admin.entity_tags.edit', compact('entityTag','tags', 'entities'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  EntityTag   $entityTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntityTag $entityTag)
    {
        $request->validate([
            'entity_id' =>'required',
            'tag_id' =>'required'
        ]);

        $form_data = array(
            'entity_id' => $request->entity_id,
            'tag_id' => $request->tag_id
        );

        $entityTag->update($form_data);

        return redirect('/admin/entity_tags')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified entity from storage.
     *
     * @param  EntityTag  $entityTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntityTag $entityTag)
    {

        $entityTag->delete();

        return redirect('/admin/entity_tags')
            ->with('success', 'Data deleted successfully');
    }
}
