<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class BookcaseResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return ['data' => [
            'id' => $this->id,
            'code' => $this->code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]];
    }
}