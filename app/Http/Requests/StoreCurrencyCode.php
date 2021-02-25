<?php

namespace App\Http\Requests;

class StoreCurrencyCode extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'max:3'],
            'currency_name' => ['required', 'string', 'max:20', 'unique:currency_codes'],
            'currency_symbol' => ['required', 'string', 'max:4'],
            'exchange_rate' => ['required', 'numeric', 'between:-999999999.99,999999999.99'],
            'default' => ['nullable', 'string', 'max:1'],
            'status_id' => ['nullable', 'string', 'max:2'],
        ];
    }
}
