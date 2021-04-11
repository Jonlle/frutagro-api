<?php

namespace App\Http\Requests;

class MissionVisionStoreRequest extends FormRequest
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
            'section_name' => ['required', 'string', 'unique:information_texts'],
            'information_text' => ['required', 'string'],
            'status_id' => ['max:2'],
            'tags.*' => ['string'],
            'tags' => ['array']
        ];
    }
}
