<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MachinesProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $machinesParent = Category::where('name_en', 'Machines')->where('is_parent', true)->first();
        
        if (!$machinesParent) {
            $this->command->error('Machines parent category not found.');
            return;
        }

        // Get child categories
        $categories = [
            'Nettoyeur ultrasons' => Category::where('name_en', 'Nettoyeur ultrasons')->where('parent_id', $machinesParent->id)->first(),
            'Machines à vapeur' => Category::where('name_en', 'Machines à vapeur')->where('parent_id', $machinesParent->id)->first(),
            'Machines à polir' => Category::where('name_en', 'Machines à polir')->where('parent_id', $machinesParent->id)->first(),
            'Machines de fusion' => Category::where('name_en', 'Machines de fusion')->where('parent_id', $machinesParent->id)->first(),
            'Machines laser' => Category::where('name_en', 'Machines laser')->where('parent_id', $machinesParent->id)->first(),
            'Machines de coulée' => Category::where('name_en', 'Machines de coulée')->where('parent_id', $machinesParent->id)->first(),
            'Imprimantes 3D' => Category::where('name_en', 'Imprimantes 3D')->where('parent_id', $machinesParent->id)->first(),
        ];

        $products = [
            // Nettoyeur ultrasons
            [
                'name_en' => '3D Systems FabPro 1000 – Imprimante 3D SLA pour précision',
                'name_ar' => '3D Systems FabPro 1000 – طابعة ثلاثية الأبعاد SLA للدقة',
                'category' => 'Imprimantes 3D',
                'price' => 15000.00,
                'stock' => 3,
            ],
            [
                'name_en' => 'Banc de traitement chimique multi-bacs',
                'name_ar' => 'مكتب معالجة كيميائية متعدد الأحواض',
                'category' => 'Nettoyeur ultrasons',
                'price' => 2500.00,
                'stock' => 5,
            ],
            [
                'name_en' => 'BM Balzer – Agitateur de laboratoire électrique',
                'name_ar' => 'BM Balzer – خلاط مختبر كهربائي',
                'category' => 'Nettoyeur ultrasons',
                'price' => 1200.00,
                'stock' => 8,
            ],
            [
                'name_en' => 'Cuve de nettoyage industrielle avec commande électronique I.M',
                'name_ar' => 'حوض تنظيف صناعي مع تحكم إلكتروني I.M',
                'category' => 'Nettoyeur ultrasons',
                'price' => 3500.00,
                'stock' => 4,
            ],
            [
                'name_en' => 'Exenka Injector',
                'name_ar' => 'Exenka Injector',
                'category' => 'Machines de coulée',
                'price' => 4500.00,
                'stock' => 6,
            ],
            [
                'name_en' => 'Four de fusion à haute température avec contrôle numérique',
                'name_ar' => 'فرن صهر عالي الحرارة مع تحكم رقمي',
                'category' => 'Machines de fusion',
                'price' => 8000.00,
                'stock' => 3,
            ],
            [
                'name_en' => 'Générateur de vapeur industriel STEAM POWER 8 BAR',
                'name_ar' => 'مولد بخار صناعي STEAM POWER 8 BAR',
                'category' => 'Machines à vapeur',
                'price' => 5500.00,
                'stock' => 5,
            ],
            [
                'name_en' => 'Handler – Aspirateur de poussière industriel',
                'name_ar' => 'Handler – مكنسة كهربائية صناعية',
                'category' => 'Nettoyeur magnétique',
                'price' => 1800.00,
                'stock' => 10,
            ],
            [
                'name_en' => 'Machine de brasage à haute fréquence',
                'name_ar' => 'آلة لحام عالي التردد',
                'category' => 'Machines à souder',
                'price' => 12000.00,
                'stock' => 2,
            ],
            [
                'name_en' => 'Machine de marquage Laser',
                'name_ar' => 'آلة نقش بالليزر',
                'category' => 'Machines laser',
                'price' => 15000.00,
                'stock' => 3,
            ],
            [
                'name_en' => 'Machine de nettoyage à vapeur Steam Jet',
                'name_ar' => 'آلة تنظيف بالبخار Steam Jet',
                'category' => 'Machines à vapeur',
                'price' => 3200.00,
                'stock' => 7,
            ],
            [
                'name_en' => 'Machine de polissage de laboratoire EKEMKA',
                'name_ar' => 'آلة تلميع مختبر EKEMKA',
                'category' => 'Machines à polir',
                'price' => 4500.00,
                'stock' => 4,
            ],
            [
                'name_en' => 'Machine de polissage double poste avec protections transparentes',
                'name_ar' => 'آلة تلميع مزدوجة مع حماية شفافة',
                'category' => 'Machines à polir',
                'price' => 6800.00,
                'stock' => 3,
            ],
            [
                'name_en' => 'Machine de polissage double poste TWIN',
                'name_ar' => 'آلة تلميع مزدوجة TWIN',
                'category' => 'Machines à polir',
                'price' => 7200.00,
                'stock' => 3,
            ],
            [
                'name_en' => 'Machine de polissage ECO Maxi',
                'name_ar' => 'آلة تلميع ECO Maxi',
                'category' => 'Machines à polir',
                'price' => 5500.00,
                'stock' => 5,
            ],
            [
                'name_en' => 'Machine de sous-pression pour moulage',
                'name_ar' => 'آلة ضغط منخفض للصب',
                'category' => 'Machines de coulée',
                'price' => 9500.00,
                'stock' => 2,
            ],
            [
                'name_en' => 'MasterInject',
                'name_ar' => 'MasterInject',
                'category' => 'Machines de coulée',
                'price' => 11000.00,
                'stock' => 3,
            ],
            [
                'name_en' => 'MasterInject XL',
                'name_ar' => 'MasterInject XL',
                'category' => 'Machines de coulée',
                'price' => 13500.00,
                'stock' => 2,
            ],
            [
                'name_en' => 'Nettoyeur à Ultrasons',
                'name_ar' => 'منظف بالموجات فوق الصوتية',
                'category' => 'Nettoyeur ultrasons',
                'price' => 1500.00,
                'stock' => 12,
            ],
            [
                'name_en' => 'Nettoyeur à ultrasons compact avec contrôle numérique',
                'name_ar' => 'منظف بالموجات فوق الصوتية مضغوط مع تحكم رقمي',
                'category' => 'Nettoyeur ultrasons',
                'price' => 2200.00,
                'stock' => 8,
            ],
            [
                'name_en' => 'Nettoyeur à ultrasons professionnel 4L avec chauffage et minuterie',
                'name_ar' => 'منظف بالموجات فوق الصوتية احترافي 4L مع تسخين وعداد',
                'category' => 'Nettoyeur ultrasons',
                'price' => 2800.00,
                'stock' => 6,
            ],
            [
                'name_en' => 'Nettoyeur à ultrasons professionnel avec commande numérique et robinet d\'évacuation',
                'name_ar' => 'منظف بالموجات فوق الصوتية احترافي مع تحكم رقمي وصنبور تصريف',
                'category' => 'Nettoyeur ultrasons',
                'price' => 3200.00,
                'stock' => 5,
            ],
            [
                'name_en' => 'Nettoyeur à ultrasons professionnel avec commandes analogiques, acier inoxydable',
                'name_ar' => 'منظف بالموجات فوق الصوتية احترافي مع تحكم تماثلي، فولاذ مقاوم للصدأ',
                'category' => 'Nettoyeur ultrasons',
                'price' => 3800.00,
                'stock' => 4,
            ],
            [
                'name_en' => 'Nettoyeur à ultrasons professionnel en acier inoxydable avec commandes analogiques',
                'name_ar' => 'منظف بالموجات فوق الصوتية احترافي من الفولاذ المقاوم للصدأ مع تحكم تماثلي',
                'category' => 'Nettoyeur ultrasons',
                'price' => 4000.00,
                'stock' => 4,
            ],
        ];

        $created = 0;
        foreach ($products as $productData) {
            $category = $categories[$productData['category']] ?? null;
            
            if (!$category) {
                $this->command->warn("Category '{$productData['category']}' not found. Skipping product: {$productData['name_en']}");
                continue;
            }

            Product::updateOrCreate(
                [
                    'name_en' => $productData['name_en'],
                    'category_id' => $category->id,
                ],
                [
                    'name_ar' => $productData['name_ar'],
                    'slug' => Str::slug($productData['name_en']) . '-' . time(),
                    'description_en' => 'Professional ' . strtolower($productData['name_en']) . ' for industrial use.',
                    'description_ar' => $productData['name_ar'] . ' احترافي للاستخدام الصناعي.',
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'is_featured' => false,
                ]
            );
            $created++;
        }

        $this->command->info("Successfully created/updated {$created} products for Machines categories.");
    }
}
