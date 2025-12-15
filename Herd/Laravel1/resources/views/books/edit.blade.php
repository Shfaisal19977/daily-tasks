@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Book</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update book information</p>
    </div>

    <x-bladewind::card>
        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-bladewind::input
                    label="Title"
                    name="title"
                    value="{{ old('title', $book->title) }}"
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
                    value="{{ old('author', $book->author) }}"
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
                    value="{{ old('publication_year', $book->publication_year) }}"
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
                'submitText' => 'Update Book'
            ])
        </form>
    </x-bladewind::card>
</div>
@endsection

