@extends('layouts.bookstore')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Book Inventory') }}</h2>
        <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            {{ __('Add Book') }}
        </a>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600 bg-white shadow-sm sm:rounded-lg p-4">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    @if ($books->isEmpty())
                        <p class="text-sm text-gray-600">{{ __('No book records found.') }}</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Availability</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $book->title }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-600">{{ $book->author }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-600">{{ $book->category }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-900 text-right">PHP {{ number_format((float) $book->unit_price, 2) }}</td>
                                        <td class="px-4 py-4 text-sm">
                                            <span class="px-2 inline-flex text-xs font-semibold rounded-full {{ $book->availability_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $book->availability_status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-right space-x-2">
                                            <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                            <a href="{{ route('books.edit', $book) }}" class="text-gray-600 hover:text-gray-900">Edit</a>
                                            <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">{{ $books->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection