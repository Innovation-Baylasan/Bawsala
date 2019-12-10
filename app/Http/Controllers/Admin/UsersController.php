<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = User::latest()->paginate(5);

        // dd($data);

        return view('admin.users.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
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
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $form_data = array(
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        );

        User::create($form_data);

        return redirect('/admin/users')
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

        $data = User::findOrFail($id);

        return View('admin.users.show', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('data'), compact('roles'));

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
            'name' => 'required',
            'role_id' => 'required'
        ]);

        // find the user
        $user = User::find($id);
        // check if email changed on update opreation and make sure the email is not taken by validation rules
        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'required|email|unique:users'
            ]);
        }

        $form_data = array(
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email
        );

        User::whereId($id)->update($form_data);

        return redirect('/admin/users')
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
        $data = User::findOrFail($id);
        $data->delete();

        return redirect('/admin/users')
            ->with('success', 'Data deleted successfully');
    }
}
