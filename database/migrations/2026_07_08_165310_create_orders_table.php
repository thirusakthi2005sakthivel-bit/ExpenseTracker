<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Product Details
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Customer Details
            $table->string('customer_name');
            $table->string('customer_phone',20);
            $table->string('customer_email')->nullable();

            // Order Details
            $table->integer('quantity');
            $table->decimal('price',10,2);
            $table->decimal('total',10,2);

            // Delivery
            $table->text('address');
            $table->text('note')->nullable();

            // Order Status
            $table->enum('status',[
                'Pending',
                'Accepted',
                'Shipped',
                'Delivered',
                'Cancelled'
            ])->default('Pending');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
