<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class EmptyResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return ['data' => null];
    }
}