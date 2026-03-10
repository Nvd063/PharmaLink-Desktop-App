<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Step 1: Sirf Products table ko clean karein (Bills ko touch nahi karega)
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate(); 
        Schema::enableForeignKeyConstraints();

        $pharmacyItems = [
            'Tablets & Capsules' => ['Panadol', 'Arinac', 'Augmentin', 'Risek', 'Surbex-Z', 'Lofnac', 'Flagyl', 'Zestril', 'Glucophage', 'Lipiget'],
            'Syrups & Suspensions' => ['Hydryllin', 'Brufen Syrup', 'Cofcol', 'Gaviscon', 'Gravinate', 'Advent Syrup', 'Acefryl'],
            'Injections' => ['Rocephin', 'Venofer', 'Dexamethasone', 'Insulin Mixtard', 'Dicloran Injection'],
            'Surgical & Medical' => ['Face Masks (50s)', 'Gloves (Latex)', 'Bandage 4x5', 'Surgical Spirit', 'Digital Thermometer', 'Cannula 20G'],
            'Skincare & Cosmetics' => ['Dettol Soap', 'Sunsilk Shampoo', 'Sensodyne Paste', 'Ponds Cream', 'Lifebuoy Handwash'],
            'Baby Care' => ['Pampers Large', 'Canbebe XL', 'Johnson Baby Powder', 'Cerelac Rice', 'Morinaga BF-1', 'Lactogen 1'],
            'Ointments & Creams' => ['Polyfax', 'Betnovate-N', 'Quench Cream', 'Miconazole', 'Voltral Emulgel']
        ];

        // Step 2: 250+ Fresh Items with Expiry Dates
        for ($i = 1; $i <= 250; $i++) {
            $categoryName = array_rand($pharmacyItems);
            $productBaseName = $pharmacyItems[$categoryName][array_rand($pharmacyItems[$categoryName])];

            $suffixes = [' 500mg', ' 250mg', ' 1g', ' 120ml', ' 60ml', ' Pack', ' 20mg', ' 40mg'];
            $finalName = $productBaseName . $suffixes[array_rand($suffixes)];

            Product::create([
                'name' => $finalName . " (" . fake()->unique()->numerify('LOT-####') . ")", 
                'price' => fake()->randomFloat(2, 20, 3500),
                'stock' => fake()->numberBetween(5, 200),
                'min_stock_level' => fake()->randomElement([10, 15, 20]),
                'expiry_date' => $this->getRandomExpiryDate(),
            ]);
        }
    }

    private function getRandomExpiryDate()
    {
        $chance = rand(1, 100);
        if ($chance <= 10) { 
            return Carbon::now()->subMonths(rand(1, 6)); // 10% Expired (Testing ke liye)
        } elseif ($chance <= 25) {
            return Carbon::now()->addDays(rand(1, 28)); // 15% Near Expiry (Alerts ke liye)
        } else {
            return Carbon::now()->addMonths(rand(6, 24)); // Baqi sab Safe
        }
    }
}