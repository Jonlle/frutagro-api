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
        $code = 422;
        $failed_rules = $validator->failed();
        $messages = (new ValidationException($validator))->errors();

        foreach ($failed_rules as $attribute => $rules) {
            foreach ($rules as $key => $rule) {
                if ($key == 'Unique') {
                    $code = 409;
                    break 2;
                }
            }
        }

        $error = new \stdClass();
        $error->code = $code;
        $error->message = 'The given data was invalid.';
        $error->failed_rules = $failed_rules;
        $error->messages = $messages;

        $response = [
            'success' => false,
            'error' => $error
        ];

        Log::debug('Failed Validation: '.json_encode($error, JSON_UNESCAPED_UNICODE));

        throw new HttpResponseException(response()->json($response, $code));
    }

    protected function failedAuthorization()
    {
        $code = 403;

        $error = new \stdClass();
        $error->code = $code;
        $error->message = "Access denied. You are not authorized for this action.";

        $response = [
            'success' => false,
            'error' => $error
        ];

        if (session()->has('failedAuthorizationMsg')) {
            Log::debug('Failed Authorization: '.session('failedAuthorizationMsg'));
        }

        Log::debug('Failed Authorization: '.json_encode($error, JSON_UNESCAPED_UNICODE));

        throw new HttpResponseException(response()->json($response, $code));
    }

}
