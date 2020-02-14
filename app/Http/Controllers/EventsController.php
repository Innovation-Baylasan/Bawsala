<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;

class EventsController extends Controller
{
    public function store(EventRequest $request)
    {
        $attributes = $request->validated();

        auth()->user()
            ->events()
            ->create($attributes);

        return response([
            'message' => 'your entity has been created, it will be visable to others when it\'s approved'
        ], 201);
    }
}
