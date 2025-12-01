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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('no_invoice')->unique();
            $table->decimal('total_pembayaran', 15, 2);
            $table->enum('status_pembayaran', ['pending', 'dibayar', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->string('alamat_pengiriman');
            $table->dateTime('tanggal_pesanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
