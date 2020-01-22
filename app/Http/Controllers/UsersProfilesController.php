<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersProfilesController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $destinations = [
            'company' => "/@{$user->entities()->first()->id}",
            'user' => "/account/{$user->username}",
            'admin' => "/account/{$user->username}",
        ];

        return redirect($destinations[$user->role]);
    }

    public function show(User $user)
    {
        if ($user->role == 'company') {
            return redirect("/@{$user->entities()->first()->id}");
        };

        return view('user-profile');
    }
}
