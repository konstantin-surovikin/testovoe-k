<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Пушкин',
            'email' => 'pushkin@email.com',
            'email_verified_at' => '1970-01-01 00:00:00',
            'password' => Hash::make('qwerty'),
        ]);

        User::create([
            'name' => 'Лермонтов',
            'email' => 'lermontov@email.com',
            'email_verified_at' => '1970-01-01 00:00:00',
            'password' => Hash::make('qwerty'),
        ]);
    }
}
