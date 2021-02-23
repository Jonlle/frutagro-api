<?php

namespace App\Http\Requests;

class InformationTextStoreRequest extends FormRequest
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
            'section_name' => ['required', 'string'],
            'information_text' => ['required', 'string'],
            'status_id' => ['nullable', 'string', 'max:2'],
        ];
    }
}
