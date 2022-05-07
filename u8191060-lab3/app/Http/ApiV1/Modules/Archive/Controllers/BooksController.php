<?php

namespace App\Http\ApiV1\Modules\Archive\Controllers;

use App\Domain\Archive\Actions\DeleteBookAction;
use App\Domain\Archive\Actions\GetBookAction;
use App\Domain\Archive\Actions\GetBooksAction;
use App\Domain\Archive\Actions\ErrorAction;
use App\Http\ApiV1\Modules\Archive\Resources\BookResource;
use App\Http\ApiV1\Modules\Archive\Resources\BooksResource;
use App\Http\ApiV1\Modules\Archive\Resources\EmptyResource;
use App\Http\ApiV1\Modules\Archive\Resources\ErrorResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController
{
    public function getById($bookId, GetBookAction $action)
    {
        try {
            if (is_numeric($bookId)) {
                return new BookResource($action->execute($bookId));
            } else {
                return (new ErrorResource((new ErrorAction)->execute('CastingError', 'Invalid id. Id must be integer number.')))->response()->setStatusCode(400);
            }
        } catch (ModelNotFoundException $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), 'Item with given id was not found.')))->response()->setStatusCode(404);
        } catch (Exception $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), 'Unexpected error.')))->response()->setStatusCode(500);
        }
    }

    public function get(GetBooksAction $action)
    {
        return new BooksResource($action->execute());
    }

    public function delete($bookId, DeleteBookAction $action)
    {
        if (is_numeric($bookId)) {
            return new EmptyResource($action->execute($bookId));
        } else {
            return (new ErrorResource((new ErrorAction)->execute('CastingError', 'Invalid id. Id must be integer number.')))->response()->setStatusCode(400);
        }
    }

    public function error(string $code, string $message, ErrorAction $action)
    {
        return new ErrorResource($action->execute($code, $message));
    }
}