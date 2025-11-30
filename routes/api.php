<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\TaskCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

const BOOK_ROUTE_PARAM = '/{book}';
const PRODUCT_ROUTE_PARAM = '/{product}';
const PROJECT_ROUTE_PARAM = '/{project}';
const TASK_ROUTE_PARAM = '/{task}';
const COMMENT_ROUTE_PARAM = '/{comment}';

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(BookController::class)->prefix('books')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get(BOOK_ROUTE_PARAM, 'show');
    Route::put(BOOK_ROUTE_PARAM, 'update');
    Route::patch(BOOK_ROUTE_PARAM, 'update');
    Route::delete(BOOK_ROUTE_PARAM, 'destroy');
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
    Route::put(PROJECT_ROUTE_PARAM, 'update');
    Route::patch(PROJECT_ROUTE_PARAM, 'update');

    Route::controller(ProjectTaskController::class)->prefix('{project}/tasks')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put(TASK_ROUTE_PARAM, 'update');
        Route::patch(TASK_ROUTE_PARAM, 'update');
    });
});

Route::controller(TaskCommentController::class)->prefix('tasks/{task}/comments')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::put(COMMENT_ROUTE_PARAM, 'update');
    Route::patch(COMMENT_ROUTE_PARAM, 'update');
    Route::delete(COMMENT_ROUTE_PARAM, 'destroy');
});
