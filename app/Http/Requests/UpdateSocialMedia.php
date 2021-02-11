<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSocialMedia extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique('social_media')->ignore($this->route('social_medium')),
            ],
            'url' => 'required_if:status_id,en|url|nullable',
            'status_id' => 'max:2',
        ];
    }
}
