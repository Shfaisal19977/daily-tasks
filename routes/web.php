<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// User routes
Route::get('users', [UserController::class, 'index'])->name('users.index');

// School Management System routes
Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);

// Profile routes
Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('/edit', 'edit')->name('edit');
    Route::put('/', 'update')->name('update');
    Route::patch('/', 'update');
});

// Alias 'profile' route name to 'profile.show' for compatibility
Route::get('profile', [ProfileController::class, 'show'])->name('profile');

// Resource routes
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('products', ProductController::class);
Route::resource('projects', ProjectController::class);

// Book review routes
Route::prefix('books/{book}/reviews')->name('books.reviews.')->group(function () {
    Route::post('/', [ReviewController::class, 'store'])->name('store');
    Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('destroy');
});

// Post comment routes
Route::prefix('posts/{post}/comments')->name('posts.comments.')->group(function () {
    Route::get('/', [PostCommentController::class, 'index'])->name('index');
    Route::get('/create', [PostCommentController::class, 'create'])->name('create');
    Route::post('/', [PostCommentController::class, 'store'])->name('store');
    Route::get('/{comment}', [PostCommentController::class, 'show'])->name('show');
    Route::get('/{comment}/edit', [PostCommentController::class, 'edit'])->name('edit');
    Route::put('/{comment}', [PostCommentController::class, 'update'])->name('update');
    Route::patch('/{comment}', [PostCommentController::class, 'update']);
    Route::delete('/{comment}', [PostCommentController::class, 'destroy'])->name('destroy');
});

// Project task routes
Route::prefix('projects/{project}/tasks')->name('projects.tasks.')->group(function () {
    Route::get('/', [ProjectTaskController::class, 'index'])->name('index');
    Route::get('/create', [ProjectTaskController::class, 'create'])->name('create');
    Route::post('/', [ProjectTaskController::class, 'store'])->name('store');
    Route::get('/{task}', [ProjectTaskController::class, 'show'])->name('show');
    Route::get('/{task}/edit', [ProjectTaskController::class, 'edit'])->name('edit');
    Route::put('/{task}', [ProjectTaskController::class, 'update'])->name('update');
    Route::patch('/{task}', [ProjectTaskController::class, 'update']);
    Route::delete('/{task}', [ProjectTaskController::class, 'destroy'])->name('destroy');
});

// Task comment routes
Route::prefix('tasks/{task}/comments')->name('tasks.comments.')->group(function () {
    Route::get('/', [TaskCommentController::class, 'index'])->name('index');
    Route::get('/create', [TaskCommentController::class, 'create'])->name('create');
    Route::post('/', [TaskCommentController::class, 'store'])->name('store');
    Route::get('/{comment}', [TaskCommentController::class, 'show'])->name('show');
    Route::get('/{comment}/edit', [TaskCommentController::class, 'edit'])->name('edit');
    Route::put('/{comment}', [TaskCommentController::class, 'update'])->name('update');
    Route::patch('/{comment}', [TaskCommentController::class, 'update']);
    Route::delete('/{comment}', [TaskCommentController::class, 'destroy'])->name('destroy');
});

// Product custom routes
Route::post('products/{product}/reduce-stock', [ProductController::class, 'reduceStock'])->name('products.reduce-stock');
