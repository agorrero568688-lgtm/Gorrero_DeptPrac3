<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(private Collection $books)
    {
    }

    public function collection(): Collection
    {
        return $this->books;
    }

    public function headings(): array
    {
        return ['Book Title', 'Author', 'Category', 'Unit Price (PHP)', 'Availability Status', 'Description'];
    }

    public function map($book): array
    {
        return [
            $book->title,
            $book->author,
            $book->category,
            number_format((float) $book->unit_price, 2),
            $book->availability_status,
            $book->description,
        ];
    }
}