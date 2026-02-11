<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::where('is_parent', true)->get();
        $defaultParent = Category::where('is_parent', true)->where('name_en', 'Products')->first();
        return view('admin.categories.create', compact('parentCategories', 'defaultParent'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'is_parent' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:categories,id',
            'icon' => 'nullable|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_parent'] = $request->has('is_parent') ? true : false;
        $validated['slug'] = Str::slug($request->name_en) . '-' . time();

        // If it's a parent category, remove parent_id
        if ($validated['is_parent']) {
            $validated['parent_id'] = null;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        \Illuminate\Support\Facades\Cache::forget('categories_with_count');
        \Illuminate\Support\Facades\Cache::forget('categories_hierarchical');

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::where('is_parent', true)->where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'is_parent' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:categories,id',
            'icon' => 'nullable|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['is_parent'] = $request->has('is_parent') ? true : false;

        // If it's a parent category, remove parent_id
        if ($validated['is_parent']) {
            $validated['parent_id'] = null;
        }

        if ($request->has('name_en') && $category->name_en !== $request->name_en) {
            $validated['slug'] = Str::slug($request->name_en) . '-' . time();
        }

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        \Illuminate\Support\Facades\Cache::forget('categories_with_count');
        \Illuminate\Support\Facades\Cache::forget('categories_hierarchical');

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete this category because it contains products.');
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        
        $category->delete();

        \Illuminate\Support\Facades\Cache::forget('categories_with_count');
        \Illuminate\Support\Facades\Cache::forget('categories_hierarchical');

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
