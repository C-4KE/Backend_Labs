<?php

namespace App\Http\ApiV1\Modules\Archive\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PostBookRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['exclude'],
            'title' => ['string'],
            'author' => ['string'],
            'publisher' => ['string'],
            'release_date' => ['date'],
            'bookcase_id'=> ['integer']
        ];
    }
}