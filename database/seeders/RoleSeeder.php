<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'Admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'Head of Research'
        ]);

        DB::table('roles')->insert([
            'name' => 'Research Manager'
        ]);

        DB::table('roles')->insert([
            'name' => 'Scripter'
        ]);

        DB::table('roles')->insert([
            'name' => 'Agent'
        ]);

        DB::table('roles')->insert([
            'name' => 'Client'
        ]);

    }
}
