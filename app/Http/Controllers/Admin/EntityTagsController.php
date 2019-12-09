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

        $data = EntityTag::latest()->paginate(5);

        // dd($data);

        return view('admin.entity_tags.index', compact('data'))
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = EntityTag::findOrFail($id);

        return View('admin.entity_tags.show', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = EntityTag::findOrFail($id);

        $tags = Tag::all();
        $entities = Entity::all();

        return view('admin.entity_tags.edit', compact('data','tags', 'entities'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'entity_id' =>'required',
            'tag_id' =>'required'
        ]);

        $form_data = array(
            'entity_id' => $request->entity_id,
            'tag_id' => $request->tag_id
        );

        EntityTag::whereId($id)->update($form_data);

        return redirect('/admin/entity_tags')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = EntityTag::findOrFail($id);
        $data->delete();

        return redirect('/admin/entity_tags')
            ->with('success', 'Data deleted successfully');
    }
}
