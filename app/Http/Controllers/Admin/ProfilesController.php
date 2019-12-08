<?php

namespace App\Http\Controllers\Admin;

use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Profile::latest()->paginate(5);

        // dd($data);

        return view('admin.profiles.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profiles.create');
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
            'cover' => 'image|max:2048',
            'Logo' => 'image|max:2048',
            'Address' => 'required'
        ]);

        $cover = $request->file('cover');
        $new_cover_name = rand() . '.' . $cover->getClientOriginalExtension();
        $cover->move(public_path('images').'/profiles/covers', $new_cover_name);

        $Logo = $request->file('Logo');
        $new_logo_name = rand() . '.' . $Logo->getClientOriginalExtension();
        $Logo->move(public_path('images').'/profiles/logos', $new_logo_name);

        $form_data = array(
            'entity_id' => 1,
            'cover' => $new_cover_name,
            'Logo' => $new_logo_name,
            'Address' => $request->Address
        );

        Profile::create($form_data);

        return redirect('/admin/profiles')
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

        $data = Profile::findOrFail($id);

        return View('admin.profiles.show', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Profile::findOrFail($id);

        return view('admin.profiles.edit', compact('data'));

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
        $cover_name = $request->old_cover;
        $cover = $request->file('cover');
        if ($cover != '')
        {
            $request->validate([
                'cover' => 'image|max:2048'
            ]);
            $cover_name = rand().'.'.$cover->getClientOriginalExtension();
            $cover->move(public_path('images').'/profiles/covers', $cover_name);
        }

        $Logo_name = $request->old_Logo;
        $Logo = $request->file('Logo');
        if ($Logo != '')
        {
            $request->validate([
                'Logo' => 'image|max:2048'
            ]);
            $Logo_name = rand().'.'.$Logo->getClientOriginalExtension();
            $Logo->move(public_path('images').'/profiles/logos', $Logo_name);
        }

        $request->validate([
            'Address' => 'required'
        ]);

        $form_data = array(
            'cover' => $cover_name,
            'Logo' => $Logo_name,
            'Address' => $request->Address
        );

        Profile::whereId($id)->update($form_data);

        return redirect('/admin/profiles')
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
        $data = Profile::findOrFail($id);
        $data->delete();

        return redirect('/admin/profiles')
            ->with('success', 'Data deleted successfully');
    }
}
