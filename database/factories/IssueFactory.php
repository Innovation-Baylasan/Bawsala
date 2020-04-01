<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Issue;
use Faker\Generator as Faker;

$factory->define(Issue::class, function (Faker $faker) {
    $statuses = ['reviewed', 'close', 'open'];
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'status' => $statuses[array_rand($statuses)]
    ];
});
