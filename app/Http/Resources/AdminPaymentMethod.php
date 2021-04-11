<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPaymentMethod extends JsonResource
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
            'bank_data' => new BankData($this->bank_data),
            'status' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
