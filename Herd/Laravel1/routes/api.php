<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\TaskCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ProjectController::class)->prefix('projects')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');

    Route::controller(ProjectTaskController::class)->prefix('{project}/tasks')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
    });
});

Route::controller(TaskCommentController::class)->prefix('tasks/{task}/comments')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::delete('/{comment}', 'destroy');
});
