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
        return [
            'id' => $this->id,
            'category' => $this->category->category_name,
            'sku' => $this->sku,
            'name' => $this->product_name,
            'slug' => $this->slug,
            'stock' => $this->stock,
            'unit_name' => $this->unit_name,
            'unit_cant' => $this->unit_cant,
            'price' => $this->price,
            'discount' => $this->discount,
            'description' => $this->description,
            'file_image' => $this->file_image,
            'file_path' => $this->file_path,
            'tags' => $this->tags,
            'currency' => $this->currency_code->currency_symbol,
            'status' => $this->status->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
