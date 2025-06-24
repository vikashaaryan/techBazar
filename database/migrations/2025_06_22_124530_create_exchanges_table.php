<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exchange_returns', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->unique()->comment('Auto-generated exchange/return number');

            // Transaction Type
            $table->enum('type', ['exchange', 'return']);
            $table->enum('return_type', ['sale_return', 'purchase_return']);

            // References
            $table->string('invoice_id')->nullable()->comment('Original invoice reference');
            $table->foreignId('sale_id')->nullable()->constrained('sales')->comment('For sale returns');
            $table->foreignId('purchase_id')->nullable()->constrained('purchases')->comment('For purchase returns');

            // Quantities and Amounts
            $table->integer('total_quantity');
            $table->decimal('total_refund_amount', 12, 2);
            $table->decimal('total_tax_refund', 12, 2)->default(0);

            // Reasons and Status
            $table->text('reasons')->comment('Detailed reasons for return/exchange');
            $table->enum('status', [
                'requested',
                'approved',
                'processed',
                'completed',
                'rejected'
            ])->default('requested');

            // Additional Information
            $table->foreignId('processed_by')->nullable()->constrained('users');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->text('notes')->nullable();

            // Timestamps
            $table->date('return_date');
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('exchange_return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exchange_return_id')->constrained()->cascadeOnDelete();

            // Item Details
            $table->foreignId('product_id')->constrained();
            $table->string('product_name')->comment('Snapshot of product name at time of return');
            $table->decimal('original_price', 12, 2);
            $table->integer('quantity');

            // Return Specifics
            $table->decimal('refund_amount', 12, 2);
            $table->string('reason')->nullable();
            $table->enum('condition', [
                'new',
                'opened',
                'used',
                'damaged',
                'defective'
            ])->default('new');

            // Exchange Specifics
            $table->foreignId('replacement_product_id')->nullable()->constrained('products');
            $table->string('replacement_product_name')->nullable();
            $table->decimal('replacement_price_diff', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exchange_return_items');
        Schema::dropIfExists('exchange_returns');
    }
};
