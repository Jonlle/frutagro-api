<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
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

        $rules_errors = [];
        foreach ($validator->failed() as $attribute => $rules) {
            foreach ($rules as $key => $rule) {
                $rules_errors[$attribute] =  strtolower($key);
                if ($key == 'Unique') {
                    $code = 409;
                }
            }
        }
        $response['rules'] = $rules_errors;
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
