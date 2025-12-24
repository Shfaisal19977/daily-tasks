<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'books' => Book::count(),
            'categories' => Category::count(),
            'posts' => Post::count(),
            'products' => Product::count(),
            'projects' => Project::count(),
            'tasks' => Task::count(),
            'comments' => Comment::count(),
            'low_stock_products' => Product::where('quantity', '<', 10)->count(),
            'total_inventory_value' => Product::sum(DB::raw('price * quantity')),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentBooks = Book::latest()->take(5)->get();
        $recentProjects = Project::with('tasks')->latest()->take(5)->get();

        return view('home', compact('stats', 'recentUsers', 'recentBooks', 'recentProjects'));
    }
}

