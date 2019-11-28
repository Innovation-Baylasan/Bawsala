<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'company_id' => factory('App\Company')->create()->id,
        'category_id' => factory('App\Category')->create()->id,
        'name' => $faker->company,
        'description' => $faker->paragraph,
        'location'=> [
            'lat'=>$faker->latitude,
            'long'=>$faker->longitude
        ]
    ];
});
