<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'superuser',
                'display_name' => 'Developer',
                'description' => 'User has access to all system functionality'
            ],
            [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'User has access only to user management functionality'
            ],
            [
                'name' => 'guest',
                'display_name' => 'Guest',
                'description' => 'Pending user. User can just read informations system.'
            ]
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }

        // Add Permissions To Roles

        foreach (Permission::all() as $key => $value) {
            $superuser_permissions = Role::where('name', 'superuser')->first()->attachPermission($value);
        }

        foreach (Permission::all() as $key => $value) {
            if($value !== 'users'){
                $administrator_permissions = Role::where('name', 'administrator')->first()->attachPermission($value);
            }
        }

        foreach (Permission::all() as $key => $value) {
            if($value == 'read'){
                $guest_permissions = Role::where('name', 'guest')->first()->attachPermission($value);
            }
        }
    }
}
