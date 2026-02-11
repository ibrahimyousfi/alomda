<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:100',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('product_id')) {
                $product = \App\Models\Product::find($this->product_id);
                if ($product) {
                    $quantity = $this->quantity ?? 1;
                    $cart = session()->get('cart', []);
                    $currentQuantity = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
                    $totalQuantity = $currentQuantity + $quantity;
                    
                    if ($totalQuantity > $product->stock) {
                        $validator->errors()->add(
                            'quantity',
                            "Available stock: {$product->stock}. Requested quantity: {$totalQuantity}"
                        );
                    }
                }
            }
        });
    }
}
