<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'order_number' => $this->order_number,
            'status' => $this->status_id,
            'user' => $this->user_id,
            'user_address' => $this->user_address_id,
            'payment' => $this->payment_id,
            'delivery_method' => $this->delivery_method_id,
            'commentary' => $this->commentary,
            'grand_total' => $this->grand_total,
            'item_count' => $this->item_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
