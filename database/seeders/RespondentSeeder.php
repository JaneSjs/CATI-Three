<?php

namespace Database\Seeders;

use App\Models\Respondent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RespondentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Respondent::factory()->count(100)->create();
    }
}
