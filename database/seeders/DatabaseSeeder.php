<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pehle ek Admin User banate hain
        User::create([
            'name' => 'Pharma Admin',
            'email' => 'admin@pharma.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Original Medicines List
        $meds = [
            'Panadol', 'Arinac', 'Disprin', 'Flagyl', 'Brufen', 'Augmentin', 'Ponstan', 'Surbex-Z', 
            'Velo', 'Softin', 'Risek', 'Calpol', 'Avil', 'Entamizole', 'Gravinate', 'Kestine', 
            'Loprin', 'Nuberol Forte', 'Oscal', 'Synflex', 'Zantac', 'Amoxil', 'Ciproxin', 'Gaviscon',
            'Xanax', 'Lexus', 'Motilium', 'Ventolin', 'Hydryllin', 'Advil', 'Tylenol', 'Zyrtec',
            'Claritin', 'Lipitor', 'Nexium', 'Plavix', 'Singulair', 'Effexor', 'Crestor', 'Lexapro'
        ];

        $strengths = ['250mg', '500mg', '625mg', '10mg', '20mg', '40mg', '1g'];

        // Loop to create 200+ variations
        for ($i = 0; $i < 210; $i++) {
            Product::create([
                'name' => $meds[array_rand($meds)] . ' ' . $strengths[array_rand($strengths)],
                'price' => rand(2, 50) + (rand(0, 99) / 100), // Random realistic per-tablet price
                'stock' => rand(50, 1000),
                'min_stock_level' => 50,
            ]);
        }
    }
}