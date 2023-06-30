<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Management Project #1',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $existProject = Project::where('name', $data['name'])->first();

        if (!$existProject) {
            Project::create($data);
        }
    }
}
