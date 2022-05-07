<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Book;

class GetBookAction
{
    public function execute(int $bookId): Book
    {
        $book = Book::findOrFail($bookId);
        return $book;
    }
}