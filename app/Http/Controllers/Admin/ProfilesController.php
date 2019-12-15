<?php

namespace App\Http\Controllers\Admin;

use App\Entity;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the profiles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profile = Profile::latest()->paginate(5);

        // dd($profile);

        return view('admin.profiles.index', compact('profile'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entities = Entity::all();
        return view('admin.profiles.create', compact('entities'));
    }

    /**
     * Store a newly created profile in storage.
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
            'entity_id' => $request->entity_id,
            'cover' => $new_cover_name,
            'Logo' => $new_logo_name,
            'Address' => $request->Address
        );

        Profile::create($form_data);

        return redirect('/admin/profiles')
            ->with('success', 'Data added successfully.');

    }

    /**
     * Display the specified profile.
     *
     * @param  Profile  profile
     * @return \Illuminate\Http\Response
     *
     */
    public function show(Profile $profile)
    {

        return View('admin.profiles.show', compact('profile'));

    }

    /**
     * Show the form for editing the specified profile.
     *
     * @param  Profile  profile
     * @return \Illuminate\Http\Response
     *
     */
    public function edit(Profile $profile)
    {

        $entities = Entity::all();

        return view('admin.profiles.edit', compact('profile', 'entities'));

    }

    /**
     * Update the specified profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Profile  profile
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, Profile $profile)
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
            'entity_id' => 'required',
            'Address' => 'required'
        ]);

        $form_data = array(
            'entity_id' => $request->entity_id,
            'cover' => $cover_name,
            'Logo' => $Logo_name,
            'Address' => $request->Address
        );

        $profile->update($form_data);

        return redirect('/admin/profiles')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified profile from storage.
     *
     * @param Profile  profile
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Profile $profile)
    {

        $profile->delete();

        return redirect('/admin/profiles')
            ->with('success', 'Data deleted successfully');

    }
}
