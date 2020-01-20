<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$places = json_decode(File::get(app_path('../places.json')));

$factory->define(Event::class, function (Faker $faker) use ($places) {

    return [
        'creator_id' => factory('App\User'),
        'entity_id' => factory('App\Entity'),
        'event_name' => $faker->name,
        'event_picture' => 'https://media.sproutsocial.com/uploads/2018/04/Facebook-Cover-Photo-Size.png',
        'registration_link' => 'https://laravel.com/docs/5.8/migrations#creating-tables',
        'description' => $faker->paragraph,
        'application_start_datetime' => $faker->dateTime,
        'application_end_datetime' => $faker->dateTime,
        'latitude' => $places[array_rand($places)]->location->latitude,
        'longitude' => $places[array_rand($places)]->location->longitude
    ];
});
