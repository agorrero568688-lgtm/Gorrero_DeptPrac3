<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', Rule::in(Book::CATEGORIES)],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'availability_status' => ['required', 'string', Rule::in(Book::AVAILABILITY_STATUSES)],
        ];
    }

    public function messages(): array
    {
        return [
            'unit_price.numeric' => 'Unit price must be a valid number.',
            'unit_price.min' => 'Unit price cannot be negative.',
            'category.in' => 'Choose Fiction, Nonfiction, Academic, or Children\'s Books.',
            'availability_status.in' => 'Choose Available or Unavailable.',
        ];
    }
}