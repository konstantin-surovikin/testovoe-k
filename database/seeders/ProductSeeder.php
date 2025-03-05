<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Шоколад',
            'cost' => 9,
        ]);

        Product::create([
            'name' => 'Чай',
            'cost' => 9,
        ]);

        Product::create([
            'name' => 'Решимость',
            'cost' => 99,
        ]);
    }
}
