<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@tabak.com',
            'password' => Hash::make('password'),
        ]);

        // Create Categories
        $cat1 = Category::create([
            'name_ar' => 'سلال تقليدية',
            'name_en' => 'Traditional Baskets',
            'slug' => 'traditional-baskets',
            'image' => null,
        ]);

        $cat2 = Category::create([
            'name_ar' => 'ديكور منزلي',
            'name_en' => 'Home Decor',
            'slug' => 'home-decor',
            'image' => null,
        ]);

        // Create Products
        Product::create([
            'category_id' => $cat1->id,
            'name_ar' => 'سلة خوص ملونة',
            'name_en' => 'Colorful Wicker Basket',
            'slug' => 'colorful-wicker-basket',
            'description_ar' => 'سلة مصنوعة يدوياً من الخوص الطبيعي بألوان زاهية.',
            'description_en' => 'Handmade wicker basket with vibrant colors.',
            'price' => 150.00,
            'stock' => 10,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $cat1->id,
            'name_ar' => 'طبق تقديم تقليدي',
            'name_en' => 'Traditional Serving Plate',
            'slug' => 'traditional-serving-plate',
            'description_ar' => 'طبق تقديم رائع للمناسبات.',
            'description_en' => 'Great serving plate for occasions.',
            'price' => 85.00,
            'stock' => 20,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $cat2->id,
            'name_ar' => 'معلقة حائطية',
            'name_en' => 'Wall Hanging',
            'slug' => 'wall-hanging',
            'description_ar' => 'قطعة فنية لتزيين الحائط.',
            'description_en' => 'Art piece for wall decoration.',
            'price' => 200.00,
            'stock' => 5,
            'is_featured' => false,
        ]);
    }
}
