<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attributes = $this->product_attributes;

        return [
            'id' => $this->id,
            'category' => $this->category->category_name,
            'name' => $this->product_name,
            'slug' => $this->slug,
            'description' => $this->description,
            'file_image' => $this->file_image,
            'file_path' => $this->file_path,
            'tags' => $this->tags,
            'attributes' => $this->product_attributes,
            'currency' => $this->currency_code->currency_symbol,
            'status' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
