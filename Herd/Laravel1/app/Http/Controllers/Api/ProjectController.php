<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::query()
            ->with('tasks.comments')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($projects);
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = Project::query()->create($request->validated());

        return response()->json($project, 201);
    }

    public function show(Project $project): JsonResponse
    {
        $project->load('tasks.comments');

        return response()->json($project);
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return response()->json($project);
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully'], 200);
    }
}
