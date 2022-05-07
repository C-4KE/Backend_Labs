<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class ErrorResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return ['error' => [
            'code' => $this[0],
            'message' => $this[1]
        ]];
    }
}