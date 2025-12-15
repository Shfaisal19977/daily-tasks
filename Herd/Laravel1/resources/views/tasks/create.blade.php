@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-1">
            <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Projects</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('projects.tasks.index', $project) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ $project->name }}</a>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Create New Task</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add a new task to this project</p>
    </div>

    <x-bladewind::card>
        <form action="{{ route('projects.tasks.store', $project) }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-bladewind::input label="Title" name="title" value="{{ old('title') }}" required="true" placeholder="Enter task title" />
                @error('title')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <x-bladewind::textarea label="Details" name="details" placeholder="Enter task details (optional)">{{ old('details') }}</x-bladewind::textarea>
                @error('details')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <x-bladewind::select label="Status" name="status" required="true">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </x-bladewind::select>
                    @error('status')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <x-bladewind::select label="Priority" name="priority" required="true">
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </x-bladewind::select>
                    @error('priority')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <x-bladewind::input label="Due Date" name="due_date" type="date" value="{{ old('due_date') }}" />
                @error('due_date')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            @include('partials.form-actions', ['cancelUrl' => route('projects.tasks.index', $project), 'submitText' => 'Create Task'])
        </form>
    </x-bladewind::card>
</div>
@endsection

