@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Project</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update project information</p>
    </div>

    <x-bladewind::card>
        <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-bladewind::input label="Name" name="name" value="{{ old('name', $project->name) }}" required="true" placeholder="Enter project name" />
                @error('name')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <x-bladewind::textarea label="Description" name="description" placeholder="Enter project description (optional)">{{ old('description', $project->description) }}</x-bladewind::textarea>
                @error('description')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <x-bladewind::input label="Start Date" name="start_date" type="date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" />
                    @error('start_date')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <x-bladewind::input label="End Date" name="end_date" type="date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}" />
                    @error('end_date')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <x-bladewind::select label="Status" name="status" placeholder="Select status">
                    <option value="planned" {{ old('status', $project->status) == 'planned' ? 'selected' : '' }}>Planned</option>
                    <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                </x-bladewind::select>
                @error('status')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            @include('partials.form-actions', ['cancelUrl' => route('projects.index'), 'submitText' => 'Update Project'])
        </form>
    </x-bladewind::card>
</div>
@endsection

