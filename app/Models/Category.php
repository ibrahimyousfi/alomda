<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'is_parent',
        'icon',
        'name_ar',
        'name_en',
        'name_fr',
        'slug',
        'image',
    ];

    protected $casts = [
        'is_parent' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'ar' && $this->name_ar) return $this->name_ar;
        if ($locale === 'fr' && $this->name_fr) return $this->name_fr;
        return $this->name_fr ?: $this->name_en ?: $this->name_ar ?: '';
    }
}
