<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UserInfoController extends Controller
{
    public function update()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'sometimes|confirmed',
        ]);


        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        auth()->user()->update($attributes);

        return response('User updated successfully');
    }
}
