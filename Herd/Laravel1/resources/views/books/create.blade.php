@extends('layouts.app')

@section('title', 'Create Book')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Create New Book</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add a new book to your collection</p>
    </div>

    <x-bladewind::card>
        <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-bladewind::input
                    label="Title"
                    name="title"
                    value="{{ old('title') }}"
                    required="true"
                    placeholder="Enter book title"
                />
                @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-bladewind::input
                    label="Author"
                    name="author"
                    value="{{ old('author') }}"
                    required="true"
                    placeholder="Enter author name"
                />
                @error('author')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-bladewind::input
                    label="Publication Year"
                    name="publication_year"
                    type="number"
                    value="{{ old('publication_year') }}"
                    required="true"
                    placeholder="YYYY"
                    min="1000"
                    max="9999"
                />
                @error('publication_year')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            @include('partials.form-actions', [
                'cancelUrl' => route('books.index'),
                'submitText' => 'Create Book'
            ])
        </form>
    </x-bladewind::card>
</div>
@endsection

