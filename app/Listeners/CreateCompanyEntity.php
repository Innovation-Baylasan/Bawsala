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

        $entity = $user->entities()->create([
            'name' => $user->name,
            'category_id' => request('category'),
            'description' => request('description'),
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        if ((request()->has('avatar'))) {
            $entity->profile->setAvatar(request('avatar'), 'image');
        };

        if ((request()->has('cover'))) {
            $entity->profile->setCover(request('cover'), 'image');
        }
    }
}
