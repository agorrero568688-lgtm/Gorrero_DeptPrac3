<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::with('user')->latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        return view('books.create', [
            'categories' => Book::CATEGORIES,
            'statuses' => Book::AVAILABILITY_STATUSES,
        ]);
    }

    public function store(BookRequest $request): RedirectResponse
    {
        // Assign user_id on the server from the logged-in administrator
        $request->user()->books()->create($request->validated());

        return redirect()->route('books.index')->with('status', 'Book added successfully.');
    }

    public function show(Book $book): View
    {
        $book->load('user');

        return view('books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
            'categories' => Book::CATEGORIES,
            'statuses' => Book::AVAILABILITY_STATUSES,
        ]);
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()->route('books.index')->with('status', 'Book updated successfully.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('books.index')->with('status', 'Book deleted successfully.');
    }
}