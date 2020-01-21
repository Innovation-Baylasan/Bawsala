<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRootEntityForCompanies
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($user)
    {
        if ($user->role->role = 'company') {
            $location = request('location');
            list($latitude, $longitude) = explode(',', $location);
            $user->entities()->create([
                'name' => $user->name,
                'category_id' => request('category'),
                'description' => request('description'),
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }
    }
}
