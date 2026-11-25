@extends('layouts.bookstore')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Book') }}</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('books.update', $book) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" :value="__('Book Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="author" :value="__('Author')" />
                        <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $book->author)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('author')" />
                    </div>

                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" @selected(old('category', $book->category) === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                    </div>

                    <div>
                        <x-input-label for="unit_price" :value="__('Unit Price (PHP)')" />
                        <x-text-input id="unit_price" name="unit_price" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('unit_price', $book->unit_price)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('unit_price')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $book->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="availability_status" :value="__('Availability Status')" />
                        <select id="availability_status" name="availability_status" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected(old('availability_status', $book->availability_status) === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('availability_status')" />
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        <x-primary-button>{{ __('Update Book') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection