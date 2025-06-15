<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes_items', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('quotation_id')->constrained()->onDelete('CASCADE');
            // $table->foreignId('product_id');
            // $table->string('quantity');
            // $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes_items');
    }
};
