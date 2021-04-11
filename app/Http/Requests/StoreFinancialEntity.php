<?php

namespace App\Http\Requests;

class StoreFinancialEntity extends FormRequest
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
            'code' => 'required|numeric|max:4|unique:financial_entities',
            'entity_name' => 'required|string',
            'status_id' => 'max:2'
        ];
    }
}
