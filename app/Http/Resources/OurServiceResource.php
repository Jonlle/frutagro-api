<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OurServiceResource extends JsonResource
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
            'icon_name' => $this->icon_name,
            'service_name' => $this->service_name,
            'description' => $this->description,
        ];
    }
}
