@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Profile Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-blue-500">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-user-circle text-blue-600 mr-3"></i>Profile
            </h1>
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                <i class="fas fa-edit mr-2"></i>Edit Profile
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Info -->
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Name</p>
                    <p class="text-lg font-medium text-gray-800">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Email</p>
                    <p class="text-lg font-medium text-gray-800">{{ $user->email }}</p>
                </div>
                <div>
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
            </div>

            <!-- Profile Details -->
            @if($profile)
                <div class="space-y-4">
                    @if($profile->bio)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Bio</p>
                            <p class="text-gray-800">{{ $profile->bio }}</p>
                        </div>
                    @endif
                    @if($profile->phone)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Phone</p>
                            <p class="text-gray-800">{{ $profile->phone }}</p>
                        </div>
                    @endif
                    @if($profile->location)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Location</p>
                            <p class="text-gray-800">{{ $profile->location }}</p>
                        </div>
                    @endif
                    @if($profile->website)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Website</p>
                            <a href="{{ $profile->website }}" target="_blank" class="text-blue-600 hover:text-blue-700">{{ $profile->website }}</a>
                        </div>
                    @endif
                    @if($profile->date_of_birth)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Date of Birth</p>
                            <p class="text-gray-800">{{ $profile->date_of_birth->format('F d, Y') }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
