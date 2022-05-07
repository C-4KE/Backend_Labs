<?php

namespace App\Http\ApiV1\Modules\Archive\Controllers;

use App\Domain\Archive\Actions\GetBookAction;
use App\Domain\Archive\Actions\GetBooksAction;
use App\Http\ApiV1\Modules\Archive\Resources\BookResource;
use App\Http\ApiV1\Modules\Archive\Resources\BooksResource;

class BooksController
{
    public function getById(int $bookId, GetBookAction $action)
    {
        return new BookResource($action->execute($bookId));
    }

    public function get(GetBooksAction $action)
    {
        return new BooksResource($action->execute());
    }
}