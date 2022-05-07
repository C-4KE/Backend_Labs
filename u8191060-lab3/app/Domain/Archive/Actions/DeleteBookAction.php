<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Book;
use Exception;

class DeleteBookAction
{
    public function execute(int $bookId)
    {
        try {
            $book = Book::findOrFail($bookId);
            Book::destroy($bookId);
        } catch (Exception $exc) { }
    }
}