<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $medicines = [
            ['name' => 'Panadol 500mg', 'price' => 3.50],
            ['name' => 'Arinac Forte', 'price' => 8.00],
            ['name' => 'Disprin', 'price' => 2.00],
            ['name' => 'Flagyl 400mg', 'price' => 5.50],
            ['name' => 'Brufen 400mg', 'price' => 4.25],
            ['name' => 'Augmentin 625mg', 'price' => 45.00],
            ['name' => 'Ponstan Forte', 'price' => 7.00],
            ['name' => 'Surbex-Z', 'price' => 15.00],
            ['name' => 'Velo 4mg', 'price' => 12.00],
            ['name' => 'Softin 10mg', 'price' => 18.00],
            ['name' => 'Risek 20mg', 'price' => 22.00],
            ['name' => 'Calpol', 'price' => 2.50],
            ['name' => 'Avil', 'price' => 1.50],
            ['name' => 'Entamizole', 'price' => 6.00],
            ['name' => 'Gravinate', 'price' => 3.00],
            ['name' => 'Kestine', 'price' => 25.00],
            ['name' => 'Loprin 75mg', 'price' => 1.20],
            ['name' => 'Nuberol Forte', 'price' => 14.00],
            ['name' => 'Oscal', 'price' => 12.00],
            ['name' => 'Synflex', 'price' => 16.00],
            ['name' => 'Zantac', 'price' => 4.00],
            ['name' => 'Amoxil 250mg', 'price' => 10.00],
            ['name' => 'Ciproxin 500mg', 'price' => 35.00],
            ['name' => 'Flagyl 200mg', 'price' => 3.00],
            ['name' => 'Gaviscon Tablet', 'price' => 10.00],
        ];

        // Randomly pick one from the list or generate a fake name if list ends
        $med = $this->faker->randomElement($medicines);

        return [
            'name' => $med['name'],
            'price' => $med['price'], // Per Tablet Price
            'stock' => $this->faker->numberBetween(50, 500), // Stock in Tablets
            'min_stock_level' => 20,
        ];
    }
}