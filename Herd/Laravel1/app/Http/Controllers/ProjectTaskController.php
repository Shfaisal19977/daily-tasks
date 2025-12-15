<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ProjectTaskController as ApiProjectTaskController;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Tasks',
    description: 'Task management endpoints within projects'
)]
class ProjectTaskController extends Controller
{
    public function __construct(
        private readonly ApiProjectTaskController $apiController
    ) {}

    #[OA\Get(
        path: '/api/projects/{project}/tasks',
        summary: 'Get all tasks for a specific project',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of tasks',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Task')
                )
            ),
            new OA\Response(response: 404, description: 'Project not found'),
        ]
    )]
    public function index(Project $project): View
    {
        $response = $this->apiController->index($project);
        $tasks = json_decode($response->getContent(), true);

        return view('tasks.index', compact('project', 'tasks'));
    }

    #[OA\Post(
        path: '/api/projects/{project}/tasks',
        summary: 'Create a new task in a project',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Task data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/StoreTaskRequest',
                example: [
                    'title' => 'Implement User Authentication',
                    'details' => 'Implement JWT-based authentication with refresh tokens and password reset functionality',
                    'status' => 'in_progress',
                    'priority' => 'high',
                    'due_date' => '2025-02-15',
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Task created successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Task')
            ),
            new OA\Response(response: 404, description: 'Project not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function create(Project $project): View
    {
        return view('tasks.create', compact('project'));
    }

    public function store(StoreTaskRequest $request, Project $project): RedirectResponse
    {
        $this->apiController->store($request, $project);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task created successfully.');
    }

    #[OA\Get(
        path: '/api/projects/{project}/tasks/{task}',
        summary: 'Get a single task from a project',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Task details',
                content: new OA\JsonContent(ref: '#/components/schemas/Task')
            ),
            new OA\Response(response: 404, description: 'Project or Task not found'),
        ]
    )]
    public function show(Project $project, Task $task): View
    {
        $response = $this->apiController->show($project, $task);
        $taskData = json_decode($response->getContent(), true);

        return view('tasks.show', compact('project', 'task'));
    }

    #[OA\Put(
        path: '/api/projects/{project}/tasks/{task}',
        summary: 'Update a task in a project',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'Design Homepage'),
                    new OA\Property(property: 'details', type: 'string', example: 'Create new homepage design mockup'),
                    new OA\Property(property: 'status', type: 'string', example: 'in_progress'),
                    new OA\Property(property: 'priority', type: 'string', example: 'high'),
                    new OA\Property(property: 'due_date', type: 'string', format: 'date', example: '2025-01-15'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Task updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Task')
            ),
            new OA\Response(response: 404, description: 'Project or Task not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    #[OA\Patch(
        path: '/api/projects/{project}/tasks/{task}',
        summary: 'Partially update a task in a project',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'Design Homepage'),
                    new OA\Property(property: 'details', type: 'string', example: 'Create new homepage design mockup'),
                    new OA\Property(property: 'status', type: 'string', example: 'in_progress'),
                    new OA\Property(property: 'priority', type: 'string', example: 'high'),
                    new OA\Property(property: 'due_date', type: 'string', format: 'date', example: '2025-01-15'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Task updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Task')
            ),
            new OA\Response(response: 404, description: 'Project or Task not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function edit(Project $project, Task $task): View
    {
        abort_if($task->project_id !== $project->id, 404);

        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task): RedirectResponse
    {
        $this->apiController->update($request, $project, $task);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task updated successfully.');
    }

    #[OA\Delete(
        path: '/api/projects/{project}/tasks/{task}',
        summary: 'Delete a task from a project',
        tags: ['Tasks'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Task deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Task deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Project or Task not found'),
        ]
    )]
    public function destroy(Project $project, Task $task): RedirectResponse
    {
        $this->apiController->destroy($project, $task);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task deleted successfully.');
    }
}
