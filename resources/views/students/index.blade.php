@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-user-graduate mr-3" style="color: #456882;"></i>Students
                </h1>
                <p class="text-gray-600 mt-2">Manage enrolled students</p>
            </div>
            <a href="{{ route('students.create') }}" class="text-white px-6 py-3 rounded-lg transition transform hover:scale-105" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                <i class="fas fa-plus mr-2"></i>New Student
            </a>
        </div>
    </div>

    <!-- Students List -->
    @if($students->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($students as $student)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4" style="border-color: #456882;">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="rounded-full w-12 h-12 flex items-center justify-center text-white font-bold text-xl" style="background-color: #456882;">
                                {{ strtoupper(substr($student->user->name ?? 'S', 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-800">{{ $student->user->name ?? 'N/A' }}</h3>
                                <p class="text-sm text-gray-500">{{ $student->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-book-reader mr-2" style="color: #456882;"></i>
                            <span>{{ $student->courses->count() }} courses</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2" style="color: #456882;"></i>
                            <span>Enrolled {{ $student->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex space-x-2 mt-4">
                            <a href="{{ route('students.show', $student) }}" class="flex-1 text-center text-white px-4 py-2 rounded-lg transition" style="background-color: #456882;" onmouseover="this.style.backgroundColor='#234C6A'" onmouseout="this.style.backgroundColor='#456882'">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('students.edit', $student) }}" class="flex-1 text-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="flex-1">
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
            <i class="fas fa-user-graduate text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Students Found</h3>
            <p class="text-gray-500 mb-4">No students have been enrolled yet.</p>
            <a href="{{ route('students.create') }}" class="inline-block text-white px-6 py-3 rounded-lg transition" style="background: linear-gradient(to right, #234C6A, #456882);">
                <i class="fas fa-plus mr-2"></i>Create First Student
            </a>
        </div>
    @endif
</div>
@endsection

