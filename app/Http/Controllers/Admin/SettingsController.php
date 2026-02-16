<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $heroVideoUrl = SiteSetting::get('hero_video_url', 'https://www.youtube.com/embed/ZIkP_WMcLz0');
        $aboutBanner = SiteSetting::get('about_banner');
        $aboutImage1 = SiteSetting::get('about_image1');
        $aboutImage2 = SiteSetting::get('about_image2');
        $partners = Partner::orderBy('sort_order')->get();

        $heroEquipmentImages = [];
        $heroPath = public_path('images/hero-equipment');
        if (is_dir($heroPath)) {
            $files = array_merge(
                glob($heroPath . DIRECTORY_SEPARATOR . '*.png') ?: [],
                glob($heroPath . DIRECTORY_SEPARATOR . '*.webp') ?: [],
                glob($heroPath . DIRECTORY_SEPARATOR . '*.jpg') ?: []
            );
            foreach (array_slice($files, 0, 20) as $f) {
                $heroEquipmentImages[] = asset('images/hero-equipment/' . basename($f));
            }
        }

        return view('admin.settings.index', compact(
            'heroVideoUrl', 'aboutBanner', 'aboutImage1', 'aboutImage2', 'partners', 'heroEquipmentImages'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_video_url' => 'nullable|string|max:500',
            'about_banner' => 'nullable|image|max:5120',
            'about_image1' => 'nullable|image|max:5120',
            'about_image2' => 'nullable|image|max:5120',
            'hero_equipment_images' => 'nullable|array',
            'hero_equipment_images.*' => 'image|max:2048',
        ]);

        if ($request->filled('hero_video_url')) {
            SiteSetting::set('hero_video_url', $request->hero_video_url);
        }

        foreach (['about_banner' => 'about', 'about_image1' => 'about', 'about_image2' => 'about'] as $key => $dir) {
            if ($request->hasFile($key)) {
                $old = SiteSetting::get($key);
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                $path = $request->file($key)->store($dir, 'public');
                SiteSetting::set($key, $path);
            }
        }

        if ($request->hasFile('hero_equipment_images')) {
            $heroDir = public_path('images/hero-equipment');
            if (!is_dir($heroDir)) {
                mkdir($heroDir, 0755, true);
            }
            foreach ($request->file('hero_equipment_images') as $file) {
                $name = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move($heroDir, $name);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings saved.');
    }

    public function partnerStore(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('partners', 'public');
        Partner::create([
            'name' => $request->name,
            'image' => $path,
            'sort_order' => Partner::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Partner added.');
    }

    public function partnerDestroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.settings.index')->with('success', 'Partner removed.');
    }

    public function deleteAboutImage(Request $request)
    {
        $key = $request->validate(['key' => 'required|in:about_banner,about_image1,about_image2'])['key'];
        $path = SiteSetting::get($key);
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        SiteSetting::forget($key);
        return redirect()->route('admin.settings.index')->with('success', 'Image removed.');
    }
}
