<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$places = json_decode(File::get(app_path('../places.json')));

$factory->define(Event::class, function (Faker $faker) use ($places) {

    return [
        'creator_id' => factory('App\User'),
        'name' => $faker->name,
        'registration_link' => 'https://laravel.com/docs/5.8/migrations#creating-tables',
        'description' => $faker->paragraph,
        'start_datetime' => $faker->dateTime,
        'end_datetime' => $faker->dateTime,
        'latitude' => $places[array_rand($places)]->location->latitude,
        'longitude' => $places[array_rand($places)]->location->longitude
    ];
});
