<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class BooksInIncludeResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return $this->resource;
    }
}