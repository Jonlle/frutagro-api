<?php

namespace App\Http\Requests;

class GeneralBannerStoreRequest extends FormRequest
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
            'section' => ['required', 'string'],
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'file_image' => ['nullable', 'string'],
            'file_path' => ['nullable', 'string'],
        ];
    }
}
