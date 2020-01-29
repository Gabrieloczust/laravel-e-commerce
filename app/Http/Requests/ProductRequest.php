<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('products')->ignore($this->product)
            ],
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|numeric|min:0',
            'description' => 'nullable',
            'photo' => 'image|mimes:jpg,png,jpeg,webp,gif,svg|max:2048'
        ];
    }
}
