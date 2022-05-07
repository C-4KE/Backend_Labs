<?php

namespace App\Http\ApiV1\Modules\Archive\Resources;

use App\Domain\Archive\Actions\GetBooksInIncludeAction;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class BookcaseIncludeResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return ['data' => [
            'id' => $this->id,
            'code' => $this->code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'books' => new BooksInIncludeResource((new GetBooksInIncludeAction)->execute($this->id)),
        ]];
    }
}