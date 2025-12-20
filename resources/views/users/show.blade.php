@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- User Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-blue-500">
        <div class="flex items-center mb-6">
            <div class="bg-blue-500 rounded-full w-16 h-16 flex items-center justify-center text-white font-bold text-2xl mr-4">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-blue-50 p-4 rounded-lg">
                <p class="text-sm text-gray-500 mb-1">Email Verified</p>
                @if($user->email_verified_at)
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>Verified
                    </span>
                @else
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>Not Verified
                    </span>
                @endif
            </div>
            <div class="bg-blue-50 p-4 rounded-lg">
                <p class="text-sm text-gray-500 mb-1">Member Since</p>
                <p class="font-medium text-gray-800">{{ $user->created_at->format('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Profile Information -->
    @if($user->profile)
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-circle text-blue-600 mr-2"></i>Profile Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($user->profile->bio)
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500 mb-1">Bio</p>
                        <p class="text-gray-800">{{ $user->profile->bio }}</p>
                    </div>
                @endif
                @if($user->profile->phone)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Phone</p>
                        <p class="text-gray-800">{{ $user->profile->phone }}</p>
                    </div>
                @endif
                @if($user->profile->location)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Location</p>
                        <p class="text-gray-800">{{ $user->profile->location }}</p>
                    </div>
                @endif
                @if($user->profile->website)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Website</p>
                        <a href="{{ $user->profile->website }}" target="_blank" class="text-blue-600 hover:text-blue-700">{{ $user->profile->website }}</a>
                    </div>
                @endif
                @if($user->profile->date_of_birth)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Date of Birth</p>
                        <p class="text-gray-800">{{ $user->profile->date_of_birth->format('F d, Y') }}</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
