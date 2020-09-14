<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'id' => 1,
        'f_name' => $faker->word,
        'l_name' => $faker->word,
        'phone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'country_id' => $faker->boolean,
        'created_at' => $faker->date('c'),
    ];
});
