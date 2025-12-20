<header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="px-6 py-4 flex items-center justify-between">
        <div class="flex items-center">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                @yield('page-title', 'Dashboard')
            </h1>
        </div>

        <div class="flex items-center gap-4">
            <!-- User Menu -->
            @include('partials.user-menu')
        </div>
    </div>
</header>

