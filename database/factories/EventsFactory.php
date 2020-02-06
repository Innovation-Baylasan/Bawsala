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
        'link' => 'https://laravel.com/docs/5.8/migrations#creating-tables',
        'description' => $faker->paragraph,
        'start_date' => $faker->dateTime,
        'end_date' => $faker->dateTime,
        'latitude' => $places[array_rand($places)]->location->latitude,
        'longitude' => $places[array_rand($places)]->location->longitude
    ];
});
