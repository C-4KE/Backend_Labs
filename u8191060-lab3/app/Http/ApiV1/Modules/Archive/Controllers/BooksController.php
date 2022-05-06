<?php

namespace App\Http\ApiV1\Modules\Archive\Controllers;

use App\Domain\Archive\Actions\GetBookAction;
use App\Http\ApiV1\Modules\Archive\Resources\BookResource;

class BooksController
{
    public function getById(int $bookId, GetBookAction $action)
    {
        return new BookResource($action->execute($bookId));
    }
}