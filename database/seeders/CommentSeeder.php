<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all tasks or create some if none exist
        $tasks = Task::all();
        
        if ($tasks->isEmpty()) {
            // Create projects first, then tasks
            $projects = \App\Models\Project::factory(100)->create();
            $projectIds = $projects->pluck('id')->toArray();
            
            for ($i = 0; $i < 500; $i++) {
                \App\Models\Task::factory()->create([
                    'project_id' => $projectIds[array_rand($projectIds)],
                ]);
            }
            
            $tasks = Task::all();
        }

        $taskIds = $tasks->pluck('id')->toArray();

        // Create 1000 comments distributed across tasks
        for ($i = 0; $i < 1000; $i++) {
            \App\Models\Comment::factory()->create([
                'task_id' => $taskIds[array_rand($taskIds)],
            ]);
        }
    }
}
