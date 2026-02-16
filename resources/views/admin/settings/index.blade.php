@extends('admin.layouts.admin')

@section('pageHeader')
    <x-admin-page-header title="Site Content & Media" :showSearch="false" />
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <!-- Hero Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Hero / Banner</h2>
            <p class="text-sm text-gray-500 mt-1">Video and images on the homepage hero section.</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Hero video URL (YouTube)</label>
                    <input type="url" name="hero_video_url" value="{{ old('hero_video_url', $heroVideoUrl) }}" placeholder="https://www.youtube.com/embed/VIDEO_ID" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-gold-500 focus:border-gold-500" dir="ltr">
                    <p class="text-xs text-gray-500 mt-1">Use YouTube embed URL, e.g. https://www.youtube.com/embed/ZIkP_WMcLz0</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Hero equipment images (carousel)</label>
                    @if(!empty($heroEquipmentImages))
                        <p class="text-xs text-gray-600 mb-2">Current images ({{ count($heroEquipmentImages) }}):</p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($heroEquipmentImages as $url)
                                <img src="{{ $url }}" alt="Hero" class="h-16 w-20 object-cover rounded-lg border border-gray-200">
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="hero_equipment_images[]" multiple accept="image/*" id="heroImagesInput" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:font-medium">
                    <div id="heroImagesPreview" class="flex flex-wrap gap-2 mt-2"></div>
                    <p class="text-xs text-gray-500 mt-1">Upload PNG/WebP/JPG. Stored in public/images/hero-equipment/</p>
                </div>
                <button type="submit" class="bg-gold-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-gold-700 transition-colors">Save Hero</button>
            </form>
        </div>
    </div>

    <!-- About Page Images -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">About Page Images</h2>
            <p class="text-sm text-gray-500 mt-1">Banner and section images for the About page.</p>
        </div>
        <div class="p-6">
            <form id="aboutImagesForm" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Banner image</label>
                        @if($aboutBanner)
                            <div class="mb-2"><img src="{{ asset('storage/' . $aboutBanner) }}" alt="Banner" class="h-24 object-cover rounded-lg border"></div>
                            <form action="{{ route('admin.settings.delete-about-image') }}" method="POST" class="inline mb-2 block" onsubmit="return confirm('Remove this image?');">
                                @csrf
                                <input type="hidden" name="key" value="about_banner">
                                <button type="submit" class="text-red-600 text-sm">Remove</button>
                            </form>
                        @endif
                        <input type="file" name="about_banner" form="aboutImagesForm" accept="image/*" id="aboutBannerInput" class="mt-2 w-full text-sm text-gray-500 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100">
                        <div id="aboutBannerPreview" class="mt-2"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Image 1 (About ALOMDA)</label>
                        @if($aboutImage1)
                            <div class="mb-2"><img src="{{ asset('storage/' . $aboutImage1) }}" alt="About 1" class="h-24 object-cover rounded-lg border border-gray-200" onerror="this.style.display='none'; this.nextElementSibling?.classList.remove('hidden');">
                                <span class="hidden text-xs text-amber-600">Run: php artisan storage:link</span></div>
                            <form action="{{ route('admin.settings.delete-about-image') }}" method="POST" class="inline mb-2 block" onsubmit="return confirm('Remove?');">
                                @csrf
                                <input type="hidden" name="key" value="about_image1">
                                <button type="submit" class="text-red-600 text-sm">Remove</button>
                            </form>
                        @endif
                        <input type="file" name="about_image1" form="aboutImagesForm" accept="image/*" id="aboutImage1Input" class="mt-2 w-full text-sm text-gray-500 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100">
                        <div id="aboutImage1Preview" class="mt-2"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Image 2 (Our Vision)</label>
                        @if($aboutImage2)
                            <div class="mb-2"><img src="{{ asset('storage/' . $aboutImage2) }}" alt="About 2" class="h-24 object-cover rounded-lg border"></div>
                            <form action="{{ route('admin.settings.delete-about-image') }}" method="POST" class="inline mb-2 block" onsubmit="return confirm('Remove?');">
                                @csrf
                                <input type="hidden" name="key" value="about_image2">
                                <button type="submit" class="text-red-600 text-sm">Remove</button>
                            </form>
                        @endif
                        <input type="file" name="about_image2" form="aboutImagesForm" accept="image/*" id="aboutImage2Input" class="mt-2 w-full text-sm text-gray-500 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100">
                        <div id="aboutImage2Preview" class="mt-2"></div>
                    </div>
                </div>
                <button type="submit" form="aboutImagesForm" class="bg-gold-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-gold-700 transition-colors">Save About Images</button>
            </form>
        </div>
    </div>

    <!-- Partners / Brands -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Partners / Top Brands</h2>
            <p class="text-sm text-gray-500 mt-1">Logos shown in the "Top Brands" section on the homepage.</p>
        </div>
        <div class="p-6 space-y-6">
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-end gap-4 p-4 bg-gray-50 rounded-xl">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Name (optional)</label>
                    <input type="text" name="name" placeholder="Partner name" class="px-4 py-2 rounded-lg border border-gray-200 w-48">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Logo image</label>
                    <input type="file" name="image" accept="image/*" required id="partnerImageInput" class="text-sm text-gray-500 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700">
                    <div id="partnerImagePreview" class="mt-2"></div>
                </div>
                <button type="submit" class="bg-gold-600 text-white px-5 py-2 rounded-xl font-semibold hover:bg-gold-700">Add Partner</button>
            </form>

            <div class="flex flex-wrap gap-4">
                @foreach($partners as $partner)
                    <div class="border border-gray-200 rounded-xl p-4 flex flex-col items-center gap-2 w-40">
                        <img src="{{ $partner->image_url }}" alt="{{ $partner->name }}" class="h-16 object-contain">
                        @if($partner->name)<span class="text-xs text-gray-600 truncate w-full text-center">{{ $partner->name }}</span>@endif
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Remove this partner?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 text-xs">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>
            @if($partners->isEmpty())
                <p class="text-gray-500 text-sm">No partners yet. Add one above.</p>
            @endif
        </div>
    </div>

