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
            'id' => 'required|max:3',
            'currency_name' => 'required|unique:currency_codes|max:20',
            'currency_symbol' => 'required|max:4',
            'exchange_rate' => 'required|numeric'
        ];
    }
}
