<?php

namespace App\Http\ApiV1\Modules\Archive\Controllers;

use App\Domain\Archive\Actions\GetBookcasesAction;
use App\Http\ApiV1\Modules\Archive\Resources\BookcasesResource;

class BookcasesController
{
    public function get(GetBookcasesAction $action)
    {
        return new BookcasesResource($action->execute());
    }
}