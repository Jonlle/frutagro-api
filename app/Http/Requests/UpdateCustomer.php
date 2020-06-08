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
                'required',
                'max:10',
                Rule::unique('users')->ignore($this->route('customer')),
            ],
            'doc_type_id' => [
                'required',
                Rule::in(['ci', 'rif', 'p']),
            ],
            'role_id' => 'required|max:8',
            'status_id' => 'max:2',
            'name' => 'required|max:100',
            'document' => [
                'required',
                'min:7',
                'max:10',
                'regex:/^[VEPJG][1-9]\d{5,8}$/',
                Rule::unique('users')->ignore($this->route('customer')),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('user_emails')->ignore($this->route('customer'), 'user_id'),
            ]
        ];
    }
}
