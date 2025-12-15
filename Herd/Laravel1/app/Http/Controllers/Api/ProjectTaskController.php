<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class ProjectTaskController extends Controller
{
    public function index(Project $project): JsonResponse
    {
        $tasks = $project->tasks()
            ->latest()
            ->get();

        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $request, Project $project): JsonResponse
    {
        $task = $project->tasks()->create($request->validated());

        return response()->json($task, 201);
    }

    public function show(Project $project, Task $task): JsonResponse
    {
        abort_if($task->project_id !== $project->id, 404);
        $task->load('comments');

        return response()->json($task);
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task): JsonResponse
    {
        abort_if($task->project_id !== $project->id, 404);

        $task->update($request->validated());

        return response()->json($task);
    }

    public function destroy(Project $project, Task $task): JsonResponse
    {
        abort_if($task->project_id !== $project->id, 404);

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
