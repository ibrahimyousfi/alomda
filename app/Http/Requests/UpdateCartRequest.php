<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:100',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $cart = session()->get('cart', []);
            if (!isset($cart[$this->id])) {
                $validator->errors()->add('id', 'Product not found in cart');
                return;
            }

            $product = \App\Models\Product::find($this->id);
            if ($product && $this->quantity > $product->stock) {
                $validator->errors()->add(
                    'quantity',
                    "Available stock: {$product->stock}"
                );
            }
        });
    }
}
