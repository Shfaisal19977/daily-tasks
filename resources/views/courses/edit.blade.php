@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4" style="border-color: #456882;">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            <i class="fas fa-edit mr-3" style="color: #456882;"></i>Edit Course
        </h1>

        <form action="{{ route('courses.update', $course) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Course Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-book mr-2" style="color: #456882;"></i>Course Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg transition @error('name') border-red-500 @enderror" onfocus="this.style.borderColor='#456882'; this.style.boxShadow='0 0 0 3px rgba(69, 104, 130, 0.1)'" onblur="this.style.borderColor=''; this.style.boxShadow=''">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teacher Selection -->
            <div>
                <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-chalkboard-teacher mr-2" style="color: #456882;"></i>Teacher
                </label>
                <select name="teacher_id" id="teacher_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg transition @error('teacher_id') border-red-500 @enderror" onfocus="this.style.borderColor='#456882'; this.style.boxShadow='0 0 0 3px rgba(69, 104, 130, 0.1)'" onblur="this.style.borderColor=''; this.style.boxShadow=''">
                    <option value="">Select a teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->user->name ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 text-white px-6 py-3 rounded-lg transition transform hover:scale-105 font-medium" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                    <i class="fas fa-save mr-2"></i>Update Course
                </button>
                <a href="{{ route('courses.show', $course) }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

