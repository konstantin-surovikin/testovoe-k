<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        PaymentType::create([
            'type' => 'First',
            'name' => 'Первый проверочный',
        ]);

        PaymentType::create([
            'type' => 'Second',
            'name' => 'Второй проверочный',
        ]);

        PaymentType::create([
            'type' => 'Third',
            'name' => 'Третий проверочный',
        ]);
    }
}
