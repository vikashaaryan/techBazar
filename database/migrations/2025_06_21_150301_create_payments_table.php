<?php

// database/migrations/xxxx_create_payments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('signature')->nullable();

            // Relationships
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->cascadeOnDelete();

            // Payment details
            $table->enum('type', ['customer', 'supplier'])->nullable();
            $table->enum('payment_for', ['sell', 'purchase'])->nullable();
            $table->foreignId('sale_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('purchase_id')->nullable()->constrained()->nullOnDelete();

            // Payment method
            $table->enum('method', ['cash', 'card', 'upi', 'bank', 'mixed', 'razorpay']);

            // Amounts
            $table->decimal('amount', 10, 2)->nullable(); // In rupees
            $table->decimal('amount_paid', 10, 2)->nullable();

            // Status
            $table->enum('status', ['pending', 'captured', 'failed', 'refunded'])->default('pending');
            $table->enum('payment_status', ['paid', 'partial', 'due'])->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};