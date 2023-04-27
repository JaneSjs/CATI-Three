<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Kenneth',
            'last_name' => 'Kipchumba',
            'email' => 'kipchumba.kenneth@ymail.com',
            'password' => Hash::make('password')
        ]);
    }
}
