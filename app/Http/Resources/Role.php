<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Role extends JsonResource
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
            'description' => $this->description,
            'status' => $this->status->description,
            'permissions' => Permission::collection($this->permissions)
        ];
    }
}