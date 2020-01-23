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
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'username' => $attributes['username'] ?? User::generateUsername($attributes['name']),
            'password' => Hash::make($attributes['password']),
            'role' => $attributes['registerAs'] ?? 'user',
        ]);

        return response([
            'data' => [
                'user' => $user,
                'token' => $user->token
            ],
            'message' => 'user registered successfully'
        ], 200);
    }
}
