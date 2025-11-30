<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Books',
    description: 'Book management endpoints'
)]
class BookController extends Controller
{
    #[OA\Get(
        path: '/api/books',
        summary: 'Get all books',
        tags: ['Books'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of books',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Book')
                )
            ),
        ]
    )]
    public function index(): JsonResponse
    {
        $books = Book::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($books);
    }

    #[OA\Get(
        path: '/api/books/{book}',
        summary: 'Get a single book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book details',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 404, description: 'Book not found'),
        ]
    )]
    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    #[OA\Post(
        path: '/api/books',
        summary: 'Create a new book',
        tags: ['Books'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['title', 'author', 'publication_year'],
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'The Great Gatsby'),
                    new OA\Property(property: 'author', type: 'string', example: 'F. Scott Fitzgerald'),
                    new OA\Property(property: 'publication_year', type: 'integer', example: 1925),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Book created successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::query()->create($request->validated());

        return response()->json($book, 201);
    }

    #[OA\Put(
        path: '/api/books/{book}',
        summary: 'Update a book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'The Great Gatsby'),
                    new OA\Property(property: 'author', type: 'string', example: 'F. Scott Fitzgerald'),
                    new OA\Property(property: 'publication_year', type: 'integer', example: 1925),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 404, description: 'Book not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    #[OA\Patch(
        path: '/api/books/{book}',
        summary: 'Partially update a book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'The Great Gatsby'),
                    new OA\Property(property: 'author', type: 'string', example: 'F. Scott Fitzgerald'),
                    new OA\Property(property: 'publication_year', type: 'integer', example: 1925),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 404, description: 'Book not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return response()->json($book);
    }

    #[OA\Delete(
        path: '/api/books/{book}',
        summary: 'Delete a book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Book deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Book not found'),
        ]
    )]
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
