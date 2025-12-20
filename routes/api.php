<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

if (! defined('BOOK_ROUTE_PARAM')) {
    define('BOOK_ROUTE_PARAM', '/{book}');
    define('CATEGORY_ROUTE_PARAM', '/{category}');
    define('POST_ROUTE_PARAM', '/{post}');
    define('POST_COMMENT_ROUTE_PARAM', '/{comment}');
    define('PRODUCT_ROUTE_PARAM', '/{product}');
    define('PROJECT_ROUTE_PARAM', '/{project}');
    define('TASK_ROUTE_PARAM', '/{task}');
    define('COMMENT_ROUTE_PARAM', '/{comment}');
    define('USER_ROUTE_PARAM', '/{user}');
}

// Authenticated User Routes
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Profile API Routes (requires authentication)
Route::middleware('auth:sanctum')->prefix('profile')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'show');
    Route::put('/', 'update');
    Route::patch('/', 'update');
});

Route::controller(BookController::class)->prefix('books')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get(BOOK_ROUTE_PARAM, 'show');
    Route::put(BOOK_ROUTE_PARAM, 'update');
    Route::patch(BOOK_ROUTE_PARAM, 'update');
    Route::delete(BOOK_ROUTE_PARAM, 'destroy');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get(CATEGORY_ROUTE_PARAM, 'show');
    Route::put(CATEGORY_ROUTE_PARAM, 'update');
    Route::patch(CATEGORY_ROUTE_PARAM, 'update');
    Route::delete(CATEGORY_ROUTE_PARAM, 'destroy');
});

Route::controller(PostController::class)->prefix('posts')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get(POST_ROUTE_PARAM, 'show');
    Route::put(POST_ROUTE_PARAM, 'update');
    Route::patch(POST_ROUTE_PARAM, 'update');
    Route::delete(POST_ROUTE_PARAM, 'destroy');

    Route::controller(PostCommentController::class)->prefix('{post}/comments')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get(POST_COMMENT_ROUTE_PARAM, 'show');
        Route::put(POST_COMMENT_ROUTE_PARAM, 'update');
        Route::patch(POST_COMMENT_ROUTE_PARAM, 'update');
        Route::delete(POST_COMMENT_ROUTE_PARAM, 'destroy');
    });
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get(PRODUCT_ROUTE_PARAM, 'show');
    Route::put(PRODUCT_ROUTE_PARAM, 'update');
    Route::patch(PRODUCT_ROUTE_PARAM, 'update');
    Route::delete(PRODUCT_ROUTE_PARAM, 'destroy');
    Route::post(PRODUCT_ROUTE_PARAM.'/reduce-stock', 'reduceStock');
});

Route::controller(ProjectController::class)->prefix('projects')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get(PROJECT_ROUTE_PARAM, 'show');
    Route::put(PROJECT_ROUTE_PARAM, 'update');
    Route::patch(PROJECT_ROUTE_PARAM, 'update');
    Route::delete(PROJECT_ROUTE_PARAM, 'destroy');

    Route::controller(ProjectTaskController::class)->prefix('{project}/tasks')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get(TASK_ROUTE_PARAM, 'show');
        Route::put(TASK_ROUTE_PARAM, 'update');
        Route::patch(TASK_ROUTE_PARAM, 'update');
        Route::delete(TASK_ROUTE_PARAM, 'destroy');
    });
});

Route::controller(TaskCommentController::class)->prefix('tasks/{task}/comments')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get(COMMENT_ROUTE_PARAM, 'show');
    Route::put(COMMENT_ROUTE_PARAM, 'update');
    Route::patch(COMMENT_ROUTE_PARAM, 'update');
    Route::delete(COMMENT_ROUTE_PARAM, 'destroy');
});

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/', 'index');
    Route::get(USER_ROUTE_PARAM, 'show');
});
