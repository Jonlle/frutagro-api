<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class MissionVisionUpdateRequest extends FormRequest
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
            'section_name' => ['required', 'string', Rule::unique('information_texts')->ignore($this->route('mission_vision'))],
            'information_text' => ['required', 'string'],
            'status_id' => ['max:2'],
            'tags.*' => ['string'],
            'tags' => ['required', 'array'],
        ];
    }
}
