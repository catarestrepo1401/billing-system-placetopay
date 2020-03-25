<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'status'           => $faker->randomElement(['approved', 'pending', 'rejected', 'failed']),
        'identifier'       => $faker->randomNumber(8),
        'method'           => $faker->randomElement(['place_to_pay', 'debit_card', 'credit_card', 'cash', 'bank_payment', 'pse', 'pay_fees', 'bank_check', 'electronic_transfer', 'credit_note']),
        'amount'           => $faker->randomFloat(2, 1, 99999),

        'invoice_id'       => factory(\App\Models\Invoice::class)->create()->id,
        'customer_id'      => factory(\App\Models\User::class)->create()->id
    ];
});