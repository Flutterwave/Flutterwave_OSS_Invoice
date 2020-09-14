<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    return [
        'item' => $faker->word,
        'quantity' => $faker->randomNumber(),
        'unit_price' => $faker->randomFloat(),
        'invoice_id' => $faker->randomNumber(),
    ];
});
