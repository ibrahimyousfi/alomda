<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('frontend.cart', compact('cart', 'total'));
    }

    public function add(AddToCartRequest $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);
            $cart = session()->get('cart', []);
            $quantity = $request->quantity ?? 1;

            // Check stock availability
            $currentQuantity = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
            $totalQuantity = $currentQuantity + $quantity;

            if ($totalQuantity > $product->stock) {
                return redirect()->back()->withErrors([
                    'quantity' => "Available stock: {$product->stock}"
                ]);
            }

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name_ar' => $product->name_ar,
                    'name_en' => $product->name_en,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => $quantity,
                    'slug' => $product->slug
                ];
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'error' => 'An error occurred while adding the product'
            ]);
        }
    }

    public function update(UpdateCartRequest $request)
    {
        try {
            $cart = session()->get('cart', []);
            
            if (!isset($cart[$request->id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ], 404);
            }

            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating'
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer'
            ]);

            $cart = session()->get('cart', []);
            
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error removing from cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while removing'
            ], 500);
        }
    }
}
