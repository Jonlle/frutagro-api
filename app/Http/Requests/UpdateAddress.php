<?php

namespace App\Http\Requests;

class UpdateAddress extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \App\User::findOrFail($this->route('customer'));

        if ($user->role_id != 3 && $user->role_id != 4) {
            session()->flash('failedAuthorizationMsg', 'User is not a customer.');
            return false;
        }

        $address = \App\UserAddress::findOrFail($this->route('address'));

        if ($address->user_id != $user->id) {
            session()->flash('failedAuthorizationMsg', 'UserAddress does not belong to this user.');
            return false;
        }

        session()->flash('address', $address);

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
