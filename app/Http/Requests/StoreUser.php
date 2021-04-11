<?php

namespace App\Http\Requests;

class StoreUser extends FormRequest
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
            'username' => 'required|unique:users|max:15',
            'role_id' => 'required',
            'status_id' => 'max:2',
            'name' => 'required|max:100',
            'email' => 'required|email|unique:user_emails',
            'password' => 'required|max:12'
        ];
    }
}

