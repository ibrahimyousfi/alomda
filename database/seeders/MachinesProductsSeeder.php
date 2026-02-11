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
        // Get Machines parent category
        $machinesCategory = Category::where('slug', 'machines')->first();
        
        if (!$machinesCategory) {
            $this->command->error('Machines category not found!');
            return;
        }

        // Get first child category under Machines (or use parent if no children)
        $category = $machinesCategory->children()->first() ?? $machinesCategory;

        $products = [
            ['name_fr' => '3d systems fabpro 1000 – imprimante 3d sla pour précision', 'name_en' => '3D Systems FabPro 1000 – Imprimante 3D SLA pour précision'],
            ['name_fr' => 'banc de traitement chimique multi bacs', 'name_en' => 'Banc de traitement chimique multi-bacs'],
            ['name_fr' => 'bm balzer – agitateur de laboratoire électrique', 'name_en' => 'BM Balzer – Agitateur de laboratoire électrique'],
            ['name_fr' => 'cuve de nettoyage industrielle avec commande électronique i.m', 'name_en' => 'Cuve de nettoyage industrielle avec commande électronique I.M'],
            ['name_fr' => 'Exenka Injector', 'name_en' => 'Exenka Injector'],
            ['name_fr' => 'four de fusion à haute température avec contrôle numérique', 'name_en' => 'Four de fusion à haute température avec contrôle numérique'],
            ['name_fr' => 'générateur de vapeur industriel steam power 8 bar', 'name_en' => 'Générateur de vapeur industriel STEAM POWER 8 BAR'],
            ['name_fr' => 'handler – aspirateur de poussière industriel', 'name_en' => 'Handler – Aspirateur de poussière industriel'],
            ['name_fr' => 'Machine de brasage à haute fréquence', 'name_en' => 'Machine de brasage à haute fréquence'],
            ['name_fr' => 'machine de marquage laser', 'name_en' => 'Machine de marquage Laser'],
            ['name_fr' => 'machine de nettoyage à vapeur steam jet', 'name_en' => 'Machine de nettoyage à vapeur Steam Jet'],
            ['name_fr' => 'Machine de polissage de laboratoire EKEMKA', 'name_en' => 'Machine de polissage de laboratoire EKEMKA'],
            ['name_fr' => 'machine de polissage double poste avec protections transparentes', 'name_en' => 'Machine de polissage double poste avec protections transparentes'],
            ['name_fr' => 'machine de polissage double poste twin', 'name_en' => 'Machine de polissage double poste TWIN'],
            ['name_fr' => 'machine de polissage eco maxi', 'name_en' => 'Machine de polissage ECO Maxi'],
            ['name_fr' => 'machine de sous pression pour moulage', 'name_en' => 'Machine de sous-pression pour moulage'],
            ['name_fr' => 'MasterInject', 'name_en' => 'MasterInject'],
            ['name_fr' => 'masterinject xl', 'name_en' => 'MasterInject XL'],
            ['name_fr' => 'nettoyeur à ultrasons', 'name_en' => 'Nettoyeur à Ultrasons'],
            ['name_fr' => 'nettoyeur à ultrasons compact avec contrôle numérique', 'name_en' => 'Nettoyeur à ultrasons compact avec contrôle numérique'],
            ['name_fr' => 'nettoyeur à ultrasons professionnel 4l avec chauffage et minuterie', 'name_en' => 'Nettoyeur à ultrasons professionnel 4L avec chauffage et minuterie'],
            ['name_fr' => 'nettoyeur à ultrasons professionnel avec commande numérique et robinet d\'évacuation', 'name_en' => 'Nettoyeur à ultrasons professionnel avec commande numérique et robinet d\'évacuation'],
            ['name_fr' => 'nettoyeur à ultrasons professionnel avec commandes analogiques, acier inoxydable', 'name_en' => 'Nettoyeur à ultrasons professionnel avec commandes analogiques, acier inoxydable'],
            ['name_fr' => 'nettoyeur à ultrasons professionnel en acier inoxydable avec commandes analogiques', 'name_en' => 'Nettoyeur à ultrasons professionnel en acier inoxydable avec commandes analogiques'],
            ['name_fr' => 'NovaFab – Imprimante 3D de précision pour bijoux', 'name_en' => 'NovaFab – Imprimante 3D de précision pour bijoux'],
            ['name_fr' => 'orotig evo – soudeuse laser de haute technologie', 'name_en' => 'Orotig Evo – Soudeuse laser de haute technologie'],
            ['name_fr' => 'orotig evox – soudeuse laser de haute performance (modèle noir)', 'name_en' => 'Orotig Evox – Soudeuse laser de haute performance (modèle noir)'],
            ['name_fr' => 'orotig evox – soudeuse laser de haute précision', 'name_en' => 'Orotig Evox – Soudeuse laser de haute précision'],
            ['name_fr' => 'orotig midi – soudeuse laser de précision', 'name_en' => 'Orotig MIDI – Soudeuse laser de précision'],
            ['name_fr' => 'orotig r50 writer avec drs 16', 'name_en' => 'Orotig R50 Writer avec DRS 16'],
            ['name_fr' => 'poste à souder inverter multiprocédés kolegeji klg 250c', 'name_en' => 'Poste à souder inverter multiprocédés KOLEGEJI KLG-250C'],
            ['name_fr' => 'Presse manuelle à haute pression avec contrôle numérique de la température', 'name_en' => 'Presse manuelle à haute pression avec contrôle numérique de la température'],
            ['name_fr' => 'presse manuelle à levier pour matériaux divers', 'name_en' => 'Presse manuelle à levier pour matériaux divers'],
            ['name_fr' => 'sableuse de table foredom', 'name_en' => 'Sableuse de table Foredom'],
            ['name_fr' => 'sta gold spring mini – soudeuse à ressort compacte', 'name_en' => 'STA Gold Spring Mini – Soudeuse à ressort compacte'],
            ['name_fr' => 'station de soudage avec contrôle numérique de la température', 'name_en' => 'Station de soudage avec contrôle numérique de la température'],
            ['name_fr' => 'Tour à polir aspirante à double poste', 'name_en' => 'Tour à polir aspirante à double poste'],
            ['name_fr' => 'Tumbler magnétique KT-185 avec commandes simples pour un polissage efficace et rapide des métaux et bijoux.', 'name_en' => 'Tumbler magnétique KT-185'],
            ['name_fr' => 'tumbler magnétique mt series', 'name_en' => 'Tumbler magnétique MT Series'],
            ['name_fr' => 'Tumbler magnétique professionnel KT-205', 'name_en' => 'Tumbler magnétique professionnel KT-205'],
            ['name_fr' => 'tumbler magnétique professionnel série mt', 'name_en' => 'Tumbler magnétique professionnel série MT'],
            ['name_fr' => 'unité industrielle de filtration et d\'aspiration b.5', 'name_en' => 'Unité industrielle de filtration et d\'aspiration B.5'],
        ];

        foreach ($products as $productData) {
            $slug = Str::slug($productData['name_en']);
            
            Product::firstOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'name_ar' => $productData['name_fr'],
                    'name_en' => $productData['name_en'],
                    'description_ar' => $productData['name_fr'],
                    'description_en' => $productData['name_en'],
                    'price' => rand(500, 5000),
                    'stock' => rand(1, 50),
                    'is_featured' => false,
                ]
            );
        }

        $this->command->info('Machines products created successfully!');
        $this->command->info('Total products: ' . count($products));
    }
}
