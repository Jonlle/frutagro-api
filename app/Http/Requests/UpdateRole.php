<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

class UpdateRole extends FormRequest
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
            'id' => [
                'required',
                'max:20',
                Rule::unique('roles')->ignore($this->route('role')),
            ],
            'status_id' => 'max:2',
            'description' => 'required|max:50',
            'permissions.*' => 'integer',
            'permissions' => 'required|array'
        ];
    }
}
