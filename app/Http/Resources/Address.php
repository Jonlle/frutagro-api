<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->address_type_id,
            'postal_code' => $this->postal_code,
            'state' => $this->state->estado,
            'city' => $this->city->ciudad,
            'address' => $this->address,
            'reference_point' => $this->reference_point
        ];
    }
}
