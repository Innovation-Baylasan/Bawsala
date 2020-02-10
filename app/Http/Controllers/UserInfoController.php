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
            'old_password' => 'sometimes|required',
            'password' => 'required_unless:old_password,|confirmed',
        ]);



        if (request()->has('old_password')) {
            if (!(Hash::check(request('old_password'), auth()->user()->getAuthPassword()))) {
                $errors = new MessageBag(['old_password' => 'old password dose not match our records']);
                return response()->json(['errors' => $errors], 422);
            };

            $attributes['password'] = Hash::make($attributes['password']);
        }

        auth()->user()->update($attributes);

        return response('user updated successfully');
    }
}
