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
            'purchase_price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is missing',
            'quantity.required' => 'Product Quantity is missing',
            'price_per_unit.required' => 'Product Price is missing',
            'purchase_price.required' => 'Purchasing price is missing',

        ];
    }
}
