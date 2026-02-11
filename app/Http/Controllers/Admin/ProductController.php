<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->name_en) . '-' . time();
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach($request->file('gallery') as $file) {
                $gallery[] = $file->store('products/gallery', 'public');
            }
            $validated['images'] = $gallery;
        }

        Product::create($validated);

        \Illuminate\Support\Facades\Cache::forget('featured_products');
        \Illuminate\Support\Facades\Cache::forget('min_price');
        \Illuminate\Support\Facades\Cache::forget('max_price');

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        if ($request->has('name_en') && $product->name_en !== $request->name_en) {
            $validated['slug'] = Str::slug($request->name_en) . '-' . time();
        }

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = $product->images ?? [];
            foreach($request->file('gallery') as $file) {
                $gallery[] = $file->store('products/gallery', 'public');
            }
            $validated['images'] = $gallery;
        }

        $product->update($validated);

        \Illuminate\Support\Facades\Cache::forget('featured_products');
        \Illuminate\Support\Facades\Cache::forget('min_price');
        \Illuminate\Support\Facades\Cache::forget('max_price');

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->images) {
            foreach($product->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $product->delete();

        \Illuminate\Support\Facades\Cache::forget('featured_products');
        \Illuminate\Support\Facades\Cache::forget('min_price');
        \Illuminate\Support\Facades\Cache::forget('max_price');

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
