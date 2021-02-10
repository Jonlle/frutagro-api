<?php

namespace App\Http\Requests;

class StoreSocialMedia extends FormRequest
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
            'icon_name' => 'string',
            'icon_size' => 'string',
            'name' => 'required|string|unique:social_media',
            'url' => 'nullable',
            'status_id' => 'max:2',
        ];
    }
}
