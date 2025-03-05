<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_types', static function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['First', 'Second', 'Third'])->unique();
            $table->string('name')->default('')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_types');
    }
};
