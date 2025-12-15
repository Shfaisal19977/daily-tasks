<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen">
    <nav class="bg-white dark:bg-[#161615] border-b border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm sticky top-0 z-50 backdrop-blur-sm bg-white/95 dark:bg-[#161615]/95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <div class="hidden md:flex gap-1">
                        <a href="{{ route('books.index') }}" class="px-4 py-2 text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#0a0a0a] rounded-lg transition-colors {{ request()->routeIs('books.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20' : '' }}">
                            Books
                        </a>
                        <a href="{{ route('categories.index') }}" class="px-4 py-2 text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#0a0a0a] rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20' : '' }}">
                            Categories
                        </a>
                        <a href="{{ route('products.index') }}" class="px-4 py-2 text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#0a0a0a] rounded-lg transition-colors {{ request()->routeIs('products.*') ? 'text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20' : '' }}">
                            Products
                        </a>
                        <a href="{{ route('projects.index') }}" class="px-4 py-2 text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#0a0a0a] rounded-lg transition-colors {{ request()->routeIs('projects.*') ? 'text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20' : '' }}">
                            Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 dark:border-green-400 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg shadow-sm flex items-center gap-3 animate-slide-in">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-400 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg shadow-sm flex items-center gap-3 animate-slide-in">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-400 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">Please fix the following errors:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <style>
        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>
</body>
</html>
