<?php

namespace App\Http\Requests;

class StoreDeliveryMethod extends FormRequest
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
            'name' => ['required', 'string', 'max:30', 'unique:delivery_methods'],
            'price' => ['required', 'numeric', 'between:0.00,999999999.99'],
            'description' => ['nullable', 'string'],
            'status_id' => ['nullable', 'string', 'max:2'],
        ];
    }
}
