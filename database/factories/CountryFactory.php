<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {
    return [
        'id' => 1,
        'code' => $faker->word,
        'name' => $faker->name,
    ];
});
