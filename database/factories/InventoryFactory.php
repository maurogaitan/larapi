<?php

use Faker\Generator as Faker;

$factory->define(App\Inventory::class, function (Faker $faker) {
    return [
        'item' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'quantity_at_hand' => $faker->numberBetween($min = 100, $max = 900),
        'price' => $faker->numberBetween($min = 100, $max = 900),
    ];
});