@extends('layouts.bookstore')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Book Details') }}</h2>
        <a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to List</a>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <dl class="divide-y divide-gray-200 text-sm">
                    <div class="py-3 grid grid-cols-3"><dt class="font-medium text-gray-500">Title</dt><dd class="col-span-2 text-gray-900">{{ $book->title }}</dd></div>
                    <div class="py-3 grid grid-cols-3"><dt class="font-medium text-gray-500">Author</dt><dd class="col-span-2 text-gray-900">{{ $book->author }}</dd></div>
                    <div class="py-3 grid grid-cols-3"><dt class="font-medium text-gray-500">Category</dt><dd class="col-span-2 text-gray-900">{{ $book->category }}</dd></div>
                    <div class="py-3 grid grid-cols-3"><dt class="font-medium text-gray-500">Unit Price</dt><dd class="col-span-2 text-gray-900">PHP {{ number_format((float) $book->unit_price, 2) }}</dd></div>
                    <div class="py-3 grid grid-cols-3"><dt class="font-medium text-gray-500">Availability</dt><dd class="col-span-2 text-gray-900">{{ $book->availability_status }}</dd></div>
                    <div class="py-3 grid grid-cols-3"><dt class="font-medium text-gray-500">Description</dt><dd class="col-span-2 text-gray-900">{{ $book->description }}</dd></div>
                    <div class="py-3 grid grid-cols-3"><dt class="font-medium text-gray-500">Added By</dt><dd class="col-span-2 text-gray-900">{{ $book->user?->name }}</dd></div>
                </dl>

                <div class="flex items-center justify-end gap-4 pt-4 border-t">
                    <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Edit</a>
                    <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Are you sure you want to delete this book?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Delete') }}</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection