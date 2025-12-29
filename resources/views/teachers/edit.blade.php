@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4" style="border-color: #456882;">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            <i class="fas fa-edit mr-3" style="color: #456882;"></i>Edit Teacher
        </h1>

        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <p class="text-sm text-gray-600">
                <i class="fas fa-info-circle mr-2"></i>
                Teacher user association cannot be changed once created.
            </p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2" style="color: #456882;"></i>User
                </label>
                <div class="px-4 py-3 bg-gray-100 rounded-lg">
                    <p class="font-medium text-gray-800">{{ $teacher->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $teacher->user->email }}</p>
                </div>
            </div>

            <div class="flex space-x-4 pt-4">
                <a href="{{ route('teachers.show', $teacher) }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Teacher
                </a>
                <a href="{{ route('teachers.index') }}" class="flex-1 bg-gray-400 text-white px-6 py-3 rounded-lg hover:bg-gray-500 transition text-center font-medium">
                    <i class="fas fa-list mr-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

