<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralBannerResource extends JsonResource
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
            'section' => $this->section,
            'title' => $this->title,
            'slug' => $this->slug,
            'file_image' => $this->file_image,
            'file_path' => $this->file_path,
        ];
    }
}
