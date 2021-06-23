<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
            'payment_type' => $this->payment_type_id,
            'reference_number' => $this->reference_number,
            'financial_entity_id' => $this->financial_entity->entity_name
        ];
    }
}
