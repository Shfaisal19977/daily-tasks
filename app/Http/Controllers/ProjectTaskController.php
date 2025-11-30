<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

/**
 * @group Tasks
 */
class ProjectTaskController extends Controller
{
    /**
     * Get all tasks for a project
     *
     * @urlParam project integer required The ID of the project. Example: 1
     *
     * @response 200 [{"id": 1, "project_id": 1, "title": "Design Homepage", "details": "Create mockup", "status": "in_progress", "priority": "high", "due_date": "2025-01-15", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}]
     * @response 404 {"message": "No query results for model [App\\Models\\Project] 1"}
     */
    public function index(Project $project): JsonResponse
    {
        $tasks = $project->tasks()
            ->latest()
            ->get();

        return response()->json($tasks);
    }

    /**
     * Create a new task in a project
     *
     * @urlParam project integer required The ID of the project. Example: 1
     *
     * @bodyParam title string required The task title. Example: Design Homepage
     * @bodyParam details string The task details. Example: Create new homepage design mockup
     * @bodyParam status string required The task status. Example: in_progress
     * @bodyParam priority string required The task priority. Example: high
     * @bodyParam due_date date The task due date. Example: 2025-01-15
     *
     * @response 201 {"id": 1, "project_id": 1, "title": "Design Homepage", "details": "Create mockup", "status": "in_progress", "priority": "high", "due_date": "2025-01-15", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "No query results for model [App\\Models\\Project] 1"}
     * @response 422 {"message": "The title field is required."}
     */
    public function store(StoreTaskRequest $request, Project $project): JsonResponse
    {
        $task = $project->tasks()->create($request->validated());

        return response()->json($task, 201);
    }

    /**
     * Update a task
     *
     * @urlParam project integer required The ID of the project. Example: 1
     * @urlParam task integer required The ID of the task. Example: 1
     *
     * @bodyParam title string The task title. Example: Design Homepage
     * @bodyParam details string The task details. Example: Create new homepage design mockup
     * @bodyParam status string The task status. Example: in_progress
     * @bodyParam priority string The task priority. Example: high
     * @bodyParam due_date date The task due date. Example: 2025-01-15
     *
     * @response 200 {"id": 1, "project_id": 1, "title": "Design Homepage", "details": "Create mockup", "status": "in_progress", "priority": "high", "due_date": "2025-01-15", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "Not Found"}
     * @response 422 {"message": "The status must be a string."}
     */
    public function update(UpdateTaskRequest $request, Project $project, Task $task): JsonResponse
    {
        abort_if($task->project_id !== $project->id, 404);

        $task->update($request->validated());

        return response()->json($task);
    }
}
