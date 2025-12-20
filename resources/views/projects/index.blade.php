@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-project-diagram text-purple-600 mr-3"></i>Projects
            </h1>
            <p class="text-gray-600 mt-2">Manage your projects and track progress</p>
        </div>
        <a href="{{ route('projects.create') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus mr-2"></i>New Project
        </a>
    </div>

    <!-- Projects Grid -->
    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4 border-purple-500">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800 line-clamp-1">{{ $project->name }}</h3>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                @if($project->status === 'completed') bg-green-100 text-green-800
                                @elseif($project->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($project->status === 'planned') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>
                                <span>Start: {{ $project->start_date ? $project->start_date->format('M d, Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar-check mr-2 text-purple-500"></i>
                                <span>End: {{ $project->end_date ? $project->end_date->format('M d, Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-tasks mr-2 text-purple-500"></i>
                                <span>{{ $project->tasks->count() }} tasks</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('projects.show', $project) }}" class="flex-1 bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition text-center text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('projects.edit', $project) }}" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition text-center text-sm font-medium">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm font-medium">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-white rounded-xl shadow-lg p-4">
            {{ $projects->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-project-diagram text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Projects Yet</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first project</p>
            <a href="{{ route('projects.create') }}" class="inline-block bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Create Project
            </a>
        </div>
    @endif
</div>
@endsection
