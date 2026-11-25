@extends('layouts.bookstore')

@section('header')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Book Inventory Reports') }}</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('reports.export.pdf', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Export PDF
            </a>
            <a href="{{ route('reports.export.excel', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Export Excel (.xlsx)
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex flex-wrap gap-2 border-b pb-4">
                    <a href="{{ route('reports.index') }}" class="px-3 py-1.5 rounded-md text-xs font-semibold uppercase border {{ $selectedCategory === '' && $selectedStatus === '' ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 border-gray-300' }}">Book Price List</a>
                    <a href="{{ route('reports.index', ['availability_status' => 'Available']) }}" class="px-3 py-1.5 rounded-md text-xs font-semibold uppercase border {{ $selectedStatus === 'Available' && $selectedCategory === '' ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 border-gray-300' }}">Available Books</a>
                    <a href="{{ route('reports.index', ['availability_status' => 'Unavailable']) }}" class="px-3 py-1.5 rounded-md text-xs font-semibold uppercase border {{ $selectedStatus === 'Unavailable' && $selectedCategory === '' ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 border-gray-300' }}">Unavailable Books</a>
                </div>

                <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" @selected($selectedCategory === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="availability_status" :value="__('Availability Status')" />
                        <select id="availability_status" name="availability_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Statuses</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <x-primary-button>{{ __('Filter') }}</x-primary-button>
                        <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                            Reset Filters
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $reportTitle }} ({{ $books->count() }})</h3>

                @if ($books->isEmpty())
                    <p class="text-sm text-gray-600">No book records match the selected filters.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Availability</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($books as $book)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $book->title }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ $book->author }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ $book->category }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-900 text-right">PHP {{ number_format((float) $book->unit_price, 2) }}</td>
                                    <td class="px-4 py-4 text-sm">{{ $book->availability_status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection