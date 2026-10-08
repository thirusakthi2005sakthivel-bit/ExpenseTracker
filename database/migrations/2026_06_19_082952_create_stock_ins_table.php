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
    Schema::create('stock_ins', function (Blueprint $table) {

        $table->id();

        $table->foreignId('product_id')
              ->constrained('products')
              ->onDelete('cascade');

        $table->foreignId('supplier_id')
              ->constrained('suppliers')
              ->onDelete('cascade');

        $table->integer('quantity');

        $table->decimal('buying_price',10,2);

        $table->string('invoice_no')->nullable();

        $table->date('stock_in_date');

        $table->text('remarks')->nullable();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_ins');
    }
};
