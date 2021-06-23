<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'name' => $this->product->product_name,
            'sku' => $this->sku,
            'quantity' => $this->pivot->quantity,
            'tax_id' => $this->pivot->tax,
            'discount' => $this->pivot->discount,
            'unit' => $this->pivot->unit,
        ];
    }
}
