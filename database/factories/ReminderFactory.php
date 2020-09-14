<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Reminder::class, function (Faker $faker) {
    return [
        'date' => $faker->word,
        'invoice_id' => $faker->randomNumber(),
    ];
});