</div>

<script>
(function() {
    function previewOne(input, previewId) {
        var el = document.getElementById(previewId);
        if (!el) return;
        el.innerHTML = '';
        if (input && input.files && input.files[0]) {
            var r = new FileReader();
            r.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-24 object-cover rounded-lg border border-gray-200';
                img.alt = 'Preview';
                el.appendChild(img);
            };
            r.readAsDataURL(input.files[0]);
        }
    }
    function previewMultiple(input, previewId) {
        var el = document.getElementById(previewId);
        if (!el) return;
        el.innerHTML = '';
        if (input && input.files) {
            for (var i = 0; i < input.files.length; i++) {
                (function(file) {
                    var r = new FileReader();
                    r.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-16 w-20 object-cover rounded-lg border border-gray-200';
                        img.alt = 'Preview';
                        el.appendChild(img);
                    };
                    r.readAsDataURL(file);
                })(input.files[i]);
            }
        }
    }
    function init() {
        var aboutBanner = document.getElementById('aboutBannerInput');
        if (aboutBanner) aboutBanner.addEventListener('change', function() { previewOne(this, 'aboutBannerPreview'); });
        var aboutImage1 = document.getElementById('aboutImage1Input');
        if (aboutImage1) aboutImage1.addEventListener('change', function() { previewOne(this, 'aboutImage1Preview'); });
        var aboutImage2 = document.getElementById('aboutImage2Input');
        if (aboutImage2) aboutImage2.addEventListener('change', function() { previewOne(this, 'aboutImage2Preview'); });
        var heroImages = document.getElementById('heroImagesInput');
        if (heroImages) heroImages.addEventListener('change', function() { previewMultiple(this, 'heroImagesPreview'); });
        var partnerImage = document.getElementById('partnerImageInput');
        if (partnerImage) partnerImage.addEventListener('change', function() { previewOne(this, 'partnerImagePreview'); });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
@endsection
