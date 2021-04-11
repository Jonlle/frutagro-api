<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateCustomer extends FormRequest
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
            'username' => [
                'max:15',
                Rule::unique('users')->ignore($this->route('customer')),
            ],
            'document_type_id' => [
                Rule::in(['ci', 'rif', 'p']),
            ],
            'role_id' => 'required',
            'status_id' => 'max:2',
            'name' => 'required|max:100',
            'document' => [
                'min:7',
                'max:10',
                'regex:/^[VEPJG][1-9]\d{5,8}$/',
                Rule::unique('users')->ignore($this->route('customer')),
            ],
            'email' => [
                'email',
                'different:alternate_email',
                Rule::unique('user_emails')->ignore($this->route('customer'), 'user_id'),
            ],
            'alternate_email' => [
                'nullable',
                'email',
                'different:email',
                Rule::unique('user_emails', 'email')->ignore($this->route('customer'), 'user_id'),
            ],
            'phone' => [
                'required',
                'string',
                'different:alternate_phone',
                Rule::unique('user_phones', 'phone_number')->ignore($this->route('customer'), 'user_id'),
            ],
            'alternate_phone' => [
                'nullable',
                'string',
                'different:phone',
                Rule::unique('user_phones', 'phone_number')->ignore($this->route('customer'), 'user_id'),
            ]
        ];
    }
}
