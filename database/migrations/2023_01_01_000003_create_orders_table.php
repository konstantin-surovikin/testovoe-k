<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', static function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('gen_random_uuid()'));
            $table->enum('status', ['Bucket', 'Unpaid', 'Paid', 'Denied'])->default('Bucket');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->unsignedBigInteger('entity_id');
            $table->enum('entity', ['User']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
