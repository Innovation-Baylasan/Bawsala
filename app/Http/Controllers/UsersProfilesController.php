<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersProfilesController extends Controller
{
    public function index()
    {
        $user = auth()->user();


        return redirect($user->profilePath());
    }

    public function show(User $user)
    {
        return redirect("/@{$user->entities()->first()->id}");
    }
}
