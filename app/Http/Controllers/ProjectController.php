<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

/**
 * @group Projects
 */
class ProjectController extends Controller
{
    /**
     * Get all projects
     *
     * @response 200 [{"id": 1, "name": "Website Redesign", "description": "Complete redesign", "start_date": "2025-01-01", "end_date": "2025-03-31", "status": "planned", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z", "tasks": []}]
     */
    public function index(): JsonResponse
    {
        $projects = Project::query()
            ->with('tasks.comments')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($projects);
    }

    /**
     * Create a new project
     *
     * @bodyParam name string required The project name. Example: Website Redesign
     * @bodyParam description string The project description. Example: Complete redesign of company website
     * @bodyParam start_date date The project start date. Example: 2025-01-01
     * @bodyParam end_date date The project end date. Example: 2025-03-31
     * @bodyParam status string The project status. Example: planned
     *
     * @response 201 {"id": 1, "name": "Website Redesign", "description": "Complete redesign", "start_date": "2025-01-01", "end_date": "2025-03-31", "status": "planned", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 422 {"message": "The name field is required."}
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = Project::query()->create($request->validated());

        return response()->json($project, 201);
    }

    /**
     * Update a project
     *
     * @urlParam project integer required The ID of the project. Example: 1
     *
     * @bodyParam name string The project name. Example: Website Redesign
     * @bodyParam description string The project description. Example: Complete redesign of company website
     * @bodyParam start_date date The project start date. Example: 2025-01-01
     * @bodyParam end_date date The project end date. Example: 2025-03-31
     * @bodyParam status string The project status. Example: planned
     *
     * @response 200 {"id": 1, "name": "Website Redesign", "description": "Complete redesign", "start_date": "2025-01-01", "end_date": "2025-03-31", "status": "planned", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "No query results for model [App\\Models\\Project] 1"}
     * @response 422 {"message": "The name must be a string."}
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return response()->json($project);
    }
}
