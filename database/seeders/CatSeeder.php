<?php

namespace Database\Seeders;

use App\Models\Cat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cat::create([
            'name' => 'Mochi',
            'breed' => 'Persian',
            'age' => '2 tahun',
            'gender' => 'betina',
            'price' => 2.500000,
            'photo' => null,
            'description' => 'Kucing Persian yang lucu dan ramah.',
            'status' => 'available',
        ]);

        Cat::create([
            'name' => 'Milo',
            'breed' => 'British Shorthair',
            'age' => '1 tahun',
            'gender' => 'jantan',
            'price' => 3000000,
            'photo' => null,
            'description' => 'Kucing British Shorthair yang aktif dan menggemaskan.',
            'status' => 'available',
        ]);
    }
}
