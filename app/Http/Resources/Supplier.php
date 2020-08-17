<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Supplier extends JsonResource
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
            'status' => $this->status_id,
            'name' => $this->supplier_name,
            'contact_name' => $this->contact_name,
            'contact_title' => $this->contact_title,
            'address' => $this->address,
            'code_postal' => $this->code_postal,
            'city' => $this->city,
            'country' => $this->country,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
