<?php

namespace App\Http\ApiV1\Modules\Archive\Controllers;

use App\Domain\Archive\Actions\DeleteBookAction;
use App\Domain\Archive\Actions\GetBookAction;
use App\Domain\Archive\Actions\GetBooksAction;
use App\Domain\Archive\Actions\ErrorAction;
use App\Domain\Archive\Actions\PatchBookAction;
use App\Domain\Archive\Actions\PostBookAction;
use App\Domain\Archive\Actions\PutBookAction;
use App\Http\ApiV1\Modules\Archive\Requests\PatchBookRequest;
use App\Http\ApiV1\Modules\Archive\Requests\PutBookRequest;
use App\Http\ApiV1\Modules\Archive\Requests\PostBookRequest;
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

    public function post(PostBookRequest $request, PostBookAction $action)
    {
        try {
            return new BookResource($action->execute($request->validated()));
        } catch (Exception $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), $exc->getMessage())))->response()->setStatusCode(400);
        }
    }

    public function patch($bookId, PatchBookRequest $request, PatchBookAction $action)
    {
        try {
            if (is_numeric($bookId)) {
                return new BookResource($action->execute($bookId, $request->validated()));
            } else {
                return (new ErrorResource((new ErrorAction)->execute('CastingError', 'Invalid id. Id must be integer number.')))->response()->setStatusCode(400);
            }
        } catch (ModelNotFoundException $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), 'Item with given id was not found.')))->response()->setStatusCode(404);
        } catch (Exception $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), $exc->getMessage())))->response()->setStatusCode(400);
        }
    }

    public function put($bookId, PutBookRequest $request, PutBookAction $action)
    {
        try {
            if (is_numeric($bookId)) {
                return new BookResource($action->execute($bookId, $request->validated()));
            } else {
                return (new ErrorResource((new ErrorAction)->execute('CastingError', 'Invalid id. Id must be integer number.')))->response()->setStatusCode(400);
            }
        } catch (ModelNotFoundException $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), 'Item with given id was not found.')))->response()->setStatusCode(404);
        } catch (Exception $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), $exc->getMessage())))->response()->setStatusCode(400);
        }
    }
}