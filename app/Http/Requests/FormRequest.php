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
        $response = [
            'success' => false,
            'message' => 'Validation error.',
            'errors' => $errors
        ];

        throw new HttpResponseException(response()->json($response, 422));
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
