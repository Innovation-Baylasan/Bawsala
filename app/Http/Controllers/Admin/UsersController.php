<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::latest()->paginate(5);

        // dd($user);

        return view('admin.users.index', compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
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
     * Display the specified user.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return View('admin.users.show', compact('user'));

    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $roles = Role::all();

        return view('admin.users.edit', compact('user','roles'));

    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role_id' => 'required'
        ]);

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

        $user->update($form_data);

        return redirect('/admin/users')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/admin/users')
            ->with('success', 'Data deleted successfully');
    }
}
