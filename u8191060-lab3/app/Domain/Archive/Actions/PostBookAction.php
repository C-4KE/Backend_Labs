<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Book;

class PostBookAction
{
    public function execute(array $fields): Book
    {
        return Book::create($fields);
    }
}