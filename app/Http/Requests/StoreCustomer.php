<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreCustomer extends FormRequest
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
            'username' => 'required|alpha_num|min:6|max:10|unique:users',
            'document_type_id' => [
                'required',
                Rule::in(['ci', 'rif', 'p']),
            ],
            'role_id' => 'required',
            'status_id' => 'max:2',
            'name' => 'required|max:100',
            'document' => 'required|min:7|max:10|regex:/^[VEPJG][1-9]\d{5,8}$/|unique:users',
            'email' => 'required|email|unique:user_emails',
            'password' => 'required|max:12'
        ];
    }
}
