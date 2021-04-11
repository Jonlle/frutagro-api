<?php

namespace App\Http\Requests;

class StoreCategory extends FormRequest
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
            'category_name' => 'required|string|unique:categories|max:25',
            'description' => 'nullable|max:50',
            'status_id' => 'max:2',
        ];
    }
}
