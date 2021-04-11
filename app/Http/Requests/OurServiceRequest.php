<?php

namespace App\Http\Requests;

class OurServiceRequest extends FormRequest
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
            'icon_name' => ['required', 'string'],
            'service_name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }
}
