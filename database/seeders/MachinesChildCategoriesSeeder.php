<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MachinesChildCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $machinesParent = Category::where('name_en', 'Machines')->where('is_parent', true)->first();
        
        if (!$machinesParent) {
            $this->command->error('Machines parent category not found. Please run ParentCategoriesSeeder first.');
            return;
        }

        $childCategories = [
            ['name_en' => 'Nettoyeur ultrasons', 'name_ar' => 'منظف بالموجات فوق الصوتية'],
            ['name_en' => 'Machines à vapeur', 'name_ar' => 'آلات البخار'],
            ['name_en' => 'Systèmes placage', 'name_ar' => 'أنظمة الطلاء'],
            ['name_en' => 'Machines à polir', 'name_ar' => 'آلات التلميع'],
            ['name_en' => 'Tonneaux à polir', 'name_ar' => 'براميل التلميع'],
            ['name_en' => 'Nettoyeur magnétique', 'name_ar' => 'منظف مغناطيسي'],
            ['name_en' => 'Machines de fusion', 'name_ar' => 'آلات الصهر'],
            ['name_en' => 'Machines de coulée', 'name_ar' => 'آلات الصب'],
            ['name_en' => 'bagues et bracelets', 'name_ar' => 'خواتم وأساور'],
            ['name_en' => 'Laminoirs', 'name_ar' => 'مطاحن الدرفلة'],
            ['name_en' => 'Machines formage', 'name_ar' => 'آلات التشكيل'],
            ['name_en' => 'Machines laser', 'name_ar' => 'آلات الليزر'],
            ['name_en' => 'Imprimantes 3D', 'name_ar' => 'طابعات ثلاثية الأبعاد'],
            ['name_en' => 'Mini machines', 'name_ar' => 'آلات صغيرة'],
            ['name_en' => 'Pantographes/CNC', 'name_ar' => 'بانتوجراف/CNC'],
            ['name_en' => 'Établis de travail', 'name_ar' => 'طاولات العمل'],
            ['name_en' => 'Tours', 'name_ar' => 'مخارط'],
            ['name_en' => 'Presse hydrauliques', 'name_ar' => 'مكابس هيدروليكية'],
            ['name_en' => 'Sableuses/séchage', 'name_ar' => 'آلات الرمل/التجفيف'],
            ['name_en' => 'Machines à souder', 'name_ar' => 'آلات اللحام'],
            ['name_en' => 'Machines générales', 'name_ar' => 'آلات عامة'],
            ['name_en' => 'Analyseurs métaux', 'name_ar' => 'محللات المعادن'],
            ['name_en' => 'Pièces détachées', 'name_ar' => 'قطع الغيار'],
            ['name_en' => 'raffinage/recyclage', 'name_ar' => 'التكرير/إعادة التدوير'],
            ['name_en' => 'Machine d\'occasion', 'name_ar' => 'آلات مستعملة'],
        ];

        foreach ($childCategories as $category) {
            Category::updateOrCreate(
                [
                    'name_en' => $category['name_en'],
                    'parent_id' => $machinesParent->id,
                ],
                [
                    'name_ar' => $category['name_ar'],
                    'slug' => Str::slug($category['name_en']) . '-' . time(),
                    'is_parent' => false,
                    'parent_id' => $machinesParent->id,
                    'image' => null, // User can add images later
                ]
            );
        }

        $this->command->info('Successfully created ' . count($childCategories) . ' child categories for Machines.');
    }
}
