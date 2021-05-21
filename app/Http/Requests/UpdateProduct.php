<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

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
            'category_id' => 'required',
            'product_name' => [
                'required',
                'string',
                'max:40',
                Rule::unique('products')->ignore($this->route('product')),
            ],
            'slug' => 'nullable|string',
            'description' => 'required|string|max:50',
            'currency_code_id' => 'string|max:3',
            'tags' => 'nullable',
            'file_image' => 'nullable',
            'file_path' => 'nullable',
            'stock' => 'nullable|numeric|min:1',
            'status_id' => 'max:2',
            'attributes.*.sku' => [
                'nullable',
                'max:10',
                Rule::unique('product_attributes')->ignore($this->route('product'), 'product_id'),
            ],
            'attributes.*.unit_name' => 'required|string|max:10',
            'attributes.*.unit_cant' => 'required|numeric|min:1',
            'attributes.*.price' => 'required|numeric|min:0.00',
            'attributes.*.discount' => 'nullable|numeric|min:0|max:100',
            'attributes.*.status_id' => 'max:2',
            'suppliers.*' => 'numeric'
        ];
    }
}
