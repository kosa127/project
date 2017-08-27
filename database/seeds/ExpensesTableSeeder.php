<?php

use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creating some expenses without owners (only for test)
        $faker = \Faker\Factory::create();

        for($i = 0; $i <= 15; $i++)
        {
            $expense = new \App\Expense();
            $expense->name = $faker->words($nb = 3, $asText = true);
            $expense->amount = $faker->numberBetween(1,500);
            $expense->save();
        }

        //creating expenses with owners
        factory(App\Expense::class, 40)->create();

    }
}
