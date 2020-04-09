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
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['user' => new User()]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);

        User::create($attributes);

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
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user)
    {


        $user->update(
            request()->validate([
                'name' => 'required|string',
                'role' => 'required|string',
                'email' => "required|email|unique:users:email:$user->email",
            ])
        );

        return redirect('/admin/users')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
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
