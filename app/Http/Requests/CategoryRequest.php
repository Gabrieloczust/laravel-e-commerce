<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                Rule::unique('categories')->ignore($this->category)
            ],
            'photo' => 'unique:categories|image|mimes:jpg,png,jpeg,webp,gif,svg|max:2048'
        ];
    }
}
