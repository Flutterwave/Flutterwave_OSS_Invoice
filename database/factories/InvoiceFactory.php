<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Invoice::class, function (Faker $faker) {
    return [
        'ref' => $faker->word,
        'currency_id' => 1,
        'to_email' => $faker->word,
        'cc_emails' => $faker->text,
        'customer_id' => $faker->randomNumber(),
        'notes' => $faker->text,
        'status' => $faker->word,
        'due_date' => $faker->date(),
        'acc_name' => $faker->word,
        'bank' => $faker->word,
        'acc_num' => $faker->word,
        'shipping_fee' => $faker->randomFloat(),
        'discount' => $faker->randomFloat(),
        'tax' => $faker->randomFloat(),
        'user_id' => $faker->randomNumber(),
//        'paid_at' => $faker->date(),
//        'issued_at' => $faker->date(),
        'created_at' => $faker->date()
    ];
});
