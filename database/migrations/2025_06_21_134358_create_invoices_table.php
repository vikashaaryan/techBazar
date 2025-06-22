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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->foreignId('quotation_id')->nullable();
            $table->foreignId('customer_id')->constrained()->onDelete('CASCADE');
            $table->enum('status',['sent','draft','accepted','rejected','cancelled']);
            $table->date('due_date');
            $table->decimal('subtotal');
            $table->string('tax');
            $table->decimal('total');
            $table->string('discount');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
