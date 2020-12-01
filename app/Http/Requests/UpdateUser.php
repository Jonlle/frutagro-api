<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

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
                Rule::unique('users')->ignore($this->route('admin')),
            ],
            'role_id' => 'required',
            'status_id' => 'max:2',
            'name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('user_emails')->ignore($this->route('admin'), 'user_id'),
            ],
            'remember_token' => 'string|nullable',
        ];
    }
}


