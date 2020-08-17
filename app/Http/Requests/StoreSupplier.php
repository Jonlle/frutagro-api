<?php

namespace App\Http\Requests;

class StoreSupplier extends FormRequest
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
            'address' => 'string|max:200',
            'code_postal' => 'string|max:5',
            'city' => 'string|max:50',
            'country' => 'string|max:15',
            'phone' => 'string|max:11',
            'fax' => 'string|max:11',
            'email' => 'required|email|unique:suppliers'
        ];
    }
}
