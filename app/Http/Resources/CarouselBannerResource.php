<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarouselBannerResource extends JsonResource
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
            'title' => $this->title,
            'title_color' => $this->title_color,
            'description' => $this->description,
            'description_color' => $this->description_color,
            'file_image' => $this->file_image,
            'file_path' => $this->file_path,
            'status' => $this->status_id,
        ];

    }
}
