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
            'category' => $this->category_id,
            'currency' => $this->currency_code->currency_name,
            'status' => $this->status->description,
            'name' => $this->product_name,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'unit' => $this->unit,
            'stock_cant' => $this->stock_cant,
            'sku' => $this->sku
        ];
    }
}
