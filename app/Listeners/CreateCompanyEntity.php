<?php

namespace App\Listeners;

use App\Entity;
use App\Events\CompanyRegistered;


class CreateCompanyEntity
{
    /**
     * Handle the event.
     *
     * @param  CompanyRegistered $event
     * @return void
     */
    public function handle(CompanyRegistered $event)
    {
        $user = $event->user;

        list($latitude, $longitude) = explode(',', request('location'));
        $user->entities()->create([
            'name' => $user->name,
            'category_id' => request('category'),
            'description' => request('description'),
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
