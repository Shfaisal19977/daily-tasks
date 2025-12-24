@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-users mr-3" style="color: #456882;"></i>Users
        </h1>
        <p class="text-gray-600 mt-2">Manage system users</p>
    </div>

    <!-- Users List -->
    @if($users->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($users as $user)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4" style="border-color: #456882;">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="rounded-full w-12 h-12 flex items-center justify-center text-white font-bold text-xl" style="background-color: #456882;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-800">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-calendar mr-2" style="color: #456882;"></i>
                            <span>Joined {{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($user->email_verified_at)
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 mb-4">
                                <i class="fas fa-check-circle mr-1"></i>Verified
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 mb-4">
                                <i class="fas fa-clock mr-1"></i>Unverified
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-white rounded-xl shadow-lg p-4">
            {{ $users->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Users Found</h3>
        </div>
    @endif
</div>
@endsection
