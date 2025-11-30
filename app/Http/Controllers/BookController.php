<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

/**
 * @group Books
 */
class BookController extends Controller
{
    /**
     * Get all books
     *
     * @response 200 [{"id": 1, "title": "The Great Gatsby", "author": "F. Scott Fitzgerald", "publication_year": 1925, "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}]
     */
    public function index(): JsonResponse
    {
        $books = Book::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($books);
    }

    /**
     * Get a single book
     *
     * @urlParam book integer required The ID of the book. Example: 1
     *
     * @response 200 {"id": 1, "title": "The Great Gatsby", "author": "F. Scott Fitzgerald", "publication_year": 1925, "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "No query results for model [App\\Models\\Book] 1"}
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    /**
     * Create a new book
     *
     * @bodyParam title string required The book title. Example: The Great Gatsby
     * @bodyParam author string required The book author. Example: F. Scott Fitzgerald
     * @bodyParam publication_year integer required The publication year (4 digits). Example: 1925
     *
     * @response 201 {"id": 1, "title": "The Great Gatsby", "author": "F. Scott Fitzgerald", "publication_year": 1925, "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 422 {"message": "The title field is required."}
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::query()->create($request->validated());

        return response()->json($book, 201);
    }

    /**
     * Update a book
     *
     * @urlParam book integer required The ID of the book. Example: 1
     *
     * @bodyParam title string The book title. Example: The Great Gatsby
     * @bodyParam author string The book author. Example: F. Scott Fitzgerald
     * @bodyParam publication_year integer The publication year (4 digits). Example: 1925
     *
     * @response 200 {"id": 1, "title": "The Great Gatsby", "author": "F. Scott Fitzgerald", "publication_year": 1925, "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "No query results for model [App\\Models\\Book] 1"}
     * @response 422 {"message": "The publication_year must be 4 digits."}
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return response()->json($book);
    }

    /**
     * Delete a book
     *
     * @urlParam book integer required The ID of the book. Example: 1
     *
     * @response 200 {"message": "Book deleted successfully"}
     * @response 404 {"message": "No query results for model [App\\Models\\Book] 1"}
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
