<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Customer::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->word,
        'city' => $faker->city,
        'state' => $faker->word,
        'country_id' => 1,
        'user_id' => '1',
        'created_at' => $faker->date()
    ];
});
