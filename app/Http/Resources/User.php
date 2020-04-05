<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'doc_type_id' => $this->doc_type_id,
            'role_id' => $this->role_id,
            'status_id' => $this->status_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'document' => $this->document,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
