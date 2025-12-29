@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-chart-line mr-3" style="color: #456882;"></i>Dashboard Overview
        </h1>
        <p class="text-gray-600 mt-2">Welcome to your project management dashboard</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users Card -->
        <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #1B3C53, #234C6A);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Users</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['users']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-users text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Books Card -->
        <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #234C6A, #456882);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Books</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['books']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-book text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Projects Card -->
        <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #1B3C53, #456882);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Projects</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['projects']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-project-diagram text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #234C6A, #1B3C53);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Products</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['products']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-box text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #456882, #234C6A);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Categories</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['categories']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-tags text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Tasks Card -->
        <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #1B3C53, #456882);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Tasks</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['tasks']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-tasks text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Comments Card -->
        <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #234C6A, #456882);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Comments</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['comments']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-comments text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert Card -->
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Low Stock Products</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['low_stock_products']) }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-exclamation-triangle text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- School Management System Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 mt-6" style="border-color: #456882;">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-graduation-cap mr-3" style="color: #456882;"></i>School Management System
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Teachers Card -->
            <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #1B3C53, #234C6A);">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">Total Teachers</p>
                        <p class="text-3xl font-bold mt-2">{{ number_format($stats['teachers']) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-chalkboard-teacher text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Students Card -->
            <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #234C6A, #456882);">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">Total Students</p>
                        <p class="text-3xl font-bold mt-2">{{ number_format($stats['students']) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-user-graduate text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Courses Card -->
            <div class="rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-200" style="background: linear-gradient(to bottom right, #456882, #234C6A);">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">Total Courses</p>
                        <p class="text-3xl font-bold mt-2">{{ number_format($stats['courses']) }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <i class="fas fa-book-reader text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Value Card -->
    <div class="rounded-xl shadow-lg p-6 text-white" style="background: linear-gradient(to right, #456882, #234C6A, #1B3C53);">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium opacity-90">Total Inventory Value</p>
                <p class="text-4xl font-bold mt-2">${{ number_format($stats['total_inventory_value'], 2) }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <i class="fas fa-dollar-sign text-4xl"></i>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-users mr-2" style="color: #456882;"></i>Recent Users
            </h2>
            <div class="space-y-3">
                @forelse($recentUsers as $user)
                    <div class="flex items-center p-3 rounded-lg transition" style="background-color: #E3E3E3;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='#E3E3E3'">
                        <div class="rounded-full w-10 h-10 flex items-center justify-center text-white font-bold" style="background-color: #456882;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No users yet</p>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Teachers -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chalkboard-teacher mr-2" style="color: #456882;"></i>Recent Teachers
            </h2>
            <div class="space-y-3">
                @forelse($recentTeachers as $teacher)
                    <div class="flex items-center p-3 rounded-lg transition" style="background-color: #E3E3E3;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='#E3E3E3'">
                        <div class="rounded-full w-10 h-10 flex items-center justify-center text-white font-bold" style="background-color: #456882;">
                            {{ strtoupper(substr($teacher->user->name ?? 'T', 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">{{ $teacher->user->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $teacher->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No teachers yet</p>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Students -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-graduate mr-2" style="color: #456882;"></i>Recent Students
            </h2>
            <div class="space-y-3">
                @forelse($recentStudents as $student)
                    <div class="flex items-center p-3 rounded-lg transition" style="background-color: #E3E3E3;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='#E3E3E3'">
                        <div class="rounded-full w-10 h-10 flex items-center justify-center text-white font-bold" style="background-color: #456882;">
                            {{ strtoupper(substr($student->user->name ?? 'S', 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">{{ $student->user->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $student->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No students yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Books -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-book mr-2" style="color: #456882;"></i>Recent Books
            </h2>
            <div class="space-y-3">
                @forelse($recentBooks as $book)
                    <div class="p-3 rounded-lg transition" style="background-color: #E3E3E3;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='#E3E3E3'">
                        <p class="font-medium text-gray-800">{{ $book->title }}</p>
                        <p class="text-sm text-gray-500">by {{ $book->author }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $book->publication_year }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No books yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-project-diagram mr-2" style="color: #456882;"></i>Recent Projects
            </h2>
            <div class="space-y-3">
                @forelse($recentProjects as $project)
                    <div class="p-3 rounded-lg transition" style="background-color: #E3E3E3;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='#E3E3E3'">
                        <p class="font-medium text-gray-800">{{ $project->name }}</p>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($project->description, 50) }}</p>
                        <div class="flex items-center mt-2">
                            <span class="px-2 py-1 text-xs rounded-full text-white" style="background-color: #456882;">
                                {{ $project->tasks->count() }} tasks
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No projects yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-bolt mr-2" style="color: #456882;"></i>Quick Actions
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <a href="{{ route('projects.create') }}" class="text-white p-4 rounded-lg text-center transition transform hover:scale-105" style="background: linear-gradient(to right, #1B3C53, #234C6A);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #456882)'" onmouseout="this.style.background='linear-gradient(to right, #1B3C53, #234C6A)'">
                <i class="fas fa-plus text-2xl mb-2"></i>
                <p class="font-medium text-sm">New Project</p>
            </a>
            <a href="{{ route('books.create') }}" class="text-white p-4 rounded-lg text-center transition transform hover:scale-105" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                <i class="fas fa-plus text-2xl mb-2"></i>
                <p class="font-medium text-sm">New Book</p>
            </a>
            <a href="{{ route('products.create') }}" class="text-white p-4 rounded-lg text-center transition transform hover:scale-105" style="background: linear-gradient(to right, #1B3C53, #456882);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #1B3C53)'" onmouseout="this.style.background='linear-gradient(to right, #1B3C53, #456882)'">
                <i class="fas fa-plus text-2xl mb-2"></i>
                <p class="font-medium text-sm">New Product</p>
            </a>
            <a href="{{ route('categories.create') }}" class="text-white p-4 rounded-lg text-center transition transform hover:scale-105" style="background: linear-gradient(to right, #456882, #234C6A);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #456882)'" onmouseout="this.style.background='linear-gradient(to right, #456882, #234C6A)'">
                <i class="fas fa-plus text-2xl mb-2"></i>
                <p class="font-medium text-sm">New Category</p>
            </a>
            @if(isset($stats['teachers']))
            <a href="{{ route('teachers.index') }}" class="text-white p-4 rounded-lg text-center transition transform hover:scale-105" style="background: linear-gradient(to right, #1B3C53, #234C6A);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #456882)'" onmouseout="this.style.background='linear-gradient(to right, #1B3C53, #234C6A)'">
                <i class="fas fa-chalkboard-teacher text-2xl mb-2"></i>
                <p class="font-medium text-sm">Teachers</p>
            </a>
            <a href="{{ route('students.index') }}" class="text-white p-4 rounded-lg text-center transition transform hover:scale-105" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                <i class="fas fa-user-graduate text-2xl mb-2"></i>
                <p class="font-medium text-sm">Students</p>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
