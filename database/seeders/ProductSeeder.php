<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $flavors = ['Carne', 'Queijo', 'Pizza', 'Calabresa', 'Bauru'];
        for($i = 0; $i < count($flavors); $i++) {
            Product::create([
                'name' => "Pastel de {$flavors[$i]}",
                'price' => rand(1000, 1500),
                'photo' => 'default.png'
            ]);
        }
    }
}
