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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id');
            $table->enum('type',['customer','supplier']);
            $table->enum('payment_for',['sell','purchase']);
            $table->foreignId('sale_id')->nullable();
            $table->foreignId('purchase_id')->nullable();
            $table->enum('method',['cash','card','upi','bank','mixed']);
            $table->decimal('amount_paid');
            $table->enum('payment_status',['paid','partial','due']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
