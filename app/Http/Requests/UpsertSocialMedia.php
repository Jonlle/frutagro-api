<?php

namespace App\Http\Requests;

class UpsertSocialMedia extends FormRequest
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
            'social_media.*.icon_name' => 'string',
            'social_media.*.icon_size' => 'string',
            'social_media.*.name' => 'required|string',
            'social_media.*.url' => 'required_if:status_id,en|url|nullable',
            'social_media.*.status_id' => 'required|max:2',
        ];
    }
}
