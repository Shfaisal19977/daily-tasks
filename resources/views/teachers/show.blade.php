@extends('layouts.app')

@section('title', $teacher->user->name ?? 'Teacher')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Teacher Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4" style="border-color: #456882;">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $teacher->user->name ?? 'N/A' }}</h1>
                <div class="space-y-3">
                    <div class="flex items-center text-lg text-gray-700">
                        <i class="fas fa-envelope mr-3" style="color: #456882; width: 20px;"></i>
                        <span>{{ $teacher->user->email ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center text-lg text-gray-700">
                        <i class="fas fa-book-reader mr-3" style="color: #456882; width: 20px;"></i>
                        <span>{{ $teacher->courses->count() }} courses</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-calendar mr-3" style="color: #456882; width: 20px;"></i>
                        <span>Joined {{ $teacher->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('teachers.edit', $teacher) }}" class="text-white px-4 py-2 rounded-lg transition" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            <i class="fas fa-book-reader mr-2" style="color: #456882;"></i>Courses
        </h2>
        @if($teacher->courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($teacher->courses as $course)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <h3 class="font-semibold text-gray-800">{{ $course->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-user-graduate mr-1"></i>
                            {{ $course->students->count() }} students
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-book-open text-4xl mb-4"></i>
                <p>No courses assigned yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection

