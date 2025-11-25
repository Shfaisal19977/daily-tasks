<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Project;
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
}
