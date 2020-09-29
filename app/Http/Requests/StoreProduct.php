<?php

namespace App\Http\Requests;

class StoreProduct extends FormRequest
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
            'product_name' => 'required|string|unique:products|max:40',
            'slug' => 'nullable|string',
            'description' => 'required|string|max:50',
            'stock' => 'nullable|numeric|min:1',
            'tags' => 'nullable',
            'currency_code_id' => 'string|max:3',
            'file_image' => 'nullable',
            'file_path' => 'nullable',
            'status_id' => 'max:2',
            'attributes.*.sku' => 'nullable|unique:product_attributes|max:10',
            'attributes.*.unit_name' => 'required|string|max:10',
            'attributes.*.unit_cant' => 'required|numeric|min:1',
            'attributes.*.price' => 'required|numeric|min:0.00',
            'attributes.*.discount' => 'nullable|numeric|min:0|max:100',
            'attributes.*.status_id' => 'max:2',
        ];
    }
}
