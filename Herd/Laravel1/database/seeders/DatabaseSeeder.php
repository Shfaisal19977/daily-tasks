<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Database\Factories\TaskFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Project::factory()
            ->count(3)
            ->hasTasks(
                TaskFactory::new()
                    ->count(3)
                    ->hasComments(2)
            )
            ->create();
    }
}
