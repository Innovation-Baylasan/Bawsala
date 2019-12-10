<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity;
use App\Model;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(/**
 * @param Faker $faker
 * @return array
 */
    Profile::class, function (Faker $faker) {
    return [
        'entity_id' => factory(Entity::class)->create()->id,
        'cover' => 'https://placeimg.com/640/360/tech',
        'logo' => 'https://avatars.dicebear.com/v2/bottts/' . $faker->name . '.svg',
        'address' => $faker->address,
    ];
});
