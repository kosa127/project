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

        foreach(range(1, 10) as $index) //\App\User::count()
        {
            DB::table('role_user')->insert([
                'role_id' => rand(1,2), //\App\Role::count()
                'user_id' => $faker->numberBetween(1, 10)  //\App\User::count()
            ]);
        }
    }
}
