<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Partner;
use App\Models\Product;
use App\Models\SiteSetting;
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

        $heroVideoUrl = SiteSetting::get('hero_video_url', 'https://www.youtube.com/embed/ZIkP_WMcLz0');
        $heroEmbedUrl = $heroVideoUrl;
        if (preg_match('/embed\/([a-zA-Z0-9_-]+)/', $heroVideoUrl, $m)) {
            $sep = str_contains($heroVideoUrl, '?') ? '&' : '?';
            $heroEmbedUrl = rtrim($heroVideoUrl, '?&') . $sep . 'autoplay=1&mute=1&loop=1&playlist=' . $m[1] . '&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&playsinline=1';
        }
        $partnerImages = Partner::orderBy('sort_order')->get()->map(fn ($p) => $p->image_url)->filter()->values()->all();

        // Fallback: if no partners in DB, load from storage/partners folder
        if (empty($partnerImages)) {
            $partnersPaths = [public_path('storage/partners'), storage_path('app/public/partners')];
            foreach ($partnersPaths as $partnersPath) {
                if (is_dir($partnersPath)) {
                    $files = @scandir($partnersPath) ?: [];
                    foreach ($files as $file) {
                        if ($file === '.' || $file === '..') continue;
                        if (preg_match('/\.(jpg|jpeg|png|webp|svg)$/i', $file)) {
                            $partnerImages[] = asset('storage/partners/' . $file);
                        }
                    }
                    if (!empty($partnerImages)) break;
                }
            }
        }

        return view('frontend.home', compact('products', 'categories', 'equipmentImages', 'heroEmbedUrl', 'partnerImages'));
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
        $aboutBanner = SiteSetting::get('about_banner');
        $aboutImage1 = SiteSetting::get('about_image1');
        $aboutImage2 = SiteSetting::get('about_image2');
        return view('frontend.about', compact('aboutBanner', 'aboutImage1', 'aboutImage2'));
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
