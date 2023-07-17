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
        // System Admin
        DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => 'System Administrator'
        ]);

        // Head of Research
        DB::table('roles')->insert([
            'name' => 'Head',
            'description' => 'Head of Research'
        ]);

        // Project Manager
        DB::table('roles')->insert([
            'name' => 'Manager',
            'description' => 'Project Manager'
        ]);

        // Project Coordinator
        DB::table('roles')->insert([
            'name' => 'Coordinator',
            'description' => 'Project Coordinator'
        ]);

        // Survey Scripter
        DB::table('roles')->insert([
            'name' => 'Scripter',
            'description' => 'Survey Scripter'
        ]);

        // Survey Supervisor
        DB::table('roles')->insert([
            'name' => 'Supervisor',
            'description' => 'Survey Supervisor'
        ]);

        // Data Collection Agent
        DB::table('roles')->insert([
            'name' => 'Agent',
            'description' => 'Data Collection Agent'
        ]);

        // Quality Control
        DB::table('roles')->insert([
            'name' => 'QC',
            'description' => 'Quality Control Agent'
        ]);

        // Project Client.
        DB::table('roles')->insert([
            'name' => 'Client',
            'description' => 'Project Client'
        ]);

        // Respondent.
        DB::table('roles')->insert([
            'name' => 'Respondent',
            'description' => 'Survey Respondent'
        ]);

        // Coding.
        DB::table('roles')->insert([
            'name' => 'Coding',
            'description' => 'Coding'
        ]);

    }
}
