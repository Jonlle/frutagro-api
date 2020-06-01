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
            'sku' => 'required|max:10',
            'product_name' => [
                'required',
                'string',
                'max:40',
                Rule::unique('products')->ignore($this->route('product')),
            ],
            'stock' => 'nullable|numeric|min:1',
            'unit_name' => 'required|string|max:10',
            'unit_cant' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0.00',
            'discount' => 'nullable|numeric|min:0|max:100',
            'description' => 'required|string|max:50',
            'file_image' => 'required',
            'tags' => 'nullable',
            'currency_code_id' => 'required',
            'status_id' => 'max:2',
        ];
    }
}
