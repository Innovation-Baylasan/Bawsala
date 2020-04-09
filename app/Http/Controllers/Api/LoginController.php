<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store()
    {
        $credentials = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return response([
                'data' => [
                    'user' => $user = auth()->user(),
                    'token' => $user->token,
                ],
                'message' => 'login successfully'
            ], 200);
        }

        return response([
            'message' => 'wrong credentials'
        ], 403);
    }
}
