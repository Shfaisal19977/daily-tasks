<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($books);
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::query()->create($request->validated());

        return response()->json($book, 201);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return response()->json($book);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
