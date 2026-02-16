<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_ar',
        'name_en',
        'name_fr',
        'slug',
        'description_ar',
        'description_en',
        'description_fr',
        'price',
        'stock',
        'image',
        'images',
        'is_featured',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'ar' && $this->name_ar) return $this->name_ar;
        if ($locale === 'fr' && $this->name_fr) return $this->name_fr;
        return $this->name_fr ?: $this->name_en ?: $this->name_ar ?: '';
    }

    public function getTranslatedDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'ar' && $this->description_ar) return $this->description_ar;
        if ($locale === 'fr' && $this->description_fr) return $this->description_fr;
        return $this->description_fr ?: $this->description_en ?: $this->description_ar;
    }
}
