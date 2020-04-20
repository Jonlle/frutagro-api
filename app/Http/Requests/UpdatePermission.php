<?php

namespace App\Http\Requests;

use App\Permission;
use Illuminate\Validation\Rule;

class UpdatePermission extends FormRequest
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
        $permission = Permission::find($this->route('permission'));

        return [
            'name' => [
                'required',
                'max:40',
                Rule::unique('permissions')->ignore($permission->id),
            ],
            'status_id' => 'required|max:2'
        ];
    }
}
