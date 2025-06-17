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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_no');
            $table->date('valid_date');
            $table->enum('status',['sent','draft','accepted','rejected','cancelled']);
            $table->foreignId('customer_id')->constrained()->onDelete('CASCADE');
            $table->string('notes')->nullable();
            $table->decimal('subtotal');
            $table->string('tax');
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
