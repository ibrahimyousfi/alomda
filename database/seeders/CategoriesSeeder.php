<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create MACHINES parent category
        $machinesParent = Category::firstOrCreate(
            ['slug' => 'machines'],
            [
                'name_en' => 'MACHINES',
                'name_ar' => 'MACHINES',
                'is_parent' => true,
                'parent_id' => null,
                'icon' => null,
                'image' => null,
            ]
        );

        // MACHINES child categories
        $machinesCategories = [
            'Ultrasonic Cleaners',
            'Steam Machines',
            'Plating Systems',
            'Polishing Machines',
            'Polishing Tumblers',
            'Magnetic Cleaners',
            'Melting Machines',
            'Casting Machines',
            'Ring and Bracelet Machines',
            'Rolling mills',
            'Forming Machines',
            'Laser Machines',
            '3D Printers',
            'Mini Machines',
            'Pantographs and Cnc',
            'Working Benches',
            'Lathe Machines',
            'Hydraulic Presses',
            'Tube Profile Machines',
            'Sand Blasters and Drying Machines',
            'Soldering Machines',
            'General Machines',
            'Metal Analyzers',
            'Machine Spare Parts',
            'Refining and Recycling Machines',
            'Second Hand Machines',
        ];

        foreach ($machinesCategories as $index => $categoryName) {
            $imageNumber = $index + 1;
            $imagePath = "categories/machine/{$imageNumber}.png";
            
            // Check if image exists
            $fullImagePath = public_path("storage/{$imagePath}");
            $image = file_exists($fullImagePath) ? $imagePath : null;

            Category::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                [
                    'name_en' => $categoryName,
                    'name_ar' => $categoryName,
                    'is_parent' => false,
                    'parent_id' => $machinesParent->id,
                    'icon' => null,
                    'image' => $image,
                ]
            );
        }

        // Create TOOLS parent category
        $toolsParent = Category::firstOrCreate(
            ['slug' => 'tools'],
            [
                'name_en' => 'TOOLS',
                'name_ar' => 'TOOLS',
                'is_parent' => true,
                'parent_id' => null,
                'icon' => null,
                'image' => null,
            ]
        );

        // TOOLS child categories
        $toolsCategories = [
            'Burs and Drills',
            'Mandrel Polisher',
            'Mandrel and Emery Discs',
            'Files',
            'Engravers and Setting Tools',
            'Stone Setting',
            'Saws and Frames',
            'Pliers and Shears',
            'Motors and Handpieces',
            'Diamond Tools',
            'Ring and Bracelet Tools',
            'Dapping Tools',
            'Drawplates',
            'Hammers and Anvils',
            'Measurement Tools and Compass',
            'Vices and Wooden Tools',
            'Soldering Tools',
            'Tweezers',
            'Magnifiers,Loupes and Lights',
            'Scales',
            'Testing Equipments',
            'Dies and Taps',
            'Stamp Tools',
            'Sieves and Shovels',
            'Adhesives and Bands',
            'Sharpening Stones',
            'Work Safety Supplies',
            'Diamond Tools',
            'Watch Tools',
            'Money Tools',
            'Photography Box',
            'Labeling',
            'Drawer and Plastic Containers',
            'Flooring',
            'Jewelry Sets',
            'Ear Piercing Supplies',
        ];

        // Get tools images sorted by name
        $toolsImagePath = public_path('storage/categories/tools');
        $toolsImages = [];
        if (is_dir($toolsImagePath)) {
            $files = scandir($toolsImagePath);
            $imageFiles = array_filter($files, function($file) {
                return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp']);
            });
            sort($imageFiles);
            $toolsImages = array_values($imageFiles);
        }

        foreach ($toolsCategories as $index => $categoryName) {
            $image = null;
            if (isset($toolsImages[$index])) {
                $imagePath = "categories/tools/{$toolsImages[$index]}";
                $fullImagePath = public_path("storage/{$imagePath}");
                if (file_exists($fullImagePath)) {
                    $image = $imagePath;
                }
            }

            Category::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                [
                    'name_en' => $categoryName,
                    'name_ar' => $categoryName,
                    'is_parent' => false,
                    'parent_id' => $toolsParent->id,
                    'icon' => null,
                    'image' => $image,
                ]
            );
        }

        $this->command->info('Categories created successfully!');
        $this->command->info('MACHINES: ' . count($machinesCategories) . ' categories');
        $this->command->info('TOOLS: ' . count($toolsCategories) . ' categories');
    }
}
