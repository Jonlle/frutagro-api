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
            'role' => $this->role_id,
            'status' => $this->status->description,
            'name' => $this->name,
            'email' => $this->user_emails->where('principal', '1')->first()->email,
            'doc_type' => $this->doc_type_id,
            'document' => $this->document,
            'avatar' => $this->avatar,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
