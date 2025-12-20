<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all projects or create some if none exist
        $projects = Project::all();
        
        if ($projects->isEmpty()) {
            $projects = \App\Models\Project::factory(100)->create();
        }

        $projectIds = $projects->pluck('id')->toArray();

        // Create 1000 tasks distributed across projects
        for ($i = 0; $i < 1000; $i++) {
            \App\Models\Task::factory()->create([
                'project_id' => $projectIds[array_rand($projectIds)],
            ]);
        }
    }
}
