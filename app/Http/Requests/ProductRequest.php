<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'quantity' => 'required',
            'price_per_unit' => 'required',
            'code' => 'required',
            'manufacture_name' => 'required',
            'model_name' => 'required',
            'color' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is missing',
            'quantity.required' => 'Product Quantity is missing',
            'price_per_unit.required' => 'Product Price is missing',
            'code.required' => 'Product code is missing',
            'manufacturer_name.required' => 'Product Manufacturer is missing',
            'model_name.required' => 'Product Modal is missing',
            'color.integer' => 'Product color is missing',
            'color.required' => 'Product color is missing'
        ];
    }
}
