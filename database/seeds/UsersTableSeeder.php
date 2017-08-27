<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create();

        //USER MADE FOR TESTS ONLY
        $user = new \App\User();
        $user->name = "user";
        $user->email = "user@example.com";
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach(1);

    }
}
