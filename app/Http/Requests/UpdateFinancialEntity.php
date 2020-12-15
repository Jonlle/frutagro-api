<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateFinancialEntity extends FormRequest
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
            'code' => [
                'required',
                'numeric',
                'digits:4',
                Rule::unique('financial_entities')->ignore($this->route('financial_entity')),
            ],
            'entity_name' => [
                'required',
                'string',
                Rule::unique('financial_entities')->ignore($this->route('financial_entity')),
            ],
            'status_id' => 'max:2'
        ];
    }
}
