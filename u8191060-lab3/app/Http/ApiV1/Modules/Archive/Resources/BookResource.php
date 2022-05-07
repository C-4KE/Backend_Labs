<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class BookResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return ['data' => [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'release_date' => $this->release_date,
            'bookcase_id' => $this->bookcase_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]];
    }
}