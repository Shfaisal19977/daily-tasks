@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-book-reader mr-3" style="color: #456882;"></i>Courses
                </h1>
                <p class="text-gray-600 mt-2">Manage school courses</p>
            </div>
            <a href="{{ route('courses.create') }}" class="text-white px-6 py-3 rounded-lg transition transform hover:scale-105" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                <i class="fas fa-plus mr-2"></i>New Course
            </a>
        </div>
    </div>

    <!-- Courses List -->
    @if($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4" style="border-color: #456882;">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $course->name }}</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-chalkboard-teacher mr-2" style="color: #456882;"></i>
                                <span>{{ $course->teacher->user->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-user-graduate mr-2" style="color: #456882;"></i>
                                <span>{{ $course->students->count() }} students</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('courses.show', $course) }}" class="flex-1 text-center text-white px-4 py-2 rounded-lg transition" style="background-color: #456882;" onmouseover="this.style.backgroundColor='#234C6A'" onmouseout="this.style.backgroundColor='#456882'">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('courses.edit', $course) }}" class="flex-1 text-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-book-reader text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Courses Found</h3>
            <p class="text-gray-500 mb-4">No courses have been created yet.</p>
            <a href="{{ route('courses.create') }}" class="inline-block text-white px-6 py-3 rounded-lg transition" style="background: linear-gradient(to right, #234C6A, #456882);">
                <i class="fas fa-plus mr-2"></i>Create First Course
            </a>
        </div>
    @endif
</div>
@endsection

