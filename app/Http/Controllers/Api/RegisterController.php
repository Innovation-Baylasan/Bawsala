<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['sometimes', 'string', 'min:8', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'register_as' => ['sometimes', 'string'],
            'location' => ['sometimes', 'required', 'string', 'min:8'],
            'category' => ['sometimes', 'required', 'numeric', 'min:1'],
            'avatar' => ['sometimes'],
            'cover' => ['sometimes'],
            'description' => ['sometimes', 'required', 'string', 'min:8', 'max:500'],
        ]);

        $user = User::register([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'role' => $attributes['register_as'] ?? 'user',
        ]);

        return response([
            'data' => [
                'user' => $user,
                'token' => $user->token,
                'main_entity' => $user->isCompany() ? $user->mainEntity() : null
            ],
            'message' => 'user registered successfully'
        ], 200);
    }
}
