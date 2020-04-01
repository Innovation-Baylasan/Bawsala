<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function store(EventRequest $request)
    {
        $attributes = $request->validated();

        $attributes['end_date'] = Carbon::parse($attributes['end_date']);
        $attributes['start_date'] = Carbon::parse($attributes['start_date']);
        auth()->user()
            ->events()
            ->create($attributes);

        return response([
            'message' => 'your entity has been created, it will be visable to others when it\'s approved'
        ], 201);
    }
}
