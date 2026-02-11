<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleWishlistRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function toggle(ToggleWishlistRequest $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);
            $wishlist = session()->get('wishlist', []);

            if (isset($wishlist[$product->id])) {
                unset($wishlist[$product->id]);
                $message = 'removed';
            } else {
                $wishlist[$product->id] = [
                    'id' => $product->id,
                    'name_ar' => $product->name_ar,
                    'name_en' => $product->name_en,
                    'price' => $product->price,
                    'image' => $product->image,
                    'slug' => $product->slug
                ];
                $message = 'added';
            }

            session()->put('wishlist', $wishlist);
            return response()->json([
                'status' => $message,
                'count' => count($wishlist),
                'message' => $message == 'added' ? 'Added to wishlist' : 'Removed from wishlist'
            ]);
        } catch (\Exception $e) {
            Log::error('Error toggling wishlist: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred'
            ], 500);
        }
    }
}
