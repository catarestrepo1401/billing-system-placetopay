<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InvoiceItem;
use Faker\Generator as Faker;

$factory->define(InvoiceItem::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(4),
        'quantity' => $faker->randomFloat(2, 1, 15),
        'unit_price' => $faker->randomFloat(2, 1, 9999),
        'total' => $faker->randomFloat(2, 100, $max = 99999),
        'item_id' => factory(\App\Models\Item::class)->create()->id,
        'invoice_id' => factory(\App\Models\Invoice::class)->create()->id
    ];
});
