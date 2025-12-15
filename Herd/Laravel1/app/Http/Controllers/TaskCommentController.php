<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\TaskCommentController as ApiTaskCommentController;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Comments',
    description: 'Comment management endpoints on tasks'
)]
class TaskCommentController extends Controller
{
    public function __construct(
        private readonly ApiTaskCommentController $apiController
    ) {}

    #[OA\Get(
        path: '/api/tasks/{task}/comments',
        summary: 'Get all comments for a specific task',
        tags: ['Comments'],
        parameters: [
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
                description: 'List of comments',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Comment')
                )
            ),
            new OA\Response(response: 404, description: 'Task not found'),
        ]
    )]
    public function index(Task $task): View
    {
        $response = $this->apiController->index($task);
        $comments = json_decode($response->getContent(), true);

        return view('comments.index', compact('task', 'comments'));
    }

    #[OA\Post(
        path: '/api/tasks/{task}/comments',
        summary: 'Create a new comment on a task',
        tags: ['Comments'],
        parameters: [
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
            description: 'Comment data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/StoreCommentRequest',
                example: [
                    'comment_text' => 'This implementation looks solid. We should test it thoroughly before deployment.',
                    'author' => 'Jane Smith',
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Comment created successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Comment')
            ),
            new OA\Response(response: 404, description: 'Task not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function create(Task $task): View
    {
        $task->load('project');

        return view('comments.create', compact('task'));
    }

    public function store(StoreCommentRequest $request, Task $task): RedirectResponse
    {
        $this->apiController->store($request, $task);

        return redirect()->route('tasks.comments.index', $task)->with('success', 'Comment created successfully.');
    }

    #[OA\Get(
        path: '/api/tasks/{task}/comments/{comment}',
        summary: 'Get a single comment from a task',
        tags: ['Comments'],
        parameters: [
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'comment',
                in: 'path',
                required: true,
                description: 'Comment ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Comment details',
                content: new OA\JsonContent(ref: '#/components/schemas/Comment')
            ),
            new OA\Response(response: 404, description: 'Task or Comment not found'),
        ]
    )]
    public function show(Task $task, Comment $comment): View
    {
        $response = $this->apiController->show($task, $comment);
        $commentData = json_decode($response->getContent(), true);

        return view('comments.show', compact('task', 'comment'));
    }

    #[OA\Put(
        path: '/api/tasks/{task}/comments/{comment}',
        summary: 'Update a comment on a task',
        tags: ['Comments'],
        parameters: [
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'comment',
                in: 'path',
                required: true,
                description: 'Comment ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'comment_text', type: 'string', example: 'This looks great! Let\'s proceed with this design.'),
                    new OA\Property(property: 'author', type: 'string', example: 'John Doe'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Comment updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Comment')
            ),
            new OA\Response(response: 404, description: 'Task or Comment not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    #[OA\Patch(
        path: '/api/tasks/{task}/comments/{comment}',
        summary: 'Partially update a comment on a task',
        tags: ['Comments'],
        parameters: [
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'comment',
                in: 'path',
                required: true,
                description: 'Comment ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'comment_text', type: 'string', example: 'This looks great! Let\'s proceed with this design.'),
                    new OA\Property(property: 'author', type: 'string', example: 'John Doe'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Comment updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Comment')
            ),
            new OA\Response(response: 404, description: 'Task or Comment not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function edit(Task $task, Comment $comment): View
    {
        abort_if($comment->task_id !== $task->id, 404);
        $task->load('project');

        return view('comments.edit', compact('task', 'comment'));
    }

    public function update(UpdateCommentRequest $request, Task $task, Comment $comment): RedirectResponse
    {
        $this->apiController->update($request, $task, $comment);

        return redirect()->route('tasks.comments.index', $task)->with('success', 'Comment updated successfully.');
    }

    #[OA\Delete(
        path: '/api/tasks/{task}/comments/{comment}',
        summary: 'Delete a comment from a task',
        tags: ['Comments'],
        parameters: [
            new OA\Parameter(
                name: 'task',
                in: 'path',
                required: true,
                description: 'Task ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'comment',
                in: 'path',
                required: true,
                description: 'Comment ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: 'Comment deleted successfully'
            ),
            new OA\Response(response: 404, description: 'Task or Comment not found'),
        ]
    )]
    public function destroy(Task $task, Comment $comment): RedirectResponse
    {
        $this->apiController->destroy($task, $comment);

        return redirect()->route('tasks.comments.index', $task)->with('success', 'Comment deleted successfully.');
    }
}
