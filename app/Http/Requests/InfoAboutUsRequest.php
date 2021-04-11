<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class InfoAboutUsRequest extends FormRequest
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
            'section' => ['required', 'string', Rule::unique('info_about_us')->ignore($this->route('info_about_u'))],
            'title' => ['required', 'string'],
            'info_text' => ['required', 'string'],
            'file_image' => ['nullable', 'string'],
            'file_path' => ['nullable', 'string'],
        ];
    }
}
