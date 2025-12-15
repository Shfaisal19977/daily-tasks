@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Overview of your application</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <x-bladewind::statistic
            label="Books"
            value="{{ number_format($stats['books']) }}"
            icon="book"
        />
        <x-bladewind::statistic
            label="Categories"
            value="{{ number_format($stats['categories']) }}"
            icon="tag"
        />
        <x-bladewind::statistic
            label="Products"
            value="{{ number_format($stats['products']) }}"
            icon="cube"
        />
        <x-bladewind::statistic
            label="Projects"
            value="{{ number_format($stats['projects']) }}"
            icon="briefcase"
        />
        <x-bladewind::statistic
            label="Tasks"
            value="{{ number_format($stats['tasks']) }}"
            icon="check-circle"
        />
        <x-bladewind::statistic
            label="Comments"
            value="{{ number_format($stats['comments']) }}"
            icon="chat"
        />
        <x-bladewind::statistic
            label="Low Stock Products"
            value="{{ number_format($stats['low_stock_products']) }}"
            icon="exclamation-triangle"
        />
        <x-bladewind::statistic
            label="Total Inventory Value"
            value="${{ number_format($stats['total_inventory_value'], 2) }}"
            icon="currency-dollar"
        />
    </div>

    <!-- Recent Items -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Books -->
        <x-bladewind::card>
            <x-slot:title>Recent Books</x-slot:title>
            @if($recentBooks->count() > 0)
                <div class="space-y-3">
                    @foreach($recentBooks as $book)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $book->title }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $book->author }}</p>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $book->publication_year }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('books.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all books →</a>
                </div>
            @else
                <x-bladewind::empty-state
                    title="No books yet"
                    description="Get started by creating your first book."
                    action_label="Create Book"
                    action_url="{{ route('books.create') }}"
                />
            @endif
        </x-bladewind::card>

        <!-- Recent Projects -->
        <x-bladewind::card>
            <x-slot:title>Recent Projects</x-slot:title>
            @if($recentProjects->count() > 0)
                <div class="space-y-3">
                    @foreach($recentProjects as $project)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $project->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $project->tasks->count() }} tasks</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('projects.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all projects →</a>
                </div>
            @else
                <x-bladewind::empty-state
                    title="No projects yet"
                    description="Get started by creating your first project."
                    action_label="Create Project"
                    action_url="{{ route('projects.create') }}"
                />
            @endif
        </x-bladewind::card>
    </div>
</div>
@endsection

