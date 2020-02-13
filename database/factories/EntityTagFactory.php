<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EntityTag;
use Faker\Generator as Faker;

$factory->define(EntityTag::class, function (Faker $faker) {
    return [
        'entity_id' => factory('App\Entity'),
        'tag_id' => factory('App\Tag'),
    ];
});
