<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $reportTitle }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1f2937; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
        th { background: #f9fafb; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <h2>Bookstore Inventory — {{ $reportTitle }}</h2>
    <p>Generated: {{ $generatedAt }} | Category: {{ $selectedCategory ?: 'All' }} | Status: {{ $selectedStatus ?: 'All' }}</p>

    @if ($books->isEmpty())
        <p>No book records match the selected filters.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th class="right">Unit Price (PHP)</th>
                    <th>Availability Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category }}</td>
                        <td class="right">PHP {{ number_format((float) $book->unit_price, 2) }}</td>
                        <td>{{ $book->availability_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>