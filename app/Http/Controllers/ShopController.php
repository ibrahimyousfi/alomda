<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name_ar', 'like', '%' . $search . '%')
                  ->orWhere('name_en', 'like', '%' . $search . '%')
                  ->orWhere('description_ar', 'like', '%' . $search . '%')
                  ->orWhere('description_en', 'like', '%' . $search . '%');
            });
        }

        // Category Filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Price Filter
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        
        // Get categories hierarchically: Parent categories with their children
        $categories = \Illuminate\Support\Facades\Cache::remember('categories_hierarchical', 3600, function () {
            $parentCategories = Category::where('is_parent', true)
                ->with(['children' => function($query) {
                    $query->withCount('products');
                }])
                ->withCount('products')
                ->orderBy('name_en')
                ->get();
            
            // Also get child categories that have products
            $childCategories = Category::where('is_parent', false)
                ->whereNotNull('parent_id')
                ->whereHas('products')
                ->withCount('products')
                ->orderBy('name_en')
                ->get();
            
            return [
                'parents' => $parentCategories,
                'children' => $childCategories,
            ];
        });
        
        $minPrice = \Illuminate\Support\Facades\Cache::remember('min_price', 3600, function () {
            return Product::min('price') ?? 0;
        });
        
        $maxPrice = \Illuminate\Support\Facades\Cache::remember('max_price', 3600, function () {
            return Product::max('price') ?? 1000;
        });

        return view('frontend.shop', compact('products', 'categories', 'minPrice', 'maxPrice'));
    }
}
