<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyCode extends JsonResource
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
            'name' => $this->currency_name,
            'symbol' => $this->currency_symbol,
            'exchange_rate' => $this->exchange_rate,
            'default' => $this->default,
            'status' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
