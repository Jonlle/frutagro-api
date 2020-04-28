<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'role_id' => 'required|max:8',
            'status_id' => 'required|max:2',
            'name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('user_emails')->ignore($this->route('user')),
            ],
        ];
    }
}


