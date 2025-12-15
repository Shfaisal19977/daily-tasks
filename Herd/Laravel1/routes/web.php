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
        'books' => \App\Models\Book::count(),
        'categories' => \App\Models\Category::count(),
        'products' => \App\Models\Product::count(),
        'projects' => \App\Models\Project::count(),
        'tasks' => \App\Models\Task::count(),
        'comments' => \App\Models\Comment::count(),
        'low_stock_products' => \App\Models\Product::where('quantity', '<', 10)->count(),
        'total_inventory_value' => \App\Models\Product::sum(DB::raw('price * quantity')),
    ];

    $recentBooks = \App\Models\Book::latest()->take(5)->get();
    $recentProjects = \App\Models\Project::with('tasks')->latest()->take(5)->get();

    return view('home', compact('stats', 'recentBooks', 'recentProjects'));
})->name('home');

Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('projects', ProjectController::class);
Route::resource('projects.tasks', ProjectTaskController::class);
Route::resource('tasks.comments', TaskCommentController::class);

Route::post('products/{product}/reduce-stock', [ProductController::class, 'reduceStock'])->name('products.reduce-stock');
