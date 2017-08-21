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

        $user = new \App\User();
        $user->name = "user";
        $user->email = "user@example.com";
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach(1);
        $user->roles()->attach(2);

        $user = new \App\User();
        $user->name = "user2";
        $user->email = "user2@example.com";
        $user->password = bcrypt('user2');
        $user->save();
        $user->roles()->attach(1);

        $user = new \App\User();
        $user->name = "user3";
        $user->email = "user3@example.com";
        $user->password = bcrypt('user3');
        $user->save();
        $user->roles()->attach(2);
    }
}
