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
            'financial_entity' => new FinancialEntity($this->financial_entity),
            'target_acount' => $this->target_acount,
            'document_type' => $this->document_type_id,
            'document' => $this->document,
            'target_name' => $this->target_name,
            'file_image' => $this->file_image,
            'file_path' => $this->file_path,
            'status' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
