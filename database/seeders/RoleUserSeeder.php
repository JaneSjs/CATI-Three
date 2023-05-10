<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $roles = Role::all();

        // User::all()->each(function ($user) use ($roles)
        // {
        //     $user->roles()->attach(
        //         $roles->random(1)->pluck('id')
        //     );
        // });

        User::all()->each(function ($user)
        {
            // Seeded Users to default to Admin Role i.e role id of 1
            $user->roles()->attach(1);
        });
    }
}
