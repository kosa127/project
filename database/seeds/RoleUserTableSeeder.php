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


        foreach(range(1, \App\User::count()/2) as $index)
        {
            $user_id = $faker->numberBetween(1, \App\User::count());
            $user = \App\User::find($user_id);

            $roleAdministrator = \App\Role::where('name', 'Administrator')->first();


            while($user->hasRole($roleAdministrator->name))
            {
                $user_id = $faker->numberBetween(1, \App\User::count());
                $user = \App\User::find($user_id);
            }

            $user->addRole($roleAdministrator);
        }
    }
}
