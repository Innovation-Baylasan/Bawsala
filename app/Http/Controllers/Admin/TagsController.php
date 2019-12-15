<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the tags.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tag = Tag::latest()->paginate(5);

        // dd($tag);

        return view('admin.tags.index', compact('tag'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $form_data = array(
            'name' => $request->name
        );

        Tag::create($form_data);

        return redirect('/admin/tags')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified tag.
     *
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag  $tag)
    {

        return View('admin.tags.show', compact('tag'));

    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {

        return view('admin.tags.edit', compact('tag'));

    }

    /**
     * Update the specified tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $form_data = array(
            'name' => $request->name
        );

        $tag->update($form_data);

        return redirect('/admin/tags')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Tag  $tag)
    {
        $tag->delete();

        return redirect('/admin/tags')
            ->with('success', 'Data deleted successfully');
    }
}
