<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskCommentController extends Controller
{
    public function index(Task $task): JsonResponse
    {
        $task->load('project');
        $comments = $task->comments()
            ->latest()
            ->get();

        return response()->json($comments);
    }

    public function store(StoreCommentRequest $request, Task $task): JsonResponse
    {
        $comment = $task->comments()->create($request->validated());

        return response()->json($comment, 201);
    }

    public function show(Task $task, Comment $comment): JsonResponse
    {
        abort_if($comment->task_id !== $task->id, 404);
        $comment->load('task.project');

        return response()->json($comment);
    }

    public function update(UpdateCommentRequest $request, Task $task, Comment $comment): JsonResponse
    {
        abort_if($comment->task_id !== $task->id, 404);

        $comment->update($request->validated());

        return response()->json($comment);
    }

    public function destroy(Task $task, Comment $comment): Response
    {
        abort_if($comment->task_id !== $task->id, 404);

        $comment->delete();

        return response()->noContent();
    }
}
