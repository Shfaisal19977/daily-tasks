@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Create New Category</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add a new product category</p>
    </div>

    <x-bladewind::card>
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-bladewind::input label="Name" name="name" value="{{ old('name') }}" required="true" placeholder="Enter category name" />
                @error('name')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <x-bladewind::input label="Price" name="price" type="number" step="0.01" value="{{ old('price') }}" required="true" placeholder="0.00" min="0" />
                @error('price')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <x-bladewind::textarea label="Description" name="description" placeholder="Enter category description (optional)">{{ old('description') }}</x-bladewind::textarea>
                @error('description')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            @include('partials.form-actions', ['cancelUrl' => route('categories.index'), 'submitText' => 'Create Category'])
        </form>
    </x-bladewind::card>
</div>
@endsection

