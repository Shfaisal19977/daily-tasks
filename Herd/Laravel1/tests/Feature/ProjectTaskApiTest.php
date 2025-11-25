<?php

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists projects with nested tasks and comments', function () {
    Project::factory()
        ->count(2)
        ->hasTasks(
            Task::factory()
                ->count(1)
                ->hasComments(1)
        )
        ->create();

    $response = $this->getJson('/api/projects');

    $response->assertSuccessful()
        ->assertJsonCount(2)
        ->assertJsonStructure([
            '*' => [
                'id',
                'tasks' => [
                    '*' => [
                        'id',
                        'comments',
                    ],
                ],
            ],
        ]);
});

it('creates a project via the api', function () {
    $payload = [
        'name' => 'New Project',
        'description' => 'Testing creation',
        'start_date' => '2025-11-01',
        'end_date' => '2025-12-01',
        'status' => 'planned',
    ];

    $response = $this->postJson('/api/projects', $payload);

    $response->assertCreated()
        ->assertJsonFragment(['name' => 'New Project']);

    $this->assertDatabaseHas('projects', ['name' => 'New Project']);
});

it('creates a task for a project', function () {
    $project = Project::factory()->create();

    $payload = [
        'title' => 'Kickoff',
        'details' => 'Do kickoff call',
        'status' => 'pending',
        'priority' => 'high',
        'due_date' => now()->addWeek()->toDateString(),
    ];

    $response = $this->postJson("/api/projects/{$project->id}/tasks", $payload);

    $response->assertCreated()
        ->assertJsonFragment(['title' => 'Kickoff']);

    $this->assertDatabaseHas('tasks', [
        'project_id' => $project->id,
        'title' => 'Kickoff',
    ]);
});

it('manages task comments', function () {
    $task = Task::factory()->create();

    $createResponse = $this->postJson("/api/tasks/{$task->id}/comments", [
        'comment_text' => 'Looks good',
        'author' => 'Faisa',
    ]);

    $createResponse->assertCreated();

    $commentId = $createResponse->json('id');

    $this->getJson("/api/tasks/{$task->id}/comments")
        ->assertSuccessful()
        ->assertJsonFragment(['comment_text' => 'Looks good']);

    $this->deleteJson("/api/tasks/{$task->id}/comments/{$commentId}")
        ->assertNoContent();

    $this->assertDatabaseMissing('comments', ['id' => $commentId]);
});
