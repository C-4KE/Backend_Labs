<?php

namespace App\Http\ApiV1\Modules\Archive\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class GetBookcaseIncludeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'include' => ['regex:/^books$/i']
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(['error' => ['code' => 'ValidationException', 'message' => 'Include value mismatching with \'books\'.']], 400);
        throw new ValidationException($validator, $response);
    }
}