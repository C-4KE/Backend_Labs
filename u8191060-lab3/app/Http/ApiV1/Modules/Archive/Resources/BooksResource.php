<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class BooksResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return ['data' => $this->resource];
    }
}