<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        User::all()->each(function ($user) use ($projects)
        {
            $user->projects()->attach(
                $projects->random(1)->pluck('id')
            );
        });
    }
}
