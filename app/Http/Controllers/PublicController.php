<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = \Illuminate\Support\Facades\Cache::remember('categories_with_count', 3600, function () {
            return Category::withCount('products')->get();
        });

        $products = Product::with('category')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Get equipment images from public/images/hero-equipment (any .png or .webp)
        $equipmentImages = [];
        $imagePath = public_path('images/hero-equipment');
        if (is_dir($imagePath)) {
            $files = array_merge(
                glob($imagePath . DIRECTORY_SEPARATOR . '*.png') ?: [],
                glob($imagePath . DIRECTORY_SEPARATOR . '*.webp') ?: []
            );
            usort($files, function ($a, $b) {
                return strnatcasecmp(basename($a), basename($b));
            });
            foreach (array_unique($files) as $file) {
                $equipmentImages[] = asset('images/hero-equipment/' . basename($file));
            }
        }

        return view('frontend.home', compact('products', 'categories', 'equipmentImages'));
    }

    public function show($slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();
        
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function faq()
    {
        return view('frontend.faq');
    }

    public function parentCategory($slug)
    {
        $parentCategory = Category::where('slug', $slug)
            ->where('is_parent', true)
            ->with('children')
            ->firstOrFail();
        
        $childCategories = $parentCategory->children()->withCount('products')->get();
        
        return view('frontend.parent-category', compact('parentCategory', 'childCategories'));
    }

    public function storeOrder(StoreOrderRequest $request)
    {
        try {
            $validated = $request->validated();
            $product = Product::findOrFail($validated['product_id']);

            // Check stock
            if ($validated['quantity'] > $product->stock) {
                return back()->withErrors([
                    'quantity' => "Available stock: {$product->stock}"
                ])->withInput();
            }

            $total = $product->price * $validated['quantity'];

            DB::transaction(function () use ($validated, $product, $total) {
                $order = Order::create([
                    'customer_name' => $validated['customer_name'],
                    'customer_phone' => $validated['customer_phone'],
                    'customer_address' => $validated['customer_address'],
                    'total_amount' => $total,
                    'status' => 'pending',
                    'notes' => $validated['notes'] ?? null,
                ]);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $validated['quantity'],
                    'price' => $product->price,
                ]);

                // Update product stock
                $product->decrement('stock', $validated['quantity']);
            });

            return back()->with('success', 'Order placed successfully! We will contact you soon.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error storing order: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'An error occurred while placing the order'
            ])->withInput();
        }
    }
}
