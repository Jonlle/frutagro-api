<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'amount' => $this->amount,
            'status' => $this->status_id,
            'order' => $this->order_id,
            'payment_method' => new PaymentMethodResource($this->payment_method),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
