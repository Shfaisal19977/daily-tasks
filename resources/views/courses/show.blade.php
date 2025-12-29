@extends('layouts.app')

@section('title', $course->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Course Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4" style="border-color: #456882;">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $course->name }}</h1>
                <div class="space-y-3">
                    <div class="flex items-center text-lg text-gray-700">
                        <i class="fas fa-chalkboard-teacher mr-3" style="color: #456882; width: 20px;"></i>
                        <span>{{ $course->teacher->user->name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center text-lg text-gray-700">
                        <i class="fas fa-user-graduate mr-3" style="color: #456882; width: 20px;"></i>
                        <span>{{ $course->students->count() }} students enrolled</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-calendar mr-3" style="color: #456882; width: 20px;"></i>
                        <span>Created {{ $course->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('courses.edit', $course) }}" class="text-white px-4 py-2 rounded-lg transition" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Students Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            <i class="fas fa-user-graduate mr-2" style="color: #456882;"></i>Enrolled Students
        </h2>
        @if($course->students->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($course->students as $student)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <h3 class="font-semibold text-gray-800">{{ $student->user->name ?? 'N/A' }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-envelope mr-1"></i>
                            {{ $student->user->email ?? 'N/A' }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-user-slash text-4xl mb-4"></i>
                <p>No students enrolled yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection

