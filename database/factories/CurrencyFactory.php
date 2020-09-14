<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Currency::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => 'Nigerian Naira',
        'iso' => 'NGN',
    ];
});
