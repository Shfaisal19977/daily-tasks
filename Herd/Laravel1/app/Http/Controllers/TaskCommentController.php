<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskCommentController extends Controller
{
    public function index(Task $task): JsonResponse
    {
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

    public function destroy(Task $task, Comment $comment): Response
    {
        abort_if($comment->task_id !== $task->id, 404);

        $comment->delete();

        return response()->noContent();
    }
}
