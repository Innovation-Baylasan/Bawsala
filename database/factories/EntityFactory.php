<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity;
use Faker\Generator as Faker;

$factory->define(Entity::class, function (Faker $faker) {
    return [
        'category_id' => factory('App\Category'),
        'user_id' => factory('App\User'),
        'name' => $faker->company,
        'description' => $faker->paragraph,
        'location' => [
            'lat' => $faker->latitude,
            'long' => $faker->longitude
        ]
    ];
});
