<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'document_number' => $faker->numberBetween(10000, 99999),
        'document_type' => $faker->numberBetween(10, 20),
        'expired_at' => now()->addDays(rand(15, 30)),
        'delivery_at' => now()->addDays(rand(15, 30)),
        'subtotal' => $faker->randomFloat(2, 100, $max = 999999),
        'discount_rate' => $faker->numberBetween(0, 100),
        'discount' => $faker->randomFloat(2, 100, $max = 999999),
        'net' => $faker->randomFloat(2, 100, $max = 999999),
        'tax_rate' => $faker->numberBetween(0, 100),
        'tax' => $faker->randomFloat(2, 100, $max = 999999),
        'total' => $faker->randomFloat(2, 100, $max = 999999),
        'user_id' => factory(\App\Models\User::class)->create()->id,
        'customer_id' => factory(\App\Models\User::class)->create()->id
    ];
});
