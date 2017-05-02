<?php

use App\User;
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
        $administrator = User::create([
            'name' => 'Milos',
            'email' => 'milosharkor@hotmail.com',
            'password' => bcrypt('123456')
        ]);

        $superuser = User::create([
            'name' => 'Milos',
            'email' => 'developer@iaxe.dev',
            'password' => bcrypt('123456')
        ]);

        $guest = User::create([
            'name' => 'Somebody',
            'email' => 'guest@iaxe.dev',
            'password' => bcrypt('123456')
        ]);

        $superuser_role = \App\Role::find(1);
        $administrator_role = \App\Role::find(2);
        $guest_role = \App\Role::find(3);

        $superuser_user = User::where('email','milosharkor@hotmail.com')->first()->attachRole($administrator_role);
        $administrator_user = User::where('email','developer@iaxe.dev')->first()->attachRole($superuser_role);
        $guest_user = User::where('email','guest@iaxe.dev')->first()->attachRole($guest_role);

    }
}
