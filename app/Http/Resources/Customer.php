<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
            'username' => $this->username,
            'role' => $this->role->name,
            'status' => $this->status_id,
            'name' => $this->name,
            'email' => $this->user_emails,
            'doc_type' => $this->document_type_id,
            'document' => $this->document,
            'avatar' => $this->avatar,
            'phone' => $this->user_phones,
            'address' => new AddressCollection($this->user_addresses),
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
