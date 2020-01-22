<?php

namespace App\Listeners;

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
    public function handle($event)
    {
        if ($event->user->role = 'company') {
            $location = request('location');
            list($latitude, $longitude) = explode(',', $location);
            $event->user->entities()->create([
                'name' => $event->user->name,
                'category_id' => request('category'),
                'description' => request('description'),
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }
    }
}
