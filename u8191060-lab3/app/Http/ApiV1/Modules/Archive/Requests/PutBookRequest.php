<?php

namespace App\Http\ApiV1\Modules\Archive\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PutBookRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['exclude'],
            'title' => ['string', 'required'],
            'author' => ['string', 'required'],
            'publisher' => ['string', 'required'],
            'release_date' => ['date', 'required'],
            'bookcase_id'=> ['integer', 'required']
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errorsArray = [];
        $counter = 0;
        foreach ($validator->errors()->keys() as $key)
        {
            $errorsArray[$counter] = ['code' => 'ValidationException', 'message' => 'The '.$key.' field is required.'];
            $counter++;
        }
        $response = new Response(['error' => $errorsArray], 400);
        throw new ValidationException($validator, $response);
    }
}