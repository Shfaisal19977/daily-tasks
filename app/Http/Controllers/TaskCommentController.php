<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @group Comments
 */
class TaskCommentController extends Controller
{
    /**
     * Get all comments for a task
     *
     * @urlParam task integer required The ID of the task. Example: 1
     *
     * @response 200 [{"id": 1, "task_id": 1, "comment_text": "This looks great!", "author": "John Doe", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}]
     * @response 404 {"message": "No query results for model [App\\Models\\Task] 1"}
     */
    public function index(Task $task): JsonResponse
    {
        $comments = $task->comments()
            ->latest()
            ->get();

        return response()->json($comments);
    }

    /**
     * Create a new comment on a task
     *
     * @urlParam task integer required The ID of the task. Example: 1
     *
     * @bodyParam comment_text string required The comment text. Example: This looks great! Let's proceed with this design.
     * @bodyParam author string required The comment author. Example: John Doe
     *
     * @response 201 {"id": 1, "task_id": 1, "comment_text": "This looks great!", "author": "John Doe", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "No query results for model [App\\Models\\Task] 1"}
     * @response 422 {"message": "The comment_text field is required."}
     */
    public function store(StoreCommentRequest $request, Task $task): JsonResponse
    {
        $comment = $task->comments()->create($request->validated());

        return response()->json($comment, 201);
    }

    /**
     * Update a comment
     *
     * @urlParam task integer required The ID of the task. Example: 1
     * @urlParam comment integer required The ID of the comment. Example: 1
     *
     * @bodyParam comment_text string The comment text. Example: This looks great! Let's proceed with this design.
     * @bodyParam author string The comment author. Example: John Doe
     *
     * @response 200 {"id": 1, "task_id": 1, "comment_text": "This looks great!", "author": "John Doe", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "Not Found"}
     * @response 422 {"message": "The comment_text must be a string."}
     */
    public function update(UpdateCommentRequest $request, Task $task, Comment $comment): JsonResponse
    {
        abort_if($comment->task_id !== $task->id, 404);

        $comment->update($request->validated());

        return response()->json($comment);
    }

    /**
     * Delete a comment
     *
     * @urlParam task integer required The ID of the task. Example: 1
     * @urlParam comment integer required The ID of the comment. Example: 1
     *
     * @response 204
     * @response 404 {"message": "Not Found"}
     */
    public function destroy(Task $task, Comment $comment): Response
    {
        abort_if($comment->task_id !== $task->id, 404);

        $comment->delete();

        return response()->noContent();
    }
}
