<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSupplier extends FormRequest
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
            'status_id' => 'max:2',
            'supplier_name' => 'required|string|max:40',
            'contact_name' => 'required|string|max:100',
            'contact_title' => 'string|max:100',
            'document_type_id' => [
                'nullable',
                Rule::in(['ci', 'rif', 'p']),
            ],
            'document' => 'nullable|min:7|max:10|regex:/^[VEPJG][1-9]\d{5,8}$/',
            'address' => 'string|max:200',
            'phone' => 'nullable|string|max:11',
            'email' => 'nullable|email'
        ];
    }
}
