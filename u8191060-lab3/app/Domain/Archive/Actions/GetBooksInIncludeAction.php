<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Book;

class GetBooksInIncludeAction
{
    public function execute(int $bookcaseId)
    {
        return Book::where('bookcase_id', $bookcaseId)->get();
    }
}