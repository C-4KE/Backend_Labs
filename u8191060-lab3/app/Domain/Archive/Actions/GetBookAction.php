<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Book;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetBookAction
{
    public function execute(int $bookId): Book
    {
        try {
            $book = Book::findOrFail($bookId);
            return $book;
        } catch (Exception $exc) {
            throw new ModelNotFoundException();
        }
    }
}