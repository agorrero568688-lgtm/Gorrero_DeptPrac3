<?php

namespace App\Http\Controllers;

use App\Exports\BooksReportExport;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $this->getFilters($request);
        $books = $this->filteredQuery($filters)->get();

        return view('reports.index', [
            'books' => $books,
            'categories' => Book::CATEGORIES,
            'statuses' => Book::AVAILABILITY_STATUSES,
            'selectedCategory' => $filters['category'],
            'selectedStatus' => $filters['availability_status'],
            'reportTitle' => $this->reportHeading($filters),
        ]);
    }

    public function exportPdf(Request $request): Response
    {
        $filters = $this->getFilters($request);
        $books = $this->filteredQuery($filters)->get();

        $pdf = Pdf::loadView('reports.pdf', [
            'books' => $books,
            'reportTitle' => $this->reportHeading($filters),
            'selectedCategory' => $filters['category'],
            'selectedStatus' => $filters['availability_status'],
            'generatedAt' => now()->format('F d, Y h:i A'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('bookstore-inventory-report.pdf');
    }

    public function exportExcel(Request $request): BinaryFileResponse
    {
        $filters = $this->getFilters($request);
        $books = $this->filteredQuery($filters)->get();

        return Excel::download(new BooksReportExport($books), 'bookstore-inventory-report.xlsx');
    }

    private function getFilters(Request $request): array
    {
        $category = (string) $request->query('category', '');
        $status = (string) $request->query('availability_status', '');

        if (! in_array($category, Book::CATEGORIES, true)) {
            $category = '';
        }

        if (! in_array($status, Book::AVAILABILITY_STATUSES, true)) {
            $status = '';
        }

        return [
            'category' => $category,
            'availability_status' => $status,
        ];
    }

    // Shared query so on-screen results, PDF, and Excel always match
    private function filteredQuery(array $filters): Builder
    {
        return Book::query()
            ->when($filters['category'] !== '', fn (Builder $q) => $q->where('category', $filters['category']))
            ->when($filters['availability_status'] !== '', fn (Builder $q) => $q->where('availability_status', $filters['availability_status']))
            ->orderBy('title');
    }

    private function reportHeading(array $filters): string
    {
        if ($filters['category'] !== '' && $filters['availability_status'] !== '') {
            return $filters['availability_status'].' '.$filters['category'].' Books';
        }
        if ($filters['category'] !== '') {
            return 'Books by Category: '.$filters['category'];
        }
        if ($filters['availability_status'] !== '') {
            return $filters['availability_status'].' Books Report';
        }

        return 'Book Price List';
    }
}