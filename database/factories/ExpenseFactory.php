<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Expense::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->words($nb = 3, $asText = true),
        'user_id' => $faker->numberBetween(1, \App\User::count()),
        'amount' => $faker->numberBetween(1,5000000),
    ];
});
