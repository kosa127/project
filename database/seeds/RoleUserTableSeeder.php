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
            $user_id = $faker->numberBetween(1, \App\User::count());
            $user = \App\User::find($user_id);

            $role_id = $faker->numberBetween(1, \App\Role::count());
            $role = \App\Role::find($role_id);


            while($user->hasRole($role->name))
            {
                $user_id = $faker->numberBetween(1, \App\User::count());
                $user = \App\User::find($user_id);
            }

            $user->addRole($role);
        }
    }
}
