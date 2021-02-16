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
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'bank_data' => new BankDataCollection($this->bank_data),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
