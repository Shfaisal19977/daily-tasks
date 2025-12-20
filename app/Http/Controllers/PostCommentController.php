<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostCommentRequest;
use App\Http\Requests\UpdatePostCommentRequest;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'PostComments',
    description: 'Post comment management endpoints'
)]
class PostCommentController extends Controller
{
    #[OA\Get(
        path: '/api/posts/{post}/comments',
        summary: 'Get all comments for a specific post',
        tags: ['PostComments'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'per_page',
                in: 'query',
                required: false,
                description: 'Number of items per page',
                schema: new OA\Schema(type: 'integer', default: 15)
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                description: 'Page number',
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Paginated list of comments',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/PostComment')),
                        new OA\Property(property: 'current_page', type: 'integer', example: 1),
                        new OA\Property(property: 'per_page', type: 'integer', example: 15),
                        new OA\Property(property: 'total', type: 'integer', example: 50),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Post not found'),
        ]
    )]
    public function index(Post $post): JsonResponse|View
    {
        $perPage = request()->get('per_page', 15);
        $comments = PostComment::query()
            ->where('post_id', $post->id)
            ->with(['user', 'post'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($this->wantsJson()) {
            return response()->json($comments);
        }

        return view('post-comments.index', compact('post', 'comments'));
    }

    #[OA\Post(
        path: '/api/posts/{post}/comments',
        summary: 'Create a new comment on a post',
        description: 'Creates a new comment for a specific post',
        tags: ['PostComments'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Comment data',
            content: new OA\JsonContent(
                example: [
                    'content' => 'This is a great post!',
                    'user_id' => 1,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Comment created successfully'
            ),
            new OA\Response(response: 404, description: 'Post not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function create(Post $post): View
    {
        $users = User::all();
        return view('post-comments.create', compact('post', 'users'));
    }

    public function store(StorePostCommentRequest $request, Post $post): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $validated['post_id'] = $post->id;
        
        $comment = PostComment::query()->create($validated);
        $comment->load(['user', 'post']);

        if ($this->wantsJson()) {
            return response()->json($comment, 201);
        }

        return redirect()->route('posts.comments.index', $post)->with('success', 'Comment created successfully.');
    }

    #[OA\Get(
        path: '/api/posts/{post}/comments/{comment}',
        summary: 'Get a single comment from a post',
        tags: ['PostComments'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
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
                description: 'Comment details'
            ),
            new OA\Response(response: 404, description: 'Post or Comment not found'),
        ]
    )]
    public function show(Post $post, PostComment $comment): JsonResponse|View
    {
        abort_if($comment->post_id !== $post->id, 404);
        $comment->load(['user', 'post']);

        if ($this->wantsJson()) {
            return response()->json($comment);
        }

        return view('post-comments.show', compact('post', 'comment'));
    }

    #[OA\Put(
        path: '/api/posts/{post}/comments/{comment}',
        summary: 'Update a comment on a post',
        tags: ['PostComments'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
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
                description: 'Comment updated successfully'
            ),
            new OA\Response(response: 404, description: 'Post or Comment not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    #[OA\Patch(
        path: '/api/posts/{post}/comments/{comment}',
        summary: 'Partially update a comment on a post',
        tags: ['PostComments'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
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
                description: 'Comment updated successfully'
            ),
        ]
    )]
    public function edit(Post $post, PostComment $comment): View
    {
        abort_if($comment->post_id !== $post->id, 404);
        $users = User::all();
        return view('post-comments.edit', compact('post', 'comment', 'users'));
    }

    public function update(UpdatePostCommentRequest $request, Post $post, PostComment $comment): JsonResponse|RedirectResponse
    {
        abort_if($comment->post_id !== $post->id, 404);
        
        $comment->update($request->validated());
        $comment->load(['user', 'post']);

        if ($this->wantsJson()) {
            return response()->json($comment);
        }

        return redirect()->route('posts.comments.index', $post)->with('success', 'Comment updated successfully.');
    }

    #[OA\Delete(
        path: '/api/posts/{post}/comments/{comment}',
        summary: 'Delete a comment from a post',
        tags: ['PostComments'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
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
                description: 'Comment deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Comment deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Post or Comment not found'),
        ]
    )]
    public function destroy(Post $post, PostComment $comment): JsonResponse|RedirectResponse
    {
        abort_if($comment->post_id !== $post->id, 404);
        
        $comment->delete();

        if ($this->wantsJson()) {
            return response()->json(['message' => 'Comment deleted successfully'], 200);
        }

        return redirect()->route('posts.comments.index', $post)->with('success', 'Comment deleted successfully.');
    }
}
