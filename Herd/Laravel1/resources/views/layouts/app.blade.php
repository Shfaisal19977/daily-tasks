<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- BladewindUI CSS -->
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />

    <!-- Alpine.js for interactive components -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- BladewindUI JavaScript -->
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden" x-data="{ mobileMenuOpen: false }">
        <!-- Mobile Menu Overlay -->
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"
            @click="mobileMenuOpen = false"
        ></div>

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
            :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200 dark:border-gray-700">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="hidden sm:inline">Dashboard</span>
                    </a>
                    <div class="flex items-center gap-2">
                        <x-bladewind::button
                            type="button"
                            id="dark-mode-toggle-desktop"
                            size="tiny"
                            icon="moon"
                            class="h-9 w-9"
                            title="Toggle dark mode"
                        />
                        <button
                            @click="mobileMenuOpen = false"
                            class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    @php
                        $navItems = [
                            ['route' => 'home', 'icon' => 'home', 'label' => 'Overview'],
                            ['route' => 'books.index', 'icon' => 'book', 'label' => 'Books'],
                            ['route' => 'categories.index', 'icon' => 'tag', 'label' => 'Categories'],
                            ['route' => 'products.index', 'icon' => 'cube', 'label' => 'Products'],
                            ['route' => 'projects.index', 'icon' => 'briefcase', 'label' => 'Projects'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            @click="mobileMenuOpen = false"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs($item['route'] . '*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                        >
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation (Mobile) -->
            <header class="lg:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex items-center justify-between h-16 px-4">
                    <button
                        @click="mobileMenuOpen = true"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-bold text-gray-900 dark:text-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    <x-bladewind::button
                        type="button"
                        id="dark-mode-toggle-mobile"
                        size="tiny"
                        icon="moon"
                        class="h-9 w-9"
                        title="Toggle dark mode"
                    />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
                    @include('partials.alerts')

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Dark mode toggle functionality
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            document.addEventListener('DOMContentLoaded', function () {
                const toggles = document.querySelectorAll('[id^="dark-mode-toggle"]');
                toggles.forEach(function(toggle) {
                    toggle.addEventListener('click', function() {
                        const isDark = document.documentElement.classList.toggle('dark');
                        localStorage.setItem('theme', isDark ? 'dark' : 'light');
                    });
                });
            });
        })();
    </script>
</body>
</html>
