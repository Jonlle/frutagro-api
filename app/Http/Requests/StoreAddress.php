<?php

namespace App\Http\Requests;

class StoreAddress extends FormRequest
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
            'address_type_id' => 'required',
            'postal_code'     => 'required|max:4',
            'state_id'        => 'required',
            'city_id'         => 'required',
            'address'         => 'required|max:200',
            'reference_point' => 'max:100',
            'status_id'       => 'max:2'
        ];
    }
}
