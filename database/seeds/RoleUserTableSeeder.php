<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(1, \App\User::count()) as $index)
        {
            DB::table('role_user')->insert([
                'role_id' => rand(1,\App\Role::count()),
                'user_id' => $faker->numberBetween(1, \App\User::count())
            ]);
        }
    }
}
