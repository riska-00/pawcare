<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Makanan Kucing Premium',
            'category' => 'Makanan',
            'price' => 75000,
            'stock' => 20,
            'photo' => null,
            'description' => 'Makanan kucing berkualitas untuk kebutuhan sehari-hari.',
        ]);

        Product::create([
            'name' => 'Pasir Kucing',
            'category' => 'Perawatan',
            'price' => 50000,
            'stock' => 15,
            'photo' => null,
            'description' => 'Pasir kucing yang nyaman digunakan dan mudah dibersihkan.',
        ]);
    }
}
