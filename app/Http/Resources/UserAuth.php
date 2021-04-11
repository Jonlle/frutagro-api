<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuth extends JsonResource
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
            'email' => $this->user_emails->where('principal', '1')->first()->email,
            "password" => $this->getAuthPassword(),
            'avatar' => $this->avatar,
            "remember_token" => $this->getRememberToken(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
