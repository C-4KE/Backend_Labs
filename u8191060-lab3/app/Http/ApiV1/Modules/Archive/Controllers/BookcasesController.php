<?php

namespace App\Http\ApiV1\Modules\Archive\Controllers;

use App\Domain\Archive\Actions\ErrorAction;
use App\Domain\Archive\Actions\GetBookcaseAction;
use App\Domain\Archive\Actions\GetBookcasesAction;
use App\Http\ApiV1\Modules\Archive\Requests\GetBookcaseIncludeRequest;
use App\Http\ApiV1\Modules\Archive\Resources\BookcaseIncludeResource;
use App\Http\ApiV1\Modules\Archive\Resources\BookcaseResource;
use App\Http\ApiV1\Modules\Archive\Resources\BookcasesResource;
use App\Http\ApiV1\Modules\Archive\Resources\ErrorResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookcasesController
{
    public function get(GetBookcasesAction $action)
    {
        return new BookcasesResource($action->execute());
    }

    public function getById($bookcaseId, GetBookcaseAction $action, GetBookcaseIncludeRequest $request)
    {
        try {
            if (is_numeric($bookcaseId)) {
                if ($request->query('include') == null) {
                    return new BookcaseResource($action->execute($bookcaseId));
                } else {
                    return new BookcaseIncludeResource($action->execute($bookcaseId, $request->validated()));
                }
            } else {
                return (new ErrorResource((new ErrorAction)->execute('CastingError', 'Invalid id. Id must be integer number.')))->response()->setStatusCode(400);
            }
        } catch (ModelNotFoundException $exc) {
            return (new ErrorResource((new ErrorAction)->execute(get_class($exc), 'Item with given id was not found.')))->response()->setStatusCode(404);
        }
    }
}