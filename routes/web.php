<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\TaskCommentController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $stats = [
        'users' => \App\Models\User::count(),
        'books' => \App\Models\Book::count(),
        'categories' => \App\Models\Category::count(),
        'products' => \App\Models\Product::count(),
        'projects' => \App\Models\Project::count(),
        'tasks' => \App\Models\Task::count(),
        'comments' => \App\Models\Comment::count(),
        'low_stock_products' => \App\Models\Product::where('quantity', '<', 10)->count(),
        'total_inventory_value' => \App\Models\Product::sum(DB::raw('price * quantity')),
    ];

    $recentUsers = \App\Models\User::latest()->take(5)->get();
    $recentBooks = \App\Models\Book::latest()->take(5)->get();
    $recentProjects = \App\Models\Project::with('tasks')->latest()->take(5)->get();

    return view('home', compact('stats', 'recentUsers', 'recentBooks', 'recentProjects'));
})->name('home');

Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

Route::prefix('profile')->name('profile.')->controller(\App\Http\Controllers\ProfileController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('/edit', 'edit')->name('edit');
    Route::put('/', 'update')->name('update');
    Route::patch('/', 'update');
});
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('projects', ProjectController::class);

Route::prefix('projects/{project}/tasks')->name('projects.tasks.')->group(function () {
    Route::get('/', [ProjectTaskController::class, 'index'])->name('index');
    Route::get('/create', [ProjectTaskController::class, 'create'])->name('create');
    Route::post('/', [ProjectTaskController::class, 'store'])->name('store');
    Route::get('/{task}', [ProjectTaskController::class, 'show'])->name('show');
    Route::get('/{task}/edit', [ProjectTaskController::class, 'edit'])->name('edit');
    Route::put('/{task}', [ProjectTaskController::class, 'update'])->name('update');
    Route::patch('/{task}', [ProjectTaskController::class, 'update'])->name('update');
    Route::delete('/{task}', [ProjectTaskController::class, 'destroy'])->name('destroy');
});

Route::prefix('tasks/{task}/comments')->name('tasks.comments.')->group(function () {
    Route::get('/', [TaskCommentController::class, 'index'])->name('index');
    Route::get('/create', [TaskCommentController::class, 'create'])->name('create');
    Route::post('/', [TaskCommentController::class, 'store'])->name('store');
    Route::get('/{comment}', [TaskCommentController::class, 'show'])->name('show');
    Route::get('/{comment}/edit', [TaskCommentController::class, 'edit'])->name('edit');
    Route::put('/{comment}', [TaskCommentController::class, 'update'])->name('update');
    Route::patch('/{comment}', [TaskCommentController::class, 'update'])->name('update');
    Route::delete('/{comment}', [TaskCommentController::class, 'destroy'])->name('destroy');
});

Route::post('products/{product}/reduce-stock', [ProductController::class, 'reduceStock'])->name('products.reduce-stock');
