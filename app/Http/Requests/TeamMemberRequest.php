<?php

namespace App\Http\Requests;

class TeamMemberRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'position' => ['required', 'string'],
            'description' => ['required', 'string'],
            'file_image' => ['nullable', 'string'],
            'file_path' => ['nullable', 'string'],
        ];
    }
}
