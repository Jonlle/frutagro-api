<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateCurrencyCode extends FormRequest
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
            'currency_name' => [
                'required',
                'max:10',
                Rule::unique('currency_codes')->ignore($this->route('currency')),
            ],
            'exchange_rate' => 'required|numeric'
        ];
    }
}
