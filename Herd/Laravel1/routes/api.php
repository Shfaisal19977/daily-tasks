<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectTaskController;
use App\Http\Controllers\Api\TaskCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('books', BookController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('projects.tasks', ProjectTaskController::class);
Route::apiResource('tasks.comments', TaskCommentController::class);

Route::post('products/{product}/reduce-stock', [ProductController::class, 'reduceStock'])->name('products.reduce-stock');
