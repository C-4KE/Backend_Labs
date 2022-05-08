<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Book;

class PatchBookAction
{
    public function execute(int $bookId, array $fields) : Book
    {
        $book = Book::findOrFail($bookId);
        $book->update($fields);
        return $book;
    }
}