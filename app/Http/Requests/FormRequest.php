<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

class FormRequest extends LaravelFormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $code = 422;
        $response = [
            'success' => false,
            'message' => 'The given data was invalid.',
            'errors' => $errors
        ];

        foreach ($validator->failed() as $attribute => $rules) {
            foreach ($rules as $key => $rule) {
                if ($key == 'Unique') {
                    $code = 409;
                    break 2;
                }
            }
        }
        throw new HttpResponseException(response()->json($response, $code));
    }

    protected function failedAuthorization()
    {
        $response = [
            'success' => false,
            'message' => "Access denied. You don't have permission for this action."
        ];
        throw new HttpResponseException(response()->json($response, 403));
    }

}
