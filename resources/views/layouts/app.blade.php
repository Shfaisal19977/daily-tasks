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
        /* Custom Color Palette from Color Hunt */
        :root {
            --navy-dark: #1B3C53;
            --navy-medium: #234C6A;
            --blue-grey: #456882;
            --light-grey: #E3E3E3;
        }
        .nav-link {
            transition: all 0.2s ease;
        }
        .nav-link:hover:not(.active) {
            background-color: #234C6A !important;
            color: white !important;
        }
        .nav-link.active {
            background-color: #456882 !important;
            color: white !important;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex" style="background-color: #E3E3E3;">
    <!-- Sidebar Navigation -->
    <nav class="w-64 min-h-screen shadow-lg" style="background-color: #1B3C53;">
        <div class="flex flex-col h-full">
            <!-- Logo/Brand -->
            <div class="p-6 border-b" style="border-color: #234C6A;">
                <a href="{{ route('home') }}" class="text-white text-xl font-bold hover:opacity-80 transition flex items-center">
                    <i class="fas fa-tasks mr-2"></i>Daily Tasks
                </a>
            </div>
            
            <!-- Navigation Links -->
            <div class="flex-1 py-4">
                <nav class="space-y-1 px-3">
                    <a href="{{ route('home') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('home') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-home mr-3 w-5"></i>Dashboard
                    </a>
                    <a href="{{ route('projects.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('projects.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-project-diagram mr-3 w-5"></i>Projects
                    </a>
                    <a href="{{ route('books.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('books.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-book mr-3 w-5"></i>Books
                    </a>
                    <a href="{{ route('products.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('products.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-box mr-3 w-5"></i>Products
                    </a>
                    <a href="{{ route('categories.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('categories.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-tags mr-3 w-5"></i>Categories
                    </a>
                    <a href="{{ route('posts.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('posts.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-newspaper mr-3 w-5"></i>Posts
                    </a>
                    <a href="{{ route('users.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('users.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-users mr-3 w-5"></i>Users
                    </a>
                    <div class="pt-2 pb-1 px-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">School Management</p>
                    </div>
                    <a href="{{ route('teachers.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('teachers.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-chalkboard-teacher mr-3 w-5"></i>Teachers
                    </a>
                    <a href="{{ route('students.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('students.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-user-graduate mr-3 w-5"></i>Students
                    </a>
                    <a href="{{ route('courses.index') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('courses.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-book-reader mr-3 w-5"></i>Courses
                    </a>
                    <a href="{{ route('profile') }}" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('profile.*') ? 'active text-white' : 'text-gray-300' }}">
                        <i class="fas fa-user-circle mr-3 w-5"></i>Profile
                    </a>
                </nav>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="px-6 pt-4">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="px-6 pt-4">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p class="font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1 px-6 py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="text-white py-6" style="background-color: #1B3C53;">
            <div class="px-6">
                <p class="text-center text-sm">
                    &copy; {{ date('Y') }} Daily Tasks - Project Management System
                </p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
