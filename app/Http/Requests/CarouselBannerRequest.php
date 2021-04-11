<?php

namespace App\Http\Requests;

class CarouselBannerRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'title_color' => ['nullable', 'string'],
            'description' => ['nullable', 'string', 'max:50'],
            'description_color' => ['nullable', 'string'],
            'file_image' => ['nullable', 'string'],
            'file_path' => ['nullable', 'string'],
            'status_id' => ['nullable', 'string', 'max:2'],
        ];
    }
}
