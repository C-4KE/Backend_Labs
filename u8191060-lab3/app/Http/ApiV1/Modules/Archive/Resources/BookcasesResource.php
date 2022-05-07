<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class BookcasesResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return ['data' => $this->resource];
    }
}