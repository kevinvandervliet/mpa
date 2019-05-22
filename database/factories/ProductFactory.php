<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text,
        'catagory' => App\Catagory::all()->random()->title,
        'price' => $faker->randomNumber(2),
        'amount' => 1,
    ];
});
