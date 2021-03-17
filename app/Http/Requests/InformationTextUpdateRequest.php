<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
class InformationTextUpdateRequest extends FormRequest
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
            'section_name' => ['required', 'string', Rule::unique('information_texts')->ignore($this->route('information_text'))],
            'information_text' => ['nullable', 'string'],
            'status_id' => ['nullable', 'string', 'max:2'],
        ];
    }
}
