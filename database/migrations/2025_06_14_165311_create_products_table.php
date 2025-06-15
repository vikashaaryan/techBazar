<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique()->nullable();
            $table->foreignId('category'); // foreign key
            $table->string('unit');
            $table->decimal('mrp', 10, 2);
            $table->decimal('sell_price', 10, 2);
            $table->integer('qty');
            $table->string('brand')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->string('warranty')->nullable();
            $table->string('image');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
