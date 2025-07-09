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
        Schema::table('exchange_returns', function (Blueprint $table) {
            $table->enum('refund_method', ['cash', 'credit_card', 'store_credit', 'exchange'])
                ->nullable()
                ->after('return_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exchange_returns', function (Blueprint $table) {
            $table->dropColumn('refund_method');
        });
    }
};
