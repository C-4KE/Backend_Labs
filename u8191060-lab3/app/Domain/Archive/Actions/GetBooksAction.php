<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Book;

class GetBooksAction
{
    public function execute()
    {
        return Book::all();
    }
}