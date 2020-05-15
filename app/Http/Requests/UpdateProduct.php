<?php

namespace App\Http\Requests;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|max:25',
            'currency_code_id' => 'required',
            'status_id' => 'required|max:2',
            'product_name' => 'required|max:40',
            'description' => 'required|max:50',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'unit' => 'required|max:10',
            'stock_cant' => 'nullable|numeric',
            'sku' => 'required|max:10'
        ];
    }
}
