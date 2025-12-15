@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Create New Project</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add a new project</p>
    </div>

    <x-bladewind::card>
        <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-bladewind::input label="Name" name="name" value="{{ old('name') }}" required="true" placeholder="Enter project name" />
                @error('name')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <x-bladewind::textarea label="Description" name="description" placeholder="Enter project description (optional)">{{ old('description') }}</x-bladewind::textarea>
                @error('description')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <x-bladewind::input label="Start Date" name="start_date" type="date" value="{{ old('start_date') }}" />
                    @error('start_date')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <x-bladewind::input label="End Date" name="end_date" type="date" value="{{ old('end_date') }}" />
                    @error('end_date')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <x-bladewind::select label="Status" name="status" placeholder="Select status">
                    <option value="planned" {{ old('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="on_hold" {{ old('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                </x-bladewind::select>
                @error('status')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            @include('partials.form-actions', ['cancelUrl' => route('projects.index'), 'submitText' => 'Create Project'])
        </form>
    </x-bladewind::card>
</div>
@endsection

