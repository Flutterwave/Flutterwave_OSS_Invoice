<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ShippingFee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'amount' => $faker->word,
        'desc' => $faker->word,
        'user_id' => $faker->randomNumber(),
    ];
});
