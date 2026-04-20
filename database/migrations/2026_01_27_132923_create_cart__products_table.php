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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->bigIncrements('cart_product_id');
            $table->foreignId('cart_id')->constrained('carts', 'cart_id')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products', 'product_id')->cascadeOnDelete();
            $table->integer('jumlah_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart__products');
    }
};
