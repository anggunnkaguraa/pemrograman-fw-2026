<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
   
    public function rules(): array
{
    return [
        'category_id' => 'required|exists:categories,id',
        'code' => 'required|string|max:20|unique:products,code,' . $this->product->id,
        'name' => 'required|string|max:150',
        'unit' => 'required|string|max:20',
        'price' => 'required|integer|min:0',
        'stock' => 'required|integer|min:0',
    ];
}
}
