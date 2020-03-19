<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->randomNumber(5),
        'type' => $faker->randomElement(['product', 'service']),
        'name' => $faker->unique()->numerify('Item ###'),
        'price' => $faker->randomFloat(2, 1, 99999)
    ];
});
