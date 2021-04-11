<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreBankData extends FormRequest
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
            'payment_type_id' => 'required',
            'financial_entity_id' => 'required',
            'supplier_id' => 'nullable',
            'target_acount' => 'required|numeric',
            'document_type_id' => [
                'required',
                Rule::in(['ci', 'rif', 'p']),
            ],
            'document' => 'required|min:7|max:10|regex:/^[VEPJG][1-9]\d{5,8}$/',
            'target_name' => 'required|string',
            'file_image' => 'nullable',
            'file_path' => 'nullable',
            'status_id' => 'max:2',
        ];
    }
}
