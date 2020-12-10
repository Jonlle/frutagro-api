<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreAdminPaymentMethod extends FormRequest
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
            'financial_entity_id' => 'nullable',
            'target_acount' => 'numeric|nullable',
            'document_type_id' => [
                'nullable',
                Rule::in(['ci', 'rif', 'p']),
            ],
            'document' => 'nullable|min:7|max:10|regex:/^[VEPJG][1-9]\d{5,8}$/',
            'target_name' => 'string|nullable',
            'file_image' => 'nullable',
            'file_path' => 'nullable',
            'status_id' => 'max:2',
        ];
    }
}
