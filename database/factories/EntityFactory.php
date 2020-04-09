<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$places = json_decode(File::get(app_path('../places.json')));

$factory->define(Entity::class, function (Faker $faker) use ($places) {
    return [
        'category_id' => factory('App\Category'),
        'user_id' => factory('App\User'),
        'name' => $places[array_rand($places)]->name,
        'description' => $faker->paragraph,
        'details' => $faker->randomHtml,
        'verified' => true,
        'latitude' => $places[array_rand($places)]->location->latitude,
        'longitude' => $places[array_rand($places)]->location->longitude
    ];
});
