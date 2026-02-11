<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'customer_address' => 'required|string|max:500',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:100',
            'notes' => 'nullable|string|max:1000',
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
                if ($product && $this->quantity > $product->stock) {
                    $validator->errors()->add(
                        'quantity',
                        "Available stock: {$product->stock}"
                    );
                }
            }
        });
    }
}
