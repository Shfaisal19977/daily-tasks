@extends('layouts.app')

@section('title', 'Create Teacher')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4" style="border-color: #456882;">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            <i class="fas fa-plus-circle mr-3" style="color: #456882;"></i>Create New Teacher
        </h1>

        <form action="{{ route('teachers.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- User Selection -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2" style="color: #456882;"></i>Select User
                </label>
                <select name="user_id" id="user_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg transition @error('user_id') border-red-500 @enderror" onfocus="this.style.borderColor='#456882'; this.style.boxShadow='0 0 0 3px rgba(69, 104, 130, 0.1)'" onblur="this.style.borderColor=''; this.style.boxShadow=''">
                    <option value="">Select a user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if($users->isEmpty())
                    <p class="mt-2 text-sm text-gray-500">No available users. All users are already assigned as teachers or students.</p>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 text-white px-6 py-3 rounded-lg transition transform hover:scale-105 font-medium" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                    <i class="fas fa-save mr-2"></i>Create Teacher
                </button>
                <a href="{{ route('teachers.index') }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

