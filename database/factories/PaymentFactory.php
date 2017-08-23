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
$factory->define(App\Payment::class, function (Faker\Generator $faker) {

    $expense_id = $faker->numberBetween(1, \App\Expense::count());

    $expense = \App\Expense::find($expense_id);
    $maxAmount = $expense->amount;
    $amount = $faker->numberBetween(1, $maxAmount);

    while($expense->sumPayments() + $amount >  $maxAmount)
    {
        $amount = $faker->numberBetween(1, $maxAmount);
    }

    return [
        'expense_id' => $expense_id,
        'amount' => $amount,
    ];
});
