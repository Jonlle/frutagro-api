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
            'doc_type' => $this->document_type_id,
            'document' => $this->document,
            'postal_code' => $this->postal_code,
            'state' => $this->state_id,
            'city' => $this->city_id,
            'address' => $this->address,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
