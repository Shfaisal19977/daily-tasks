<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Daily Tasks') - Project Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-white text-xl font-bold hover:text-purple-200 transition">
                            <i class="fas fa-tasks mr-2"></i>Daily Tasks
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('projects.*') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-project-diagram mr-2"></i>Projects
                        </a>
                        <a href="{{ route('books.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('books.*') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-book mr-2"></i>Books
                        </a>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-box mr-2"></i>Products
                        </a>
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('categories.*') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-tags mr-2"></i>Categories
                        </a>
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('posts.*') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-newspaper mr-2"></i>Posts
                        </a>
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('users.*') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-users mr-2"></i>Users
                        </a>
                        <a href="{{ route('profile') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('profile.*') ? 'border-yellow-300 text-yellow-200' : 'border-transparent text-white hover:border-purple-300 hover:text-purple-200' }} text-sm font-medium transition">
                            <i class="fas fa-user-circle mr-2"></i>Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm">
                &copy; {{ date('Y') }} Daily Tasks - Project Management System
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
