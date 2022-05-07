<?php

namespace App\Http\ApiV1\Modules\Archive\Controllers;

use App\Domain\Archive\Actions\GetBookAction;
use App\Domain\Archive\Actions\GetBooksAction;
use App\Domain\Archive\Actions\ErrorAction;
use App\Http\ApiV1\Modules\Archive\Resources\BookResource;
use App\Http\ApiV1\Modules\Archive\Resources\BooksResource;
use App\Http\ApiV1\Modules\Archive\Resources\ErrorResource;
use Exception;

class BooksController
{
    public function getById($bookId, GetBookAction $action)
    {
        try
        {
            $bookId = (int) $bookId;
            return new BookResource($action->execute($bookId));
        }
        catch (Exception $exc)
        {
            return $this->error(400, 'Invalid id. Id must be integer number.', new ErrorAction());
        }
    }

    public function get(GetBooksAction $action)
    {
        return new BooksResource($action->execute());
    }

    public function error(int $code, string $message, ErrorAction $action)
    {
        return new ErrorResource($action->execute($code, $message));
    }
}